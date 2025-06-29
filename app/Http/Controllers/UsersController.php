<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Review;

class UsersController extends Controller
{
    public function index()
    {
        // User statistics
        $total_customers = User::where('usertype', 'customer')->count();
        $active_users = User::where('usertype', 'user')
                          ->where('usertype', 'active')
                          ->count();
        
        // New signups in the last 30 days
        $new_signups = User::where('usertype', 'user')
                         ->where('created_at', '>=', Carbon::now()->subDays(30))
                         ->count();
         // Feedback count
         $feedback_count = Review::count();

         $reviews = Review::with(['user', 'product'])->latest()->take(5)->get();

         $users = User::latest()->paginate(15);

         return view('admin.admincostumer', [
            'total_customers' => $total_customers,
            'active_users' => $active_users,
            'new_signups' => $new_signups,
            'feedback_count' => $feedback_count,
            'reviews' => $reviews,
            'users' => $users,
        ]);
    }

    public function verification(Request $request)
    {
        $query = User::query();
        
        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->where('verification_status', $request->status);
        }
        
        // Filter berdasarkan search (nama atau email)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        
        // Hanya tampilkan user yang sudah submit dokumen
        $query->whereNotNull('ktp_photo')
              ->whereNotNull('ktp_selfie_photo');
        
        // Urutkan berdasarkan status dan waktu submit
        $query->orderByRaw("CASE 
                            WHEN verification_status = 'pending' THEN 1 
                            WHEN verification_status = 'rejected' THEN 2 
                            WHEN verification_status = 'approved' THEN 3 
                            END")
              ->orderBy('verification_submitted_at', 'asc');
        
        $users = $query->paginate(15);
        
        // Hitung statistik verifikasi
        $verification_stats = [
            'total' => User::whereNotNull('ktp_photo')->whereNotNull('ktp_selfie_photo')->count(),
            'pending' => User::pendingVerification()->count(),
            'approved' => User::verified()->count(),
            'rejected' => User::rejected()->count(),
        ];
        
        return view('admin.admincostumer', compact('users', 'verification_stats'));
    }
    
    /**
     * Approve verifikasi user (sederhana)
     */
    public function approveVerification(User $user)
    {
        $user->update([
            'verification_status' => 'approved',
            'verified_at' => now(),
        ]);
        
        return redirect()->back()->with('success', 'User berhasil diverifikasi');
    }
    
    /**
     * Reject verifikasi user (sederhana)
     */
    public function rejectVerification(User $user)
    {
        $user->update([
            'verification_status' => 'rejected',
            'verified_at' => now(),
        ]);
        
        return redirect()->back()->with('error', 'Verifikasi user ditolak');
    }
}  