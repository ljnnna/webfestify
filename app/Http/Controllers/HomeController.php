<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        logger('Middleware constructor dijalankan.');
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();

        if (!$user) {
            return redirect('/login')->withErrors('Autentikasi gagal, silakan login ulang.');
        }

        $usertype = $user->usertype;

        if($usertype == 'customer') {
            return view('home');
        } else if($usertype == 'admin') {
            $data = DashboardController::getDashboardData();
            return view('admin.dashboardfestify', $data);
        } else {
            Auth::logout();
            return redirect('/login')->withErrors('Akun tidak memiliki akses valid.');
        }
    }

    public function post(){
        return view("post");
    }
}
