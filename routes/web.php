<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\Setting;

Route::get('/about', function () {
    return view('about');
});

Route::get('/menu', function () {
    return view('menu');
});

Route::get('/contact', function () {
    return view('contact');
});


/*
|--------------------------------------------------------------------------
| Halaman Landing
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Public landing page (menampilkan hero "SELAMAT DATANG DI RESTO KOKIKU")
Route::get('/home', function () {
    $aboutTitle = Setting::get('about_title', 'Tentang KOKIKU');
    $aboutTitleColor = Setting::get('about_title_color', '#111111');
    $aboutTitleWeight = Setting::get('about_title_weight', '700');
    $aboutParagraph1 = Setting::get('about_paragraph1', 'KOKIKU merupakan resto modern yang menyajikan makanan Chinese Foods Halal dengan resep terbaik dan bahan pilihan.');
    $aboutParagraph2 = Setting::get('about_paragraph2', 'Kami berkomitmen memberikan pelayanan terbaik serta suasana yang nyaman untuk keluarga dan teman.');
    $aboutParagraphColor = Setting::get('about_paragraph_color', '#333333');
    $aboutParagraphWeight = Setting::get('about_paragraph_weight', '400');

    return view('home', compact(
        'aboutTitle',
        'aboutTitleColor',
        'aboutTitleWeight',
        'aboutParagraph1',
        'aboutParagraph2',
        'aboutParagraphColor',
        'aboutParagraphWeight'
    ));
})->name('landing');

/*
|--------------------------------------------------------------------------
| Login & Register
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerPost']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard Admin
|--------------------------------------------------------------------------
*/

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth');

Route::get('/admin/settings', [AdminController::class, 'settings'])
    ->middleware('auth');

Route::post('/admin/settings', [AdminController::class, 'saveSettings'])
    ->middleware('auth');

Route::post('/admin/users/{id}/delete', [AdminController::class, 'destroy'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Dashboard User
|--------------------------------------------------------------------------
*/

Route::get('/user', [UserController::class, 'index'])
    ->middleware('auth');