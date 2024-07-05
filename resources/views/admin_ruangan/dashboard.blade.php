@extends('layouts.app')

@section('content')
<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-tachometer-alt"></i> {{ __('Dashboard Admin Ruangan') }}
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-header">
                                    <i class="fas fa-list-alt"></i> {{ __('Total Requests') }}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $request_count }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header">
                                    <i class="fas fa-check-circle"></i> {{ __('Completed Requests') }}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $completed_requests }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-header">
                                    <i class="fas fa-clock"></i> {{ __('Pending Requests') }}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $requests->count() }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <a href="{{ route('admin_ruangan.rooms.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus"></i> {{ __('Tambah Ruangan Baru') }}
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin_ruangan.users.create') }}" class="btn btn-success w-100">
                                <i class="fas fa-user-plus"></i> {{ __('Buat Akun Admin Ruangan Baru') }}
                            </a>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-calendar-alt"></i> {{ __('Jadwal Peminjaman Ruangan') }}
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <select id="room-selector" class="form-control">
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-clipboard-list"></i> {{ __('Permintaan Peminjaman Ruangan') }}
                        </div>
                        <div class="card-body">
                            @foreach ($requests as $request)
                                <div class="alert alert-info">
                                    <h5>{{ $request->event_name }}</h5>
                                    <p>{{ $request->organization_name }}</p>
                                    <p>{{ $request->event_start }} - {{ $request->event_end }}</p>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('admin_ruangan.requests.download', $request->id) }}" class="btn btn-primary">
                                            <i class="fas fa-download"></i> Download PDF
                                        </a>
                                        <form action="{{ route('admin_ruangan.requests.approve', $request->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin_ruangan.requests.reject', $request->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            @if ($requests->isEmpty())
                                <p>{{ __('Tidak ada permintaan peminjaman ruangan.') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script>
    $(document).ready(function() {
        function fetchEvents(roomId) {
            $('#calendar').fullCalendar('removeEvents');
            $('#calendar').fullCalendar('addEventSource', {
                url: '{{ url("fetch-events") }}',
                data: { room_id: roomId }
            });
        }

        $('#room-selector').change(function() {
            var roomId = $(this).val();
            fetchEvents(roomId);
        });

        $('#calendar').fullCalendar({
            events: function(start, end, timezone, callback) {
                var roomId = $('#room-selector').val();
                $.ajax({
                    url: '{{ url("fetch-events") }}',
                    data: { room_id: roomId },
                    success: function(data) {
                        callback(data);
                    }
                });
            },
            editable: false,
            droppable: false
        });

        // Fetch events for the initially selected room
        fetchEvents($('#room-selector').val());
    });
</script>
@endsection
