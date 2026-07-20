<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use App\Models\MenuItem;
use App\Models\DrinkItem;
use App\Models\GalleryItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $admin = Auth::user();
        $users = User::query()->orderBy('name', 'asc')->get();

        return view('admin.dashboard', compact('admin', 'users'));
    }

    public function menuDrinkPage()
    {
        $this->authorizeAdmin();

        $menuItems  = MenuItem::ordered()->get();
        $drinkItems = DrinkItem::ordered()->get();

        $logoPath = Setting::get('logo_path');
        $logoUrl  = $logoPath && Storage::disk('public')->exists($logoPath)
            ? Storage::disk('public')->url($logoPath)
            : null;
        $faviconUrl = $logoUrl;

        return view('admin.menu-drink', compact('menuItems', 'drinkItems', 'logoUrl', 'faviconUrl'));
    }

    public function settings()
    {
        $this->authorizeAdmin();

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
        $aboutTitleColor    = Setting::get('about_title_color',   '#111111');
        $aboutTitleWeight   = Setting::get('about_title_weight',  '700');
        $aboutTitleSize     = Setting::get('about_title_size',    '36px');
        $aboutParagraph1    = Setting::get('about_paragraph1',    'KOKIKU merupakan resto modern yang menyajikan makanan Chinese Foods Halal dengan resep terbaik dan bahan pilihan.');
        $aboutParagraph2    = Setting::get('about_paragraph2',    'Kami berkomitmen memberikan pelayanan terbaik serta suasana yang nyaman untuk keluarga dan teman.');
        $aboutParagraphColor  = Setting::get('about_paragraph_color',  '#333333');
        $aboutParagraphWeight = Setting::get('about_paragraph_weight', '400');
        $aboutParagraphSize   = Setting::get('about_paragraph_size',   '18px');
        $menuTitle          = Setting::get('menu_title',          'Menu Favorit');
        $menuSubtitle       = Setting::get('menu_subtitle',       'Cita rasa otentik Chinese halal yang selalu bikin rindu');
        $menuTitleColor     = Setting::get('menu_title_color',    '#f0f0f0');
        $menuTitleWeight    = Setting::get('menu_title_weight',   '800');
        $menuTitleSize      = Setting::get('menu_title_size',     '40px');
        $menuSubtitleColor  = Setting::get('menu_subtitle_color', '#a0a0c0');
        $menuSubtitleWeight = Setting::get('menu_subtitle_weight','400');
        $menuSubtitleSize   = Setting::get('menu_subtitle_size',  '16px');
        $navLinkColor         = Setting::get('nav_link_color',    '#000000');
        $navLinkBgColor       = Setting::get('nav_link_bg_color', '#ffc107');
        $navPreviewStyle = sprintf(
            'color:%s;background:%s;padding:10px 20px;border-radius:50px;font-size:13px;font-weight:700;display:inline-flex;align-items:center;gap:6px;box-shadow:0 4px 12px rgba(0,0,0,0.25);',
            $navLinkColor,
            $navLinkBgColor
        );

        $menuItems    = MenuItem::ordered()->get();
        $drinkItems   = DrinkItem::ordered()->get();
        $galleryItems = GalleryItem::ordered()->get();

        $logoPath = Setting::get('logo_path');
        $logoUrl  = $logoPath && Storage::disk('public')->exists($logoPath)
            ? Storage::disk('public')->url($logoPath)
            : null;
        $faviconUrl = $logoUrl;

        return view('admin.settings', compact(
            'heroTitle', 'heroSubtitle', 'heroText',
            'heroTitleColor', 'heroTitleWeight', 'heroTitleSize',
            'heroSubtitleColor', 'heroSubtitleWeight', 'heroSubtitleSize',
            'heroTextColor', 'heroTextWeight', 'heroTextSize',
            'heroBackgroundImage',
            'aboutTitle', 'aboutTitleColor', 'aboutTitleWeight', 'aboutTitleSize',
            'aboutParagraph1', 'aboutParagraph2',
            'aboutParagraphColor', 'aboutParagraphWeight', 'aboutParagraphSize',
            'menuTitle', 'menuSubtitle',
            'menuTitleColor', 'menuTitleWeight', 'menuTitleSize',
            'menuSubtitleColor', 'menuSubtitleWeight', 'menuSubtitleSize',
            'navLinkColor', 'navLinkBgColor', 'navPreviewStyle',
            'menuItems', 'drinkItems', 'galleryItems', 'logoUrl', 'faviconUrl'
        ));
    }

    public function saveSettings(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'logo_image'            => ['nullable', 'file', 'max:2048', 'mimes:jpeg,png,jpg,gif,webp,svg,ico'],
            'hero_title'            => 'required|string|max:255',
            'hero_subtitle'         => 'required|string|max:255',
            'hero_text'             => 'required|string|max:500',
            'hero_title_color'      => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'hero_title_weight'     => ['required', 'in:400,500,600,700,800,900'],
            'hero_title_size'       => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
            'hero_subtitle_color'   => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'hero_subtitle_weight'  => ['required', 'in:400,500,600,700,800,900'],
            'hero_subtitle_size'    => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
            'hero_text_color'       => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'hero_text_weight'      => ['required', 'in:400,500,600,700,800,900'],
            'hero_text_size'        => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
            'hero_background_image' => ['nullable', 'file', 'max:4096', 'mimes:jpeg,png,jpg,gif,webp,bmp,svg'],
            'about_title'           => 'required|string|max:255',
            'about_title_color'     => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'about_title_weight'    => ['required', 'in:400,500,600,700,800,900'],
            'about_title_size'      => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
            'about_paragraph1'      => 'required|string|max:2000',
            'about_paragraph2'      => 'required|string|max:2000',
            'about_paragraph_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'about_paragraph_weight'=> ['required', 'in:400,500,600,700,800,900'],
            'about_paragraph_size'  => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
            'menu_title'            => 'required|string|max:255',
            'menu_subtitle'         => 'required|string|max:255',
            'menu_title_color'      => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'menu_title_weight'     => ['required', 'in:300,400,500,600,700,800,900'],
            'menu_title_size'       => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
            'menu_subtitle_color'   => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'menu_subtitle_weight'  => ['required', 'in:300,400,500,600,700,800,900'],
            'menu_subtitle_size'    => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
            'nav_link_color'        => ['nullable', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'nav_link_bg_color'     => ['nullable', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'about_image'           => ['nullable', 'file', 'max:4096', 'mimes:jpeg,png,jpg,gif,webp'],
        ]);

        // Logo upload
        if ($request->hasFile('logo_image')) {
            $logo     = $request->file('logo_image');
            $logoName = 'logo_' . time() . '.' . $logo->extension();
            $previousPath = Setting::get('logo_path');
            if ($previousPath && Storage::disk('public')->exists($previousPath)) {
                Storage::disk('public')->delete($previousPath);
            }
            $storedPath = $logo->storeAs('logos', $logoName, 'public');
            Setting::set('logo_path', $storedPath);
        }

        // Hero background
        if ($request->hasFile('hero_background_image')) {
            $image    = $request->file('hero_background_image');
            $fileName = 'hero_background_' . time() . '.' . $image->extension();
            $image->move(public_path('images'), $fileName);
            Setting::set('hero_background_image', 'images/' . $fileName);
        }

        // About image
        if ($request->hasFile('about_image')) {
            $img     = $request->file('about_image');
            $imgName = 'about_' . time() . '.' . $img->extension();
            $prevAbout = Setting::get('about_image_path');
            if ($prevAbout && Storage::disk('public')->exists($prevAbout)) {
                Storage::disk('public')->delete($prevAbout);
            }
            $stored = $img->storeAs('about', $imgName, 'public');
            Setting::set('about_image_path', $stored);
        }

        Setting::set('hero_title',          $validated['hero_title']);
        Setting::set('hero_subtitle',        $validated['hero_subtitle']);
        Setting::set('hero_text',            $validated['hero_text']);
        Setting::set('hero_title_color',     $validated['hero_title_color']);
        Setting::set('hero_title_weight',    $validated['hero_title_weight']);
        Setting::set('hero_title_size',      $validated['hero_title_size']);
        Setting::set('hero_subtitle_color',  $validated['hero_subtitle_color']);
        Setting::set('hero_subtitle_weight', $validated['hero_subtitle_weight']);
        Setting::set('hero_subtitle_size',   $validated['hero_subtitle_size']);
        Setting::set('hero_text_color',      $validated['hero_text_color']);
        Setting::set('hero_text_weight',     $validated['hero_text_weight']);
        Setting::set('hero_text_size',       $validated['hero_text_size']);
        Setting::set('about_title',          $validated['about_title']);
        Setting::set('about_title_color',    $validated['about_title_color']);
        Setting::set('about_title_weight',   $validated['about_title_weight']);
        Setting::set('about_title_size',     $validated['about_title_size']);
        Setting::set('about_paragraph1',     $validated['about_paragraph1']);
        Setting::set('about_paragraph2',     $validated['about_paragraph2']);
        Setting::set('about_paragraph_color',  $validated['about_paragraph_color']);
        Setting::set('about_paragraph_weight', $validated['about_paragraph_weight']);
        Setting::set('about_paragraph_size',   $validated['about_paragraph_size']);
        Setting::set('menu_title',           $validated['menu_title']);
        Setting::set('menu_subtitle',        $validated['menu_subtitle']);
        Setting::set('menu_title_color',     $validated['menu_title_color']);
        Setting::set('menu_title_weight',    $validated['menu_title_weight']);
        Setting::set('menu_title_size',      $validated['menu_title_size']);
        Setting::set('menu_subtitle_color',  $validated['menu_subtitle_color']);
        Setting::set('menu_subtitle_weight', $validated['menu_subtitle_weight']);
        Setting::set('menu_subtitle_size',   $validated['menu_subtitle_size']);
        Setting::set('nav_link_color',    $request->input('nav_link_color',    '#000000'));
        Setting::set('nav_link_bg_color', $request->input('nav_link_bg_color', '#ffc107'));

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Pengaturan berhasil disimpan.']);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan.');
    }

    // ── MENU ──────────────────────────────────────────────────────────────────

    public function menuStore(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
            'image'       => 'nullable|file|max:2048|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $item = new MenuItem();
        $item->name        = $request->name;
        $item->price       = $request->price;
        $item->description = $request->description;
        $item->sort_order  = MenuItem::max('sort_order') + 1;
        $item->is_active   = true;

        if ($request->hasFile('image')) {
            $img  = $request->file('image');
            $name = 'menu_' . time() . '.' . $img->extension();
            $item->image_path = $img->storeAs('menu', $name, 'public');
        }

        $item->save();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Menu berhasil ditambahkan.', 'item' => $item]);
        }

        return redirect()->route('admin.settings', ['#tab-menu'])->with('success', 'Menu berhasil ditambahkan.');
    }

    public function menuUpdate(Request $request, $id)
    {
        $this->authorizeAdmin();

        $item = MenuItem::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
            'image'       => 'nullable|file|max:2048|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $item->name        = $request->name;
        $item->price       = $request->price;
        $item->description = $request->description;

        if ($request->hasFile('image')) {
            if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
                Storage::disk('public')->delete($item->image_path);
            }
            $img  = $request->file('image');
            $name = 'menu_' . time() . '.' . $img->extension();
            $item->image_path = $img->storeAs('menu', $name, 'public');
        }

        $item->save();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Menu berhasil diperbarui.', 'item' => $item]);
        }

        return redirect()->back()->with('success', 'Menu berhasil diperbarui.');
    }

    public function menuDestroy(Request $request, $id)
    {
        $this->authorizeAdmin();

        $item = MenuItem::findOrFail($id);

        if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Menu berhasil dihapus.']);
        }

        return redirect()->back()->with('success', 'Menu berhasil dihapus.');
    }

    // ── MENU MINUMAN ─────────────────────────────────────────────────────────────

    public function drinkStore(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
            'image'       => 'nullable|file|max:2048|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $item = new DrinkItem();
        $item->name        = $request->name;
        $item->price       = $request->price;
        $item->description = $request->description;
        $item->sort_order  = DrinkItem::max('sort_order') + 1;
        $item->is_active   = true;

        if ($request->hasFile('image')) {
            $img  = $request->file('image');
            $name = 'drink_' . time() . '.' . $img->extension();
            $item->image_path = $img->storeAs('drinks', $name, 'public');
        }

        $item->save();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Minuman berhasil ditambahkan.', 'item' => $item]);
        }

        return redirect()->back()->with('success', 'Minuman berhasil ditambahkan.');
    }

    public function drinkUpdate(Request $request, $id)
    {
        $this->authorizeAdmin();

        $item = DrinkItem::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
            'image'       => 'nullable|file|max:2048|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $item->name        = $request->name;
        $item->price       = $request->price;
        $item->description = $request->description;

        if ($request->hasFile('image')) {
            if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
                Storage::disk('public')->delete($item->image_path);
            }
            $img  = $request->file('image');
            $name = 'drink_' . time() . '.' . $img->extension();
            $item->image_path = $img->storeAs('drinks', $name, 'public');
        }

        $item->save();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Minuman berhasil diperbarui.', 'item' => $item]);
        }

        return redirect()->back()->with('success', 'Minuman berhasil diperbarui.');
    }

    public function drinkDestroy(Request $request, $id)
    {
        $this->authorizeAdmin();

        $item = DrinkItem::findOrFail($id);

        if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Minuman berhasil dihapus.']);
        }

        return redirect()->back()->with('success', 'Minuman berhasil dihapus.');
    }

    // ── GALLERY ───────────────────────────────────────────────────────────────

    public function galleryStore(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'images'   => 'required|array|min:1',
            'images.*' => 'file|max:4096|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $uploaded = [];
        foreach ($request->file('images') as $img) {
            $name = 'gallery_' . time() . '_' . uniqid() . '.' . $img->extension();
            $path = $img->storeAs('gallery', $name, 'public');
            $item = GalleryItem::create([
                'image_path' => $path,
                'caption'    => $request->caption ?? '',
                'sort_order' => GalleryItem::max('sort_order') + 1,
            ]);
            $uploaded[] = $item;
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => count($uploaded) . ' foto berhasil diupload.', 'items' => $uploaded]);
        }

        return redirect()->back()->with('success', count($uploaded) . ' foto berhasil diupload.');
    }

    public function galleryDestroy(Request $request, $id)
    {
        $this->authorizeAdmin();

        $item = GalleryItem::findOrFail($id);

        if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Foto berhasil dihapus.']);
        }

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }

    // ── USERS ─────────────────────────────────────────────────────────────────

    public function destroy(Request $request, $id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Tidak boleh menghapus akun admin.');
        }

        $user->delete();
        DB::table('sessions')->where('user_id', $id)->delete();
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        return redirect()->back()->with('success', 'Akun pengguna berhasil dihapus.');
    }

    protected function authorizeAdmin()
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
    }
}