<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\LateController;
use App\Http\Controllers\RekapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::middleware('IsGuest')->group(function() {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
});

Route::get('/error-permission', function () {
    return view('errors.permission');
})->name('error.permission');

Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Route::middleware('IsLogin')->group(function(){
//     Route::prefix('/dashboard')->name('dashboard.')->group(function(){
//         Route::get('/', [DashboardController::class, 'index'])->name('home');
//     });
// })->name('home.page');


Route::middleware(['IsLogin', 'IsAdmin'])->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::prefix('/siswa')->name('siswa.')->group(function(){
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        Route::get('/', [StudentController::class, 'index'])->name('home');
        Route::get('/{id}', [StudentController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [StudentController::class, 'update'])->name('update');
        Route::delete('/{id}', [StudentController::class, 'destroy'])->name('delete');
    });
    Route::prefix('/user')->name('user.')->group(function(){
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/', [UserController::class, 'index'])->name('home');
        Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
    });
    Route::prefix('/rombel')->name('rombel.')->group(function(){
        Route::get('/create', [RombelController::class, 'create'])->name('create');
        Route::post('/store', [RombelController::class, 'store'])->name('store');
        Route::get('/', [RombelController::class, 'index'])->name('home');
        Route::get('/{id}', [RombelController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [RombelController::class, 'update'])->name('update');
        Route::delete('/{id}', [RombelController::class, 'destroy'])->name('delete');
    });
    Route::prefix('/rayon')->name('rayon.')->group(function(){
        Route::get('/create', [RayonController::class, 'create'])->name('create');
        Route::post('/store', [RayonController::class, 'store'])->name('store');
        Route::get('/', [RayonController::class, 'index'])->name('home');
        Route::get('/{id}', [RayonController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [RayonController::class, 'update'])->name('update');
        Route::delete('/{id}', [RayonController::class, 'destroy'])->name('delete');
    });
    // Route::prefix('/keterlambatan')->name('late.')->group(function(){
    //     Route::get('/create', [LateController::class, 'create'])->name('create');
    //     Route::post('/store', [LateController::class, 'store'])->name('store');
    //     Route::get('/', [LateController::class, 'index'])->name('home');
    //     Route::get('/{id}', [LateController::class, 'edit'])->name('edit');
    //     Route::patch('/{id}', [LateController::class, 'update'])->name('update');
    //     Route::delete('/{id}', [LateController::class, 'destroy'])->name('delete');
    //     Route::get('/detail/{id}', [LateController::class, 'show'])->name('show');
    //     Route::get('/rekap', [LateController::class, 'rekap'])->name('rekap');
    //     Route::get('/export-excel', [LateController::class, 'exportExcel'])->name('export-excel');
    // });
    Route::prefix('/keterlambatan')->name('rekap.')->group(function(){
        Route::get('/rekap', [RekapController::class, 'index'])->name('home');
        Route::get('/export-excel', [RekapController::class, 'export'])->name('export-excel');
        Route::get('/create', [RekapController::class, 'create'])->name('create');
        Route::post('/store', [RekapController::class, 'store'])->name('store');
        Route::get('/', [RekapController::class, 'telat'])->name('telat');
        Route::get('/{id}', [RekapController::class, 'edit'])->name('edit');
        Route::get('/detail/{id}', [RekapController::class, 'show'])->name('show');
        Route::get('/print/{id}', [RekapController::class, 'review'])->name('print');
        Route::get('/download/{id}', [RekapController::class, 'downloadPDF'])->name('download');
        Route::patch('/{id}', [RekapController::class, 'update'])->name('update');
        Route::delete('/{id}', [RekapController::class, 'destroy'])->name('delete');
    });
});

Route::middleware(['IsLogin', 'IsPs'])->group(function(){
    Route::prefix('/ps')->name('ps.')->group(function() {
        Route::get('/', [DashboardController::class, 'dashboardPs'])->name('home');
        Route::prefix('/siswa')->name('siswa.')->group(function(){
            Route::get('/', [StudentController::class, 'dataSiswa'])->name('home');
        });
        
        Route::prefix('/keterlambatan')->name('rekap.')->group(function(){
            Route::get('/export-excel', [RekapController::class, 'export'])->name('export-excel');
            Route::get('/rekap', [RekapController::class, 'indexPs'])->name('home');
            Route::get('/detail/{id}', [RekapController::class, 'showPs'])->name('show');
            Route::get('/print/{id}', [RekapController::class, 'reviewPs'])->name('print');
            Route::get('/download/{id}', [RekapController::class, 'downloadPDFPs'])->name('download');
            Route::get('/', [RekapController::class, 'telatPs'])->name('telat');
        });
    });
});