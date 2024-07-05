@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    {{ __('Status Surat') }}
                </div>

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
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($surat as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $item->nama_acara }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->role }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">{{ __('Tidak ada data surat.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
