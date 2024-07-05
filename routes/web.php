<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\RoomRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SuratHistoryController;
use App\Http\Controllers\FasilitasRequestController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AdminRuanganController;
use App\Http\Controllers\WadirController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\AdminFasilitasController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/jadwal', [CalendarController::class, 'index'])->name('calendar');
Route::get('/fetch-events', [CalendarController::class, 'fetchEvents']);

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/fetch-events', [App\Http\Controllers\EventController::class, 'fetchEvents']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard_mahasiswa', [DashboardController::class, 'index'])->name('dashboard_mahasiswa');
    Route::get('/history', [RoomRequestController::class, 'history'])->name('surat.history');
    Route::get('/fasilitas/request', [FasilitasRequestController::class, 'create'])->name('fasilitas.request.create');

    Route::get('/surat/history', [SuratHistoryController::class, 'index'])->name('surat.history');
    Route::get('/surat/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');
    Route::post('/surat/{id}/update', [SuratController::class, 'update'])->name('surat.update');
    Route::delete('/surat/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');
    Route::get('/surat/{id}/download', [SuratController::class, 'download'])->name('surat.download');

    Route::get('room_requests/create', [RoomRequestController::class, 'create'])->name('room_requests.create');
    Route::post('room_requests', [RoomRequestController::class, 'store'])->name('room_requests.store');
    Route::get('room_requests', [RoomRequestController::class, 'index'])->name('room_requests.index');
    Route::get('room_requests/{id}', [RoomRequestController::class, 'show'])->name('room_requests.show');
    Route::post('room_requests/{id}/approve', [RoomRequestController::class, 'approve'])->name('room_requests.approve');
    Route::post('room_requests/{id}/reject', [RoomRequestController::class, 'reject'])->name('room_requests.reject');

    Route::get('/admin_ruangan/dashboard', [AdminRuanganController::class, 'index'])->name('admin_ruangan.dashboard');
    Route::get('/admin_ruangan/requests', [AdminRuanganController::class, 'requests'])->name('admin_ruangan.requests');
    Route::post('/admin_ruangan/requests/{id}/approve', [AdminRuanganController::class, 'approveRequest'])->name('admin_ruangan.requests.approve');
    Route::post('/admin_ruangan/requests/{id}/reject', [AdminRuanganController::class, 'rejectRequest'])->name('admin_ruangan.requests.reject');
    Route::get('/admin_ruangan/requests/{id}/download', [AdminRuanganController::class, 'downloadRequest'])->name('admin_ruangan.requests.download');
    Route::get('/admin_ruangan/rooms/create', [AdminRuanganController::class, 'createRoom'])->name('admin_ruangan.rooms.create');
    Route::post('/admin_ruangan/rooms', [AdminRuanganController::class, 'storeRoom'])->name('admin_ruangan.rooms.store');
    Route::get('/admin_ruangan/users/create', [AdminRuanganController::class, 'createUser'])->name('admin_ruangan.users.create');
    Route::post('/admin_ruangan/users', [AdminRuanganController::class, 'storeUser'])->name('admin_ruangan.users.store');

    // Routes for managing admin accounts
    Route::get('admin_ruangan/index', [AdminRuanganController::class, 'index_admin'])->name('admin_ruangan.index');
    Route::get('admin_ruangan/{id}/edit', [AdminRuanganController::class, 'edit'])->name('admin_ruangan.edit');
    Route::post('admin_ruangan/{id}', [AdminRuanganController::class, 'update'])->name('admin_ruangan.update');
    Route::delete('admin_ruangan/{id}', [AdminRuanganController::class, 'destroy'])->name('admin_ruangan.destroy');
    Route::post('/admin/requests/{id}/approve', [AdminRuanganController::class, 'approve'])->name('admin.requests.approve');
    Route::post('/admin/requests/{id}/approve', [AdminRuanganController::class, 'approve'])->name('admin.requests.approve');

    //wadir
    Route::get('/wadir/dashboard', [WadirController::class, 'index'])->name('wadir.index');
    Route::get('/wadir/requests', [WadirController::class, 'requests'])->name('wadir.requests');
    Route::post('/wadir/requests/{id}/approve', [WadirController::class, 'approveRequest'])->name('wadir.requests.approve');
    Route::get('/wadir/requests/{id}/download', [WadirController::class, 'download'])->name('wadir.requests.download');
    Route::get('/wadir/history', [WadirController::class, 'approvedRequests'])->name('wadir.approved_requests');
    Route::get('events', [WadirController::class, 'events'])->name('wadir.events');
    Route::delete('/wadir/requests/{id}', 'App\Http\Controllers\WadirController@deleteRequest')->name('wadir.requests.delete');



    //direktur
    Route::get('direktur', [DirekturController::class, 'dashboard'])->name('direktur.dashboard');
    Route::get('requests', [DirekturController::class, 'requests'])->name('direktur.requests');
    Route::post('/requests/approve/{id}', [DirekturController::class, 'approveRequest'])->name('direktur.requests.approve');
    Route::get('requests/download/{id}', [DirekturController::class, 'download'])->name('direktur.requests.download');
    Route::get('approved-requests', [DirekturController::class, 'approvedRequests'])->name('direktur.approvedRequests');
    Route::get('history', [DirekturController::class, 'history'])->name('direktur.history');
    Route::get('room-events/{roomId}', [DirekturController::class, 'getRoomEvents'])->name('direktur.room-events');
    Route::get('complete-requests', [DirekturController::class, 'completeRequests'])->name('direktur.completeRequests');
    Route::get('/requests/{id}/download', [DirekturController::class, 'download'])->name('direktur.requests.download');
    Route::delete('/requests/{id}', [DirekturController::class, 'destroy'])->name('direktur.requests.destroy');
    Route::get('{id}/download', [DirekturController::class, 'download'])->name('direktur.requests.download');
    Route::post('{id}/download', [DirekturController::class, 'download'])->name('direktur.requests.download');  // Ini menyebabkan konflik

});

Auth::routes();
