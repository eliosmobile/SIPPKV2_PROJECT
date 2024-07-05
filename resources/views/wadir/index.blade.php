<!-- resources/views/wadir/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5>{{ __('Dashboard Wadir') }}</h5>
                    <span id="current-time" class="badge badge-light"></span>
                </div>

                <div class="card-body">
                    <div class="form-group mb-4">
                        <label for="room_select">{{ __('Select Room') }}</label>
                        <select id="room_select" class="form-control">
                            <option value="">{{ __('All Rooms') }}</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card text-white bg-info mb-3">
                                    <div class="card-header">{{ __('Total Requests') }}</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $totalRequests }}</h5>
                                        <p class="card-text">{{ __('Number of all room requests.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-header">{{ __('Approved Requests') }}</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $approvedRequests }}</h5>
                                        <p class="card-text">{{ __('Number of approved room requests.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-warning mb-3">
                                    <div class="card-header">{{ __('Pending Requests') }}</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $pendingRequests }}</h5>
                                        <p class="card-text">{{ __('Number of pending room requests.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-danger mb-3">
                                    <div class="card-header">{{ __('Rejected Requests') }}</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $rejectedRequests }}</h5>
                                        <p class="card-text">{{ __('Number of rejected room requests.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="calendar" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include FullCalendar CSS and JS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'id',
        events: function(fetchInfo, successCallback, failureCallback) {
            var room_id = document.getElementById('room_select').value;
            var url = '{{ route("wadir.events") }}';
            if (room_id) {
                url += '?room_id=' + room_id;
            }
            fetch(url)
                .then(response => response.json())
                .then(events => successCallback(events))
                .catch(error => failureCallback(error));
        }
    });

    calendar.render();

    document.getElementById('room_select').addEventListener('change', function() {
        calendar.refetchEvents();
    });

    // Function to update current time every second
    function updateTime() {
        var now = new Date();
        var timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('current-time').textContent = timeString;
    }
    updateTime();
    setInterval(updateTime, 1000);
});
</script>
@endsection
