<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function saveAll(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
        ]);

        $user->fill($request->only('name', 'phone', 'email', 'address'));

        if ($request->has('delete_account')) {
            $user->delete();
            return redirect('/')->with('status', 'Akun telah dihapus.');
        }

        $user->save();

        return back()->with('status', 'Perubahan disimpan.');
    }

    public function uploadPicture(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|max:2048',
        ]);

        $path = $request->file('picture')->store('profile-picture', 'public');

        $user = $request->user();
        $user->picture = $path;
        $user->save();

        return back()->with('status', 'Foto profil diperbarui.');
    }

        public function edit()
    {
        return view('profile.edit'); 
    }

        public function rentalInfo()
    {
        return view('profile.rental-information');
    }

        public function rentalHistory()
    {
        return view('profile.rental-history'); // Ganti sesuai nama file Blade kamu
    }

}