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
    $heroTitle = Setting::get('hero_title', 'SELAMAT DATANG DI RESTO KOKIKU');
    $heroSubtitle = Setting::get('hero_subtitle', 'Moslem Chinese Foods Halal');
    $heroText = Setting::get('hero_text', 'Nikmati cita rasa terbaik dengan pengalaman kuliner yang tak pernah terlupakan.');
    $heroTitleColor = Setting::get('hero_title_color', '#ffffff');
    $heroTitleWeight = Setting::get('hero_title_weight', '700');
    $heroTitleSize = Setting::get('hero_title_size', '56px');
    $heroSubtitleColor = Setting::get('hero_subtitle_color', '#ffffff');
    $heroSubtitleWeight = Setting::get('hero_subtitle_weight', '500');
    $heroSubtitleSize = Setting::get('hero_subtitle_size', '28px');
    $heroTextColor = Setting::get('hero_text_color', '#ffffff');
    $heroTextWeight = Setting::get('hero_text_weight', '400');
    $heroTextSize = Setting::get('hero_text_size', '20px');
    $heroBackgroundImage = Setting::get('hero_background_image', 'images/home_kokiku.jpeg');
    $aboutTitle = Setting::get('about_title', 'Tentang KOKIKU');
    $aboutTitleColor = Setting::get('about_title_color', '#111111');
    $aboutTitleWeight = Setting::get('about_title_weight', '700');
    $aboutTitleSize = Setting::get('about_title_size', '36px');
    $aboutParagraph1 = Setting::get('about_paragraph1', 'KOKIKU merupakan resto modern yang menyajikan makanan Chinese Foods Halal dengan resep terbaik dan bahan pilihan.');
    $aboutParagraph2 = Setting::get('about_paragraph2', 'Kami berkomitmen memberikan pelayanan terbaik serta suasana yang nyaman untuk keluarga dan teman.');
    $aboutParagraphColor = Setting::get('about_paragraph_color', '#333333');
    $aboutParagraphWeight = Setting::get('about_paragraph_weight', '400');
    $aboutParagraphSize = Setting::get('about_paragraph_size', '18px');

    $logoImage     = Setting::get('logo_image',       'images/logo_kokiku.png');
    $navLinkColor  = Setting::get('nav_link_color',    '#000000');
    $navLinkBgColor = Setting::get('nav_link_bg_color', '#ffc107');

    return view('home', compact(
        'logoImage',
        'navLinkColor',
        'navLinkBgColor',
        'heroTitle',
        'heroSubtitle',
        'heroText',
        'heroTitleColor',
        'heroTitleWeight',
        'heroTitleSize',
        'heroSubtitleColor',
        'heroSubtitleWeight',
        'heroSubtitleSize',
        'heroTextColor',
        'heroTextWeight',
        'heroTextSize',
        'heroBackgroundImage',
        'aboutTitle',
        'aboutTitleColor',
        'aboutTitleWeight',
        'aboutTitleSize',
        'aboutParagraph1',
        'aboutParagraph2',
        'aboutParagraphColor',
        'aboutParagraphWeight',
        'aboutParagraphSize'
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

Route::get('/user/profile', [UserController::class, 'profile'])
    ->middleware('auth')
    ->name('user.profile');