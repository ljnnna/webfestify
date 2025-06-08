<!-- Payment Section -->
<section class="space-y-6">
    <header>
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#5B4B7A] pb-4 border-b border-gray-300">
            PAYMENT
        </h2>
    </header>
    
    <!-- Payment Form -->
    <form class="space-y-6" id="paymentForm">
        @csrf
        
        <!-- Payment Method Selection -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-[#5B4B7A]">Select Payment Method</h3>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                <button 
                    type="button"
                    class="payment-method-btn p-3 border-2 border-gray-300 rounded-lg hover:border-[#B6B0F7] transition-all duration-200 hover:scale-105"
                    data-method="qris"
                >
                    <i class="fas fa-qrcode text-2xl text-[#5B4B7A] mb-2"></i>
                    <p class="text-xs font-semibold text-[#5B4B7A]">QRIS</p>
                </button>
                
                <button 
                    type="button"
                    class="payment-method-btn p-3 border-2 border-gray-300 rounded-lg hover:border-[#B6B0F7] transition-all duration-200 hover:scale-105"
                    data-method="bank"
                >
                    <i class="fas fa-university text-2xl text-[#5B4B7A] mb-2"></i>
                    <p class="text-xs font-semibold text-[#5B4B7A]">Bank Transfer</p>
                </button>
                
                <button 
                    type="button"
                    class="payment-method-btn p-3 border-2 border-gray-300 rounded-lg hover:border-[#B6B0F7] transition-all duration-200 hover:scale-105"
                    data-method="ewallet"
                >
                    <i class="fas fa-wallet text-2xl text-[#5B4B7A] mb-2"></i>
                    <p class="text-xs font-semibold text-[#5B4B7A]">E-Wallet</p>
                </button>
            </div>
        </div>
        
        <!-- Hidden input to store selected payment method -->
        <input type="hidden" id="selectedPaymentMethod" name="payment_method" required>
        
        <!-- Terms and Conditions -->
        <div class="flex flex-col items-center gap-3 p-4 bg-gray-50 rounded-lg">
            <div class="flex items-start gap-3">
                <input 
                    class="w-4 h-4 border border-gray-400 rounded-sm mt-0.5 flex-shrink-0 focus:ring-2 focus:ring-[#B6B0F7]" 
                    id="terms" 
                    name="terms"
                    type="checkbox" 
                    required
                />
                <label class="text-sm text-gray-700 leading-relaxed cursor-pointer text-center" for="terms">
                    I have read and agree to the 
                    <a href="{{ route('tandc') }}" class="text-[#5B4B7A] underline hover:text-[#6B5DD3] transition-smooth">
                        terms and conditions
                    </a>
                </label>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="space-y-3">
            <!-- Primary Payment Button -->
            <button 
                class="w-full py-4 text-[#5B4B7A] font-extrabold text-lg sm:text-xl rounded-full bg-gradient-to-r from-[#B6B0F7] to-[#F9D9FF] shadow-md hover:brightness-105 transition-all duration-200 transform hover:scale-[1.02]" 
                type="submit"
                id="payButton"
            >
                Pay Rp. 100.000
            </button>
            
            <!-- Secondary Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <button 
                    class="flex-1 flex items-center justify-center gap-2 py-3 text-[#5B4B7A] font-semibold text-sm rounded-full border-2 border-[#B6B0F7] hover:bg-[#F9D9FF] transition-all duration-200" 
                    type="button"
                    onclick="cancelOrder()"
                >
                    CANCEL ORDER
                </button>
                
                <button 
                    class="flex-1 flex items-center justify-center gap-2 py-3 text-[#5B4B7A] font-semibold text-sm rounded-full border-2 border-[#B6B0F7] hover:bg-[#F9D9FF] transition-all duration-200" 
                    type="button"
                    onclick="goBackToCart()"
                >
                    <i class="fas fa-arrow-left"></i>
                    Back to Cart
                </button>
            </div>
        </div>
    </form>
</section>

<style>
/* Custom Transitions */
.transition-smooth {
    transition: all 0.3s ease-in-out;
}

/* Payment method button active state */
.payment-method-active {
    border-color: #B6B0F7 !important;
    background-color: rgba(249, 217, 255, 0.2);
}

/* Hover Effects */
.hover-lift:hover {
    transform: translateY(-2px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Payment method selection handling
    const paymentMethodBtns = document.querySelectorAll('.payment-method-btn');
    const selectedPaymentInput = document.getElementById('selectedPaymentMethod');
    
    paymentMethodBtns.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active state from all payment buttons
            paymentMethodBtns.forEach(btn => {
                btn.classList.remove('payment-method-active');
                btn.classList.add('border-gray-300');
            });
            
            // Add active state to clicked button
            this.classList.remove('border-gray-300');
            this.classList.add('payment-method-active');
            
            // Set selected payment method
            const method = this.getAttribute('data-method');
            selectedPaymentInput.value = method;
        });
    });
    
    // Form validation and submission
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const termsCheckbox = document.getElementById('terms');
        const selectedMethod = selectedPaymentInput.value;
        
        if (!selectedMethod) {
            alert('Please select a payment method.');
            return;
        }
        
        if (!termsCheckbox.checked) {
            alert('Please accept the terms and conditions to proceed.');
            return;
        }
        
        // Handle payment processing
        console.log('Processing payment with method:', selectedMethod);
        alert('Payment processing... This is a demo.');
        
        // Here you would typically submit the form to your Laravel backend
        // this.submit();
    });
});

// Business logic functions
function cancelOrder() {
    if (confirm('Are you sure you want to cancel this order?')) {
        console.log('Order cancelled');
        // Redirect to dashboard using Laravel named route
        window.location.href = "{{ route('dashboard') }}";
    }
}

function goBackToCart() {
    console.log('Navigating back to cart');
    // Add your navigation logic here
    // window.location.href = '/cart'; // Example redirect
}
</script>