@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="card-title mb-0">Request History</h2>
            <form class="form-inline">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search">
            </form>
        </div>
        <div class="card-body">
            @if ($history->isEmpty())
                <p class="lead">No history.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Organisasi</th>
                                <th>Acara</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Ruangan</th>
                                <th>Surat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_organisasi }}</td>
                                    <td>{{ $item->nama_acara }}</td>
                                    <td>{{ $item->tanggal_mulai }}</td>
                                    <td>{{ $item->tanggal_selesai }}</td>
                                    <td>{{ $request->room->nama }}</td>
                                    <td>
                                        <a href="{{ route('direktur.requests.download', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('direktur.requests.approve', ['id' => $item->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('direktur.requests.reject', ['id' => $item->id]) }}" method="POST" class="d-inline">
s                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card-header {
        padding: .75rem 1.25rem;
        background-color: #007bff;
        color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }

    .table thead th {
        text-align: center;
    }

    .table tbody td {
        text-align: center;
    }

    .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // DataTables initialization
        var table = $('.table').DataTable({
            "paging": false,
            "info": false
        });

        // Custom search function
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
@endsection
