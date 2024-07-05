@extends('layouts.app')

@section('content')
<div class="container-fluid mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-plus-circle"></i> {{ __('Tambah Ruangan Baru') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin_ruangan.rooms.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">
                                <i class="fas fa-door-open"></i> {{ __('Nama Ruangan') }}
                            </label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fas fa-plus"></i> {{ __('Tambah') }}
                        </button>
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
