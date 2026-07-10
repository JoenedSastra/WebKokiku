<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $admin = Auth::user();
        $users = User::orderBy('name')->get();

        return view('admin.dashboard', compact('admin', 'users'));
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

        return redirect()->back()->with('success', 'Akun pengguna berhasil dihapus.');
    }

    protected function authorizeAdmin()
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
    }
}