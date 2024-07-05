@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Request Peminjaman Fasilitas') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('fasilitas.request.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nama_organisasi">{{ __('Nama Organisasi') }}</label>
                            <input id="nama_organisasi" type="text" class="form-control" name="nama_organisasi" required>
                        </div>

                        <div class="form-group">
                            <label for="nomor_kop_surat">{{ __('Nomor Kop Surat') }}</label>
                            <input id="nomor_kop_surat" type="text" class="form-control" name="nomor_kop_surat" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_acara">{{ __('Nama Acara') }}</label>
                            <input id="nama_acara" type="text" class="form-control" name="nama_acara" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_awal">{{ __('Tanggal Awal Acara') }}</label>
                            <input id="tanggal_awal" type="date" class="form-control" name="tanggal_awal" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_akhir">{{ __('Tanggal Akhir Acara') }}</label>
                            <input id="tanggal_akhir" type="date" class="form-control" name="tanggal_akhir" required>
                        </div>

                        <div class="form-group">
                            <label for="file_surat">{{ __('Upload Surat') }}</label>
                            <input id="file_surat" type="file" class="form-control" name="file_surat" required>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
