<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\Setting;
use App\Models\MenuItem;
use App\Models\GalleryItem;

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
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect('/admin')
            : redirect('/user');
    }

    return redirect()->route('login');
});

// Public landing page
Route::get('/home', function () {
    $heroTitle          = Setting::get('hero_title',          'SELAMAT DATANG DI RESTO KOKIKU');
    $heroSubtitle       = Setting::get('hero_subtitle',       'Moslem Chinese Foods Halal');
    $heroText           = Setting::get('hero_text',           'Nikmati cita rasa terbaik dengan pengalaman kuliner yang tak pernah terlupakan.');
    $heroTitleColor     = Setting::get('hero_title_color',    '#ffffff');
    $heroTitleWeight    = Setting::get('hero_title_weight',   '700');
    $heroTitleSize      = Setting::get('hero_title_size',     '56px');
    $heroSubtitleColor  = Setting::get('hero_subtitle_color', '#ffffff');
    $heroSubtitleWeight = Setting::get('hero_subtitle_weight','500');
    $heroSubtitleSize   = Setting::get('hero_subtitle_size',  '28px');
    $heroTextColor      = Setting::get('hero_text_color',     '#ffffff');
    $heroTextWeight     = Setting::get('hero_text_weight',    '400');
    $heroTextSize       = Setting::get('hero_text_size',      '20px');
    $heroBackgroundImage= Setting::get('hero_background_image','images/home_kokiku.jpeg');
    $aboutTitle         = Setting::get('about_title',         'Tentang KOKIKU');
    $aboutTitleColor    = Setting::get('about_title_color',   '#f0f0f0');
    $aboutTitleWeight   = Setting::get('about_title_weight',  '700');
    $aboutTitleSize     = Setting::get('about_title_size',    '40px');
    $aboutParagraph1    = Setting::get('about_paragraph1',    'KOKIKU merupakan resto modern yang menyajikan makanan Chinese Foods Halal dengan resep terbaik dan bahan pilihan.');
    $aboutParagraph2    = Setting::get('about_paragraph2',    'Kami berkomitmen memberikan pelayanan terbaik serta suasana yang nyaman untuk keluarga dan teman.');
    $aboutParagraphColor  = Setting::get('about_paragraph_color',  'rgba(255,255,255,0.55)');
    $aboutParagraphWeight = Setting::get('about_paragraph_weight', '400');
    $aboutParagraphSize   = Setting::get('about_paragraph_size',   '16px');
    $navLinkColor         = Setting::get('nav_link_color',    '#000000');
    $navLinkBgColor       = Setting::get('nav_link_bg_color', '#ffc107');

    // Dynamic data
    $menuItems    = MenuItem::active()->ordered()->get();
    $galleryItems = GalleryItem::ordered()->get();

    return view('home', compact(
        'navLinkColor', 'navLinkBgColor',
        'heroTitle', 'heroSubtitle', 'heroText',
        'heroTitleColor', 'heroTitleWeight', 'heroTitleSize',
        'heroSubtitleColor', 'heroSubtitleWeight', 'heroSubtitleSize',
        'heroTextColor', 'heroTextWeight', 'heroTextSize',
        'heroBackgroundImage',
        'aboutTitle', 'aboutTitleColor', 'aboutTitleWeight', 'aboutTitleSize',
        'aboutParagraph1', 'aboutParagraph2',
        'aboutParagraphColor', 'aboutParagraphWeight', 'aboutParagraphSize',
        'menuItems', 'galleryItems'
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

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/settings', [AdminController::class, 'saveSettings']);
    Route::post('/admin/users/{id}/delete', [AdminController::class, 'destroy']);

    // Menu Makanan
    Route::post('/admin/menu', [AdminController::class, 'menuStore'])->name('admin.menu.store');
    Route::post('/admin/menu/{id}', [AdminController::class, 'menuUpdate'])->name('admin.menu.update');
    Route::post('/admin/menu/{id}/delete', [AdminController::class, 'menuDestroy'])->name('admin.menu.destroy');

    // Galeri
    Route::post('/admin/gallery', [AdminController::class, 'galleryStore'])->name('admin.gallery.store');
    Route::post('/admin/gallery/{id}/delete', [AdminController::class, 'galleryDestroy'])->name('admin.gallery.destroy');

    // Menu Minuman
    Route::post('/admin/drink', [AdminController::class, 'drinkStore'])->name('admin.drink.store');
    Route::post('/admin/drink/{id}', [AdminController::class, 'drinkUpdate'])->name('admin.drink.update');
    Route::post('/admin/drink/{id}/delete', [AdminController::class, 'drinkDestroy'])->name('admin.drink.destroy');
});

/*
|--------------------------------------------------------------------------
| Dashboard User
|--------------------------------------------------------------------------
*/

Route::get('/user', [UserController::class, 'index'])->middleware('auth');
Route::get('/user/profile', [UserController::class, 'profile'])->middleware('auth')->name('user.profile');