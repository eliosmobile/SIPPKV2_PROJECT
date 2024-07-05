@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Dashboard Pengunjung') }}</div>

                <div class="position-relative mt-1">
                    <img src="{{ asset('image/image.png') }}" class="card-img custom-img-height" alt="Background Image">
                    <div class="card-img-overlay d-flex flex-column justify-content-center text-start">
                        <h1 class="card-title text-white emphasized-title animate__animated animate__fadeInDown">Selamat Datang di Sistem Informasi Peminjaman Ruangan</h1>
                        <p class="card-text text-white animate__animated animate__fadeInUp">Anda dapat melihat dan memesan ruangan melalui sistem ini.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                            <a href="{{ url('/jadwal') }}" class="btn btn-primary me-md-2 animate__animated animate__zoomIn">Lihat Jadwal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4 animate__animated animate__fadeInLeft">
            <div class="card h-100 bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-calendar-alt"></i> Manajemen Jadwal Peminjaman</h5>
                    <p class="card-text">Pengguna dapat melihat jadwal peminjaman ruangan dan membuat reservasi baru.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4 animate__animated animate__fadeInRight">
            <div class="card h-100 bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-door-open"></i> Manajemen Ruangan dan Fasilitas</h5>
                    <p class="card-text">Administrator dapat menambah, mengedit, atau menghapus ruangan dan fasilitas yang tersedia untuk dipinjam.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4 animate__animated animate__fadeInLeft">
            <div class="card h-100 bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-users"></i> Manajemen Pengguna</h5>
                    <p class="card-text">Sistem untuk mengelola akun pengguna, termasuk peran dan izin akses.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4 animate__animated animate__fadeInRight">
            <div class="card h-100 bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-chart-bar"></i> Laporan dan Statistik</h5>
                    <p class="card-text">Modul untuk menghasilkan laporan tentang penggunaan ruangan dan fasilitas.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4 animate__animated animate__fadeInLeft">
            <div class="card h-100 bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-bell"></i> Notifikasi dan Pengingat</h5>
                    <p class="card-text">Fitur untuk mengirimkan notifikasi kepada pengguna terkait status peminjaman.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4 animate__animated animate__fadeInRight">
            <div class="card h-100 bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-search"></i> Pencarian dan Filter</h5>
                    <p class="card-text">Fasilitas untuk mencari ruangan dan fasilitas yang tersedia berdasarkan berbagai kriteria.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4 animate__animated animate__fadeInLeft">
            <div class="card h-100 bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-calendar"></i> Integrasi Kalender</h5>
                    <p class="card-text">Integrasi dengan kalender eksternal seperti Google Calendar atau Outlook.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4 animate__animated animate__fadeInRight">
            <div class="card h-100 bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-info-circle"></i> Halaman Tentang Kami</h5>
                    <p class="card-text">Menyediakan informasi tentang organisasi atau institusi yang mengelola sistem peminjaman ruangan.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-4 animate__animated animate__fadeInLeft">
            <div class="card h-100 bg-light">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-question-circle"></i> Bantuan dan Dukungan</h5>
                    <p class="card-text">Fitur untuk memberikan bantuan kepada pengguna yang mengalami kesulitan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
