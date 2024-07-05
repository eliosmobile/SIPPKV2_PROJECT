@extends('layouts.app')

@section('content')
<div class="container-fluid mt-2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-clipboard-list"></i> {{ __('Daftar Permintaan Ruangan') }}
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group mb-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan nama organisasi, nama ruangan, status, tanggal mulai atau tanggal selesai...">
                    </div>

                    @if($requests->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> {{ __('Tidak ada permintaan ruangan.') }}
                        </div>
                    @else
                        <table class="table table-bordered" id="requestTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> No</th>
                                    <th><i class="fas fa-user"></i> Nama Organisasi</th>
                                    <th><i class="fas fa-door-open"></i> Ruangan</th>
                                    <th><i class="fas fa-calendar-alt"></i> Tanggal Mulai</th>
                                    <th><i class="fas fa-calendar-alt"></i> Tanggal Selesai</th>
                                    <th><i class="fas fa-info-circle"></i> Status</th>
                                    <th><i class="fas fa-tools"></i> Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $index => $request)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $request->user ? $request->user->name : 'N/A' }}</td>
                                        <td>{{ $request->room ? $request->room->name : 'Kosong' }}</td>
                                        <td>{{ $request->tanggal_mulai }}</td>
                                        <td>{{ $request->tanggal_selesai }}</td>
                                        <td>{{ $request->status }}</td>
                                        <td>
                                            @if($request->status == 'pending')
                                                <form action="{{ route('admin_ruangan.requests.approve', $request->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin_ruangan.requests.reject', $request->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary" disabled>
                                                    <i class="fas fa-check"></i> Approved
                                                </button>
                                                <button class="btn btn-secondary" disabled>
                                                    <i class="fas fa-times"></i> Rejected
                                                </button>
                                            @endif
                                            <a href="{{ route('admin_ruangan.requests.download', $request->id) }}" class="btn btn-primary">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable with search input
        var table = $('#requestTable').DataTable({
            "searching": true,
            "paging": true,
            "info": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 10,
            "columnDefs": [
                { "orderable": false, "targets": 6 } // Disable ordering on Actions column
            ]
        });

        // Custom search function
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
@endsection
