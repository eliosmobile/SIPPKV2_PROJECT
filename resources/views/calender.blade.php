@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Kalender Interaktif') }}</div>
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label for="roomSelect">Select Room:</label>
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
                                    <h4>Event Details</h4>
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
@endsection

@section('scripts')
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
@endsection
