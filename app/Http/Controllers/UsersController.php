<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;



class UsersController extends Controller
{
    public function index()
    {
        // User statistics
        $total_customers = User::where('usertype', 'user')->count();
        $active_users = User::where('usertype', 'user')
                          ->where('usertype', 'active')
                          ->count();
        
        // New signups in the last 30 days
        $new_signups = User::where('usertype', 'user')
                         ->where('created_at', '>=', Carbon::now()->subDays(30))
                         ->count();
         // Feedback count
         $feedback_count = Feedback::count();

         return view('admin.dashboard', [
            'total_customers' => $total_customers,
            'active_users' => $active_users,
            'new_signups' => $new_signups,
            'feedback_count' => $feedback_count,
        ]);
    }
}  