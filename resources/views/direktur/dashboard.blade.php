@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Dashboard Direktur</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="card-text display-4">{{ $incomingRequestsCount }}</p>
                        <i class="fas fa-envelope fa-4x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="card-title">Processed Requests</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="card-text display-4">{{ $processedRequestsCount }}</p>
                        <i class="fas fa-cogs fa-4x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title">Approved Requests</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="card-text display-4">{{ $approvedRequestsCount }}</p>
                        <i class="fas fa-check fa-4x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title mb-0">Event Calendar</h2>
            </div>
            <div class="card-body">
                <div class="form-group mb-4">
                    <label for="room-select" class="form-label font-weight-bold fs-4">Select Room:</label>
                    <select id="room-select" class="form-select form-select-lg" aria-label="Select Room">
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="calendar" class="shadow-lg p-3 mb-5 bg-white rounded"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: #007bff;
        border-bottom: 1px solid rgba(0, 0, 0, .125);
        color: #fff;
    }

    .card-header h2 {
        margin-bottom: 0;
    }

    .card-header h5 {
        margin-bottom: 0;
    }

    .card-body {
        padding: 1.25rem;
    }

    .card-body .card-text.display-4 {
        font-size: 3rem;
    }

    .card-body .fa-4x {
        font-size: 4rem;
    }

    .form-label.font-weight-bold {
        font-size: 1.5rem;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($events),
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            selectable: true,
            selectMirror: true,
            editable: true,
            dayMaxEvents: true,
            eventColor: '#378006', // Default color for events
            eventClick: function(info) {
                alert('Event: ' + info.event.title + '\n' +
                      'Organization: ' + info.event.extendedProps.nama_organisasi + '\n' +
                      'Start: ' + info.event.start.toLocaleString() + '\n' +
                      'End: ' + info.event.end.toLocaleString());
            },
        });
        calendar.render();

        document.getElementById('room-select').addEventListener('change', function() {
            var roomId = this.value;
            fetch(`/direktur/room-events/${roomId}`)
                .then(response => response.json())
                .then(events => {
                    calendar.removeAllEvents();
                    calendar.addEventSource(events);
                    alert('Events updated for the selected room.');
                });
        });
    });
</script>
@endsection
