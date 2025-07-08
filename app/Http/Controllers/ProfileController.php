<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Rental;
use App\Models\Order;
use App\Http\Controllers\ReturnController;
use Carbon\Carbon;




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

public function verify(Request $request)
{
    $request->validate([
        'ktp_photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        'selfie_with_ktp' => 'required|image|mimes:jpeg,png,jpg|max:5120'
    ]);

    $user = $request->user();
    
// Simpan file dulu
if ($request->hasFile('ktp_photo')) {
    $ktpPath = $request->file('ktp_photo')->store('verifications', 'public');
    $user->ktp_photo = $ktpPath;
}
if ($request->hasFile('selfie_with_ktp')) {
    $selfiePath = $request->file('selfie_with_ktp')->store('verifications', 'public');
    $user->ktp_selfie_photo = $selfiePath;
}

// Kalau sudah lengkap baru set status
if ($user->ktp_photo && $user->ktp_selfie_photo) {
    $user->verification_status = 'pending';
    $user->verification_submitted_at = now();
} else {
    // Kalau belum lengkap, pastikan status di DB tetap kosong/null
    $user->verification_status = null;
    $user->verification_submitted_at = null;
}

$user->save();

    return redirect()->back()->with('success', 'Verification documents submitted successfully!');
}

public function showRentalDetail($id)
{
    $order = \App\Models\Order::with('products')->findOrFail($id); 

    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    $return = \App\Models\ReturnProduct::where('order_id', $order->id)->first();
    $conditionPhotos = $return?->condition_before ?? [];

    $endDate = Carbon::parse($order->end_date)->setTime(18, 0)->format('Y-m-d\TH:i:s');

    $rentalItem = $return?->orderProduct;

    return view('profile.rental-detail', [
        'order' => $order,
        'return' => $return,
        'conditionPhotos' => $conditionPhotos,
        'endDate' => $endDate,
        'rentalItem' => $rentalItem
    ]);
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

    public function deliveryTracking($orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    
        // Dummy tracking status, bisa diganti pakai kolom `delivery_status` jika ada
        $trackingStatus = match ($order->status) {
            'pending' => 'confirmed',
            'confirmed' => $order->delivery_option === 'delivery' ? 'in_delivery' : 'ready_pickup',
            'delivered', 'completed' => 'delivered',
            default => 'confirmed',
        };
    
        return view('profile.delivery-tracking', compact('order', 'trackingStatus'));
    }
    
 

}