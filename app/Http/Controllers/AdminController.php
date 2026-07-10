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

        $aboutTitle = Setting::get('about_title', 'Tentang KOKIKU');
        $aboutParagraph1 = Setting::get('about_paragraph1', 'KOKIKU merupakan resto modern yang menyajikan makanan Chinese Foods Halal dengan resep terbaik dan bahan pilihan.');
        $aboutParagraph2 = Setting::get('about_paragraph2', 'Kami berkomitmen memberikan pelayanan terbaik serta suasana yang nyaman untuk keluarga dan teman.');

        return view('admin.settings', compact('aboutTitle', 'aboutParagraph1', 'aboutParagraph2'));
    }

    public function saveSettings(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'about_title' => 'required|string|max:255',
            'about_paragraph1' => 'required|string|max:2000',
            'about_paragraph2' => 'required|string|max:2000',
        ]);

        Setting::set('about_title', $validated['about_title']);
        Setting::set('about_paragraph1', $validated['about_paragraph1']);
        Setting::set('about_paragraph2', $validated['about_paragraph2']);

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