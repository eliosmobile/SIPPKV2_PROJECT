@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-primary text-white text-center" style="font-size: 1.5rem; border-radius: 10px;">
                    {{ __('Super Admin Dashboard') }}
                </div>

                <div class="card-body">
                    <!-- Dashboard Content -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">SIRPPK Information</h5>
                                    <p class="card-text">Current time, account statistics, etc.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Add more dashboard information cards as needed -->
                    </div>

                    <!-- Account Management Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Account Management</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="{{ route('superadmin.create') }}">Create Super Admin</a></li>
                                        <li class="list-group-item"><a href="{{ route('superadmin.create.adminruangan') }}">Create Room Admin</a></li>
                                        <li class="list-group-item"><a href="{{ route('superadmin.create.adminfasilitas') }}">Create Facility Admin</a></li>
                                        <li class="list-group-item"><a href="{{ route('superadmin.create.wadir') }}">Create Vice Director</a></li>
                                        <li class="list-group-item"><a href="{{ route('superadmin.create.direktur') }}">Create Director</a></li>
                                        <li class="list-group-item"><a href="{{ route('superadmin.create.mahasiswa') }}">Create Student</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Add more account management options as needed -->
                    </div>

                    <!-- Change Password Section -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Change Password</h5>
                                    <form method="POST" action="{{ route('superadmin.changePassword') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="password" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Add more change password forms as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
