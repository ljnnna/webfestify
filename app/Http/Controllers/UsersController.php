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

         return view('admin.admincostumer', [
            'total_customers' => $total_customers,
            'active_users' => $active_users,
            'new_signups' => $new_signups,
            'feedback_count' => $feedback_count,
            'reviews' => $reviews,
        ]);
    }
}  