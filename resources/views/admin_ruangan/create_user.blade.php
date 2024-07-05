@extends('layouts.app')

@section('content')
<div class="container-fluid mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-user-plus"></i> {{ __('Buat Akun Admin Ruangan Baru') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin_ruangan.users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">
                                <i class="fas fa-user"></i> {{ __('Nama') }}
                            </label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope"></i> {{ __('Email') }}
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">
                                <i class="fas fa-lock"></i> {{ __('Password') }}
                            </label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">
                                <i class="fas fa-lock"></i> {{ __('Konfirmasi Password') }}
                            </label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">
                            <i class="fas fa-check-circle"></i> {{ __('Buat Akun') }}
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
