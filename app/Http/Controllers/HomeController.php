<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;

class HomeController extends Controller
{
    public function __construct()
    {
        logger('Middleware constructor dijalankan.');
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect('/login')->withErrors('Autentikasi gagal, silakan login ulang.');
        }
    
        if ($user->usertype == 'customer') {
            $categoryId = $request->query('category');
    
            $products = Product::with(['images', 'category'])
                ->active()
                ->when($categoryId, function ($query) use ($categoryId) {
                    return $query->where('category_id', $categoryId);
                })
                ->latest()
                ->get();
    
            // Ambil semua kategori dari tabel kategori
            $categories = Category::all();
    
            return view('home', compact('products', 'categories', 'categoryId'));
        } elseif ($user->usertype == 'admin') {
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
