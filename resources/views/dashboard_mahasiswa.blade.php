@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-tachometer-alt"></i> {{ __('Dashboard Mahasiswa') }}
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card text-white bg-dark">
                                <div class="card-header"><i class="fas fa-clock"></i> {{ __('Current Time (WITA)') }}</div>
                                <div class="card-body jam-digital">
                                    <div id="jam">
                                        <span id="hours">00</span>
                                        <span>:</span>
                                        <span id="minutes">00</span>
                                        <span>:</span>
                                        <span id="seconds">00</span>
                                    </div>
                                    <div id="unit">
                                        <span>{{ __('Jam') }}</span>
                                        <span>{{ __('Menit') }}</span>
                                        <span>{{ __('Detik') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-white bg-info">
                                <div class="card-header"><i class="fas fa-file-alt"></i> {{ __('Total Requests') }}</div>
                                <div class="card-body">
                                    <h5 class="card-title"><strong>{{ $request_count }}</strong></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <a href="{{ route('surat.history') }}" class="btn btn-primary w-100">
                                <i class="fas fa-history"></i> {{ __('Lihat History Status Surat') }}
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('fasilitas.request.create') }}" class="btn btn-success w-100">
                                <i class="fas fa-plus-circle"></i> {{ __('Request Peminjaman Fasilitas') }}
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-calendar-alt"></i> {{ __('Kalender Interaktif') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-4">
                                <label for="roomSelect"><i class="fas fa-door-open"></i> {{ __('Select Room:') }}</label>
                                <select id="roomSelect" class="form-control">
                                    <option value="all">{{ __('All Rooms') }}</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="calendar"></div>
                                </div>
                                <div class="col-md-4">
                                    <div id="eventDetails" class="card" style="display: none;">
                                        <div class="card-header bg-info text-white">
                                            <h4>{{ __('Event Details') }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <p id="eventInfo"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function fetchEvents(roomId) {
            let url = '{{ url("fetch-events") }}';
            $.ajax({
                url: url,
                type: 'GET',
                data: { room_id: roomId },
                success: function(events) {
                    $('#calendar').fullCalendar('removeEvents');
                    $('#calendar').fullCalendar('addEventSource', events);
                }
            });
        }

        function updateCurrentTime() {
            const now = new Date();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();

            if (hours < 10) hours = '0' + hours;
            if (minutes < 10) minutes = '0' + minutes;
            if (seconds < 10) seconds = '0' + seconds;

            $('#hours').text(hours);
            $('#minutes').text(minutes);
            $('#seconds').text(seconds);
        }

        // Update current time initially
        updateCurrentTime();

        // Update current time every second
        setInterval(updateCurrentTime, 1000);

        $('#roomSelect').change(function() {
            let roomId = $(this).val();
            fetchEvents(roomId);
        });

        $('#calendar').fullCalendar({
            events: [],  // Initially empty, will be populated based on room selection
            eventClick: function(event) {
                let eventInfo = `Title: ${event.title}<br>Description: ${event.description}<br>Time: ${event.start.format('YYYY-MM-DD HH:mm')} - ${event.end.format('YYYY-MM-DD HH:mm')}`;
                $('#eventInfo').html(eventInfo);
                $('#eventDetails').show();
            },
            dayClick: function(date, jsEvent, view) {
                let clickedDate = date.format('YYYY-MM-DD');
                let events = $('#calendar').fullCalendar('clientEvents', function(event) {
                    return event.start.isSame(clickedDate, 'day');
                });

                if (events.length > 0) {
                    let eventInfo = '';
                    events.forEach(function(event) {
                        eventInfo += `Title: ${event.title}<br>Description: ${event.description}<br>Time: ${event.start.format('YYYY-MM-DD HH:mm')} - ${event.end.format('YYYY-MM-DD HH:mm')}<br><br>`;
                    });
                    $('#eventInfo').html(eventInfo);
                } else {
                    $('#eventInfo').html('No events on this date.');
                }
                $('#eventDetails').show();
            }
        });

        // Initial fetch for all rooms
        fetchEvents('all');
    });
</script>
<style>
    .jam-digital {
        text-align: center;
        font-size: 2rem;
    }
    .jam-digital #jam {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .jam-digital #jam span {
        background: #343a40; /* Bootstrap dark color */
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        margin: 0 5px;
    }
    .jam-digital #unit {
        margin-top: 10px;
        text-align: center;
        font-size: 1rem;
    }
</style>
@endsection
