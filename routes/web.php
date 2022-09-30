<?php

use App\Models\Room;
use App\Models\SchoolYear;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\TransactionOfflineController;
use App\Http\Controllers\Student\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::match(["GET", "POST"], "/register", function () {
    return redirect("/login");
})->name("register");

Route::get('/register-student', function () {
    $school_years = SchoolYear::all();
    $rooms = Room::all();
    return view('auth.register-student', compact('school_years', 'rooms'));
});

Route::post('register-student', [RegisterController::class, 'register'])->name('register-student');

Route::prefix('admin')
    ->middleware('isAdmin')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::resource('users', UserController::class);

        Route::resource('rooms', RoomController::class);

        Route::resource('school-years', SchoolYearController::class);

        Route::resource('costs', CostController::class);

        Route::resource('students', StudentController::class);

        Route::resource('transaction-offlines', TransactionOfflineController::class);

        Route::get('/transaction-offlines/nominal/{id}', [TransactionOfflineController::class, 'nominal1']);

        Route::get('/download-offlines/downloadPDF', [TransactionOfflineController::class, 'downloadPDF1'])->name('transactionofflines.downloadPDF1');

        Route::get('/download-offlines/downloadEXCEL', [TransactionOfflineController::class, 'downloadEXCEL1'])->name('transactionofflines.downloadEXCEL1');

        Route::resource('rombels', RombelController::class);
        Route::resource('levels', LevelController::class);
        Route::resource('fees', FeeController::class);
        Route::resource('bills', BillController::class);
    });

Route::prefix('siswa')
    ->middleware('IsSiswa')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('student.dashboard.index');
        Route::get('/friend', [DashboardController::class, 'friend'])->name('friend.index');
        Route::get('/transaction', [TransactionController::class, 'index'])->name('siswa.transaction.index');
        Route::get('/transaction/create', [TransactionController::class, 'create']);
        Route::get('/transaction/get-nominal/{id}', [TransactionController::class, 'nominal']);
        Route::post('/transaction/store', [TransactionController::class, 'store']);
        Route::get('/transaction/downloadPDF', [TransactionController::class, 'downloadPDF'])->name('transaction.downloadPDF');
        Route::get('/transaction/downloadEXCEL', [TransactionController::class, 'downloadEXCEL'])->name('transaction.downloadEXCEL');
    });
