@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-white">{{ __('Edit Surat') }}</div>

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

                    <form method="POST" action="{{ route('surat.update', $surat->id) }}">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="nama_acara">{{ __('Nama Acara') }}</label>
                            <input id="nama_acara" type="text" class="form-control" name="nama_acara" value="{{ $surat->nama_acara }}" required>
                        </div>

                        <!-- Tambahkan input lainnya sesuai kebutuhan -->

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Surat') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
