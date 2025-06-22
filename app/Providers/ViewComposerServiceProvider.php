<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Order;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Kirim data orders ke semua view
        View::composer('components.navbaradmin', function ($view) {
            $orders = Order::with(['user', 'orderProducts'])->latest()->take(10)->get();
            $newOrderCount = Order::where('created_at', '>=')->count();

            $view->with([
                'orders' => $orders,
                'newOrderCount' => $newOrderCount,
            ]);
        });
    }
}
