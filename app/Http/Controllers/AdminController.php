<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $admin = Auth::user();
        $users = User::orderBy('name')->get();

        return view('admin.dashboard', compact('admin', 'users'));
    }

    public function settings()
    {
        $this->authorizeAdmin();

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
        $aboutTitle = Setting::get('about_title', 'Tentang KOKIKU');
        $aboutTitleColor = Setting::get('about_title_color', '#111111');
        $aboutTitleWeight = Setting::get('about_title_weight', '700');
        $aboutTitleSize = Setting::get('about_title_size', '36px');
        $aboutParagraph1 = Setting::get('about_paragraph1', 'KOKIKU merupakan resto modern yang menyajikan makanan Chinese Foods Halal dengan resep terbaik dan bahan pilihan.');
        $aboutParagraph2 = Setting::get('about_paragraph2', 'Kami berkomitmen memberikan pelayanan terbaik serta suasana yang nyaman untuk keluarga dan teman.');
        $aboutParagraphColor = Setting::get('about_paragraph_color', '#333333');
        $aboutParagraphWeight = Setting::get('about_paragraph_weight', '400');
        $aboutParagraphSize = Setting::get('about_paragraph_size', '18px');

        return view('admin.settings', compact(
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
    }

    public function saveSettings(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_text' => 'required|string|max:500',
            'hero_title_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'hero_title_weight' => ['required', 'in:400,500,600,700,800,900'],
            'hero_title_size' => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
            'hero_subtitle_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'hero_subtitle_weight' => ['required', 'in:400,500,600,700,800,900'],
            'hero_subtitle_size' => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
            'hero_text_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'hero_text_weight' => ['required', 'in:400,500,600,700,800,900'],
            'hero_text_size' => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
            'about_title' => 'required|string|max:255',
            'about_title_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'about_title_weight' => ['required', 'in:400,500,600,700,800,900'],
            'about_title_size' => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
            'about_paragraph1' => 'required|string|max:2000',
            'about_paragraph2' => 'required|string|max:2000',
            'about_paragraph_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'about_paragraph_weight' => ['required', 'in:400,500,600,700,800,900'],
            'about_paragraph_size' => ['required', 'string', 'regex:/^[0-9]+(px|rem|em)$/'],
        ]);

        Setting::set('hero_title', $validated['hero_title']);
        Setting::set('hero_subtitle', $validated['hero_subtitle']);
        Setting::set('hero_text', $validated['hero_text']);
        Setting::set('hero_title_color', $validated['hero_title_color']);
        Setting::set('hero_title_weight', $validated['hero_title_weight']);
        Setting::set('hero_title_size', $validated['hero_title_size']);
        Setting::set('hero_subtitle_color', $validated['hero_subtitle_color']);
        Setting::set('hero_subtitle_weight', $validated['hero_subtitle_weight']);
        Setting::set('hero_subtitle_size', $validated['hero_subtitle_size']);
        Setting::set('hero_text_color', $validated['hero_text_color']);
        Setting::set('hero_text_weight', $validated['hero_text_weight']);
        Setting::set('hero_text_size', $validated['hero_text_size']);
        Setting::set('about_title', $validated['about_title']);
        Setting::set('about_title_color', $validated['about_title_color']);
        Setting::set('about_title_weight', $validated['about_title_weight']);
        Setting::set('about_title_size', $validated['about_title_size']);
        Setting::set('about_paragraph1', $validated['about_paragraph1']);
        Setting::set('about_paragraph2', $validated['about_paragraph2']);
        Setting::set('about_paragraph_color', $validated['about_paragraph_color']);
        Setting::set('about_paragraph_weight', $validated['about_paragraph_weight']);
        Setting::set('about_paragraph_size', $validated['about_paragraph_size']);

        return redirect()->back()->with('success', 'Pengaturan Tentang KOKIKU berhasil disimpan.');
    }

    public function destroy(Request $request, $id)
    {
        $this->authorizeAdmin();

        $user = User::findOrFail($id);

        // Prevent deleting another admin or self-deletion for safety
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Tidak boleh menghapus akun admin.');
        }

        $user->delete();

        // Remove any session rows that reference this user (so phpMyAdmin shows no leftover session links)
        DB::table('sessions')->where('user_id', $id)->delete();

        // Remove any password reset tokens for this user's email
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