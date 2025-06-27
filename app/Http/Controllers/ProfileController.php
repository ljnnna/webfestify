<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Rental;
use App\Models\Order;
use App\Http\Controllers\ReturnController;

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
            'picture' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024', // 1024 KB = 1 MB
        ], [
            'picture.max' => 'Ukuran gambar tidak boleh melebihi 1MB.',
            'picture.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
        ]);
    
        $user = $request->user();
    
        // Hapus gambar lama jika ada
        if ($user->picture && Storage::disk('public')->exists($user->picture)) {
            Storage::disk('public')->delete($user->picture);
        }
    
        // Simpan gambar baru
        $path = $request->file('picture')->store('profile-pictures', 'public');
        $user->picture = $path;
        $user->save();
    
        return back()->with('status', 'Foto profil diperbarui.');
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

        public function rentalInfo()
    {
        $query = Order::where('user_id', auth()->id());
    
        $status = request('status'); // ambil query string
        if ($status && in_array($status, ['pending', 'confirmed', 'active', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }
    
        $activeOrders = $query->orderByDesc('start_date')->get();
    
        return view('profile.rental-information', compact('activeOrders'));
    }

    public function rentalHistory()
    {
        $rentalList = Rental::with(['rentalItems.product.category', 'rentalItems.review'])
        ->where('user_id', auth()->id())
        ->where('status', 'Completed')
        ->get();
    
    return view('profile.rental-history', compact('rentalList'));
    
    }

    public function destroy(Request $request)
    {
    $user = $request->user();
    $user->delete();

    return redirect('/')->with('status', 'Akun berhasil dihapus.');
    }

    
    

}