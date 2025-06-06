@extends('layouts.payment')

@section('title', 'Payment Customer - Festify')

@section('body-class', 'bg-gradient-to-b from-[#F9D9FF] to-[#D9D9FF] min-h-screen')

@section('content')
<!-- Include Navbar -->
@include('components.navbar')

<main class="pt-24 container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white/90 rounded-xl shadow-lg p-6 sm:p-8 lg:p-10 backdrop-blur-sm">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">

                @include('components.orderdetailssection')
                @include('components.paymentsection')

            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
// Business logic functions yang mungkin dipanggil dari navbar
function cancelOrder() {
    if (confirm('Are you sure you want to cancel this order?')) {
        console.log('Order cancelled');
        // Add your cancellation logic here
        // window.location.href = '/dashboard';
    }
}

function goBackToCart() {
    console.log('Navigating back to cart');
    // Add your navigation logic here  
    // window.location.href = '/cart';
}

// Mobile drawer functions (from navbar)
function openDrawer() {
    document.getElementById('mobile-drawer').classList.remove('translate-x-full');
    document.getElementById('drawer-overlay').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDrawer() {
    document.getElementById('mobile-drawer').classList.add('translate-x-full');
    document.getElementById('drawer-overlay').classList.add('hidden');
    document.body.style.overflow = '';
}

// Auto-close drawer when clicking on navigation links
document.addEventListener('DOMContentLoaded', function() {
    const drawerLinks = document.querySelectorAll('#mobile-drawer a');
    drawerLinks.forEach(link => {
        link.addEventListener('click', closeDrawer);
    });
    
    // Keyboard navigation - close drawer on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDrawer();
        }
    });
});
</script>
@endsection