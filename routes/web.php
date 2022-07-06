<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Models\Room;
use App\Models\SchoolYear;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\StudentController;

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
        Route::resource('student', StudentController::class);

        Route::resource('rooms', RoomController::class);

        Route::resource('school-years', SchoolYearController::class);

        Route::resource('costs', CostController::class);
    });

Route::prefix('siswa')
    ->middleware('IsSiswa')
    ->group(function () {
        Route::get('/', function () {
            return "Ini halaman Siswa";
        });
    });
