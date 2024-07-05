@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">{{ __('History') }}</h4>
                    <form class="form-inline float-right">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" id="searchInput" placeholder="{{ __('Search') }}">
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Nama Organisasi') }}</th>
                                    <th>{{ __('Nama Acara') }}</th>
                                    <th>{{ __('Tanggal Mulai') }}</th>
                                    <th>{{ __('Tanggal Selesai') }}</th>
                                    <th>{{ __('Ruangan') }}</th>
                                    <th>{{ __('Surat') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{ $request->id }}</td>
                                        <td>{{ $request->nama_organisasi }}</td>
                                        <td>{{ $request->nama_acara }}</td>
                                        <td>{{ $request->tanggal_dimulai }}</td>
                                        <td>{{ $request->tanggal_selesai }}</td>
                                        <td>{{ $request->room->nama }}</td>
                                        <td>
                                            <a href="{{ route('wadir.requests.download', $request->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-download"></i> {{ __('Download') }}
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('wadir.requests.delete', $request->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are you sure you want to delete this request?') }}')">
                                                    <i class="fas fa-trash"></i> {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($requests->isEmpty())
                        <p>{{ __('No approved requests available.') }}</p>
                    @endif
                </div>
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

    .card-header h4 {
        margin-bottom: 0;
    }

    .table thead th {
        vertical-align: middle;
        text-align: center;
    }

    .table tbody td {
        vertical-align: middle;
        text-align: center;
    }

    .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endsection

@section('scripts')
<!-- Add custom script for search functionality -->
<script>
    $(document).ready(function() {
        // DataTables initialization
        var table = $('table').DataTable({
            "paging": false, // disable pagination for small tables
            "info": false, // disable table information summary
        });

        // Custom search function
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
@endsection
