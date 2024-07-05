@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('History Surat') }}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('No') }}</th>
                                    <th>{{ __('Tanggal Submit') }}</th>
                                    <th>{{ __('Nama Acara') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Diperiksa Oleh') }}</th>
                                    <th>{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($surat as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $item->nama_acara }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>
                                            <a href="{{ route('surat.download', $item->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-download"></i> {{ __('Download') }}
                                            </a>
                                            <a href="{{ route('surat.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i> {{ __('Edit') }}
                                            </a>
                                            <form action="{{ route('surat.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> {{ __('Hapus') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if($surat->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">{{ __('Tidak ada data surat.') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
