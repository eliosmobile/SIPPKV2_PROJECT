@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-door-open"></i> {{ __('Request Peminjaman Ruangan') }}
                </div>

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

                    <form method="POST" action="{{ route('room_requests.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nama_organisasi">{{ __('Nama Organisasi') }}</label>
                            <input type="text" class="form-control" id="nama_organisasi" name="nama_organisasi" required>
                        </div>

                        <div class="form-group">
                            <label for="nomor_surat">{{ __('Nomor Kop Surat') }}</label>
                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_acara">{{ __('Nama Acara') }}</label>
                            <input type="text" class="form-control" id="nama_acara" name="nama_acara" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_mulai">{{ __('Tanggal Berawal Acara') }}</label>
                            <input type="datetime-local" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_selesai">{{ __('Tanggal Berakhir Acara') }}</label>
                            <input type="datetime-local" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                        </div>

                        <div class="form-group">
                            <label for="surat">{{ __('Upload Surat') }}</label>
                            <input type="file" class="form-control-file" id="surat" name="surat" required>
                        </div>

                        <div class="form-group">
                            <label for="room_id">{{ __('Pilih Ruangan') }}</label>
                            <select name="room_id" id="room_id" class="form-control">
                                <option value="">{{ __('Pilih Ruangan') }}</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-paper-plane"></i> {{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
