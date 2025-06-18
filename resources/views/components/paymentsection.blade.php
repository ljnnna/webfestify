<!-- Payment Section -->
<section class="space-y-6 flex flex-col h-full">
    <header>
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#5B4B7A] pb-4 border-b border-gray-300">
            PAYMENT
        </h2>
    </header>
    
    <!-- Payment Form -->
    <form class="space-y-6 flex flex-col flex-grow" id="paymentForm">
        @csrf
        
        <!-- Payment Method Selection -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-[#5B4B7A] mb-3">Select Payment Method</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Bank Transfer -->
                <button 
                    type="button"
                    class="payment-method-btn group relative p-4 border-2 border-gray-300 rounded-xl hover:border-[#B6B0F7] transition-all duration-300 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#B6B0F7] focus:ring-opacity-50"
                    data-method="bank"
                >
                    <div class="flex flex-col items-center space-y-3">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#B6B0F7] to-[#8B7ED8] rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-university text-2xl text-white"></i>
                        </div>
                        <div class="text-center">
                            <p class="font-semibold text-[#5B4B7A] mb-1">Bank Transfer</p>
                            <p class="text-xs text-gray-500">Secure bank payment</p>
                        </div>
                    </div>
                    <!-- Selection indicator -->
                    <div class="absolute top-3 right-3 w-5 h-5 rounded-full border-2 border-gray-300 bg-white transition-all duration-200 payment-method-indicator">
                        <div class="w-full h-full rounded-full bg-[#B6B0F7] scale-0 transition-transform duration-200 payment-method-check"></div>
                    </div>
                </button>
                
                <!-- E-Wallet -->
                <button 
                    type="button"
                    class="payment-method-btn group relative p-4 border-2 border-gray-300 rounded-xl hover:border-[#B6B0F7] transition-all duration-300 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#B6B0F7] focus:ring-opacity-50"
                    data-method="ewallet"
                >
                    <div class="flex flex-col items-center space-y-3">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#B6B0F7] to-[#8B7ED8] rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-wallet text-2xl text-white"></i>
                        </div>
                        <div class="text-center">
                            <p class="font-semibold text-[#5B4B7A] mb-1">E-Wallet</p>
                            <p class="text-xs text-gray-500">Digital wallet payment</p>
                        </div>
                    </div>
                    <!-- Selection indicator -->
                    <div class="absolute top-3 right-3 w-5 h-5 rounded-full border-2 border-gray-300 bg-white transition-all duration-200 payment-method-indicator">
                        <div class="w-full h-full rounded-full bg-[#B6B0F7] scale-0 transition-transform duration-200 payment-method-check"></div>
                    </div>
                </button>
            </div>
        </div>
        
        <!-- Hidden input to store selected payment method -->
        <input type="hidden" id="selectedPaymentMethod" name="payment_method" required>
        
        <!-- Terms and Conditions -->
        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 mt-1">
                    <input 
                        class="w-4 h-4 text-[#B6B0F7] bg-gray-100 border-gray-300 rounded focus:ring-[#B6B0F7] focus:ring-2" 
                        id="terms" 
                        name="terms"
                        type="checkbox" 
                        required
                    />
                </div>
                <label class="text-sm text-gray-700 leading-relaxed cursor-pointer" for="terms">
                    I have read and agree to the 
                    <a href="{{ route('tandc') }}" class="text-[#5B4B7A] underline hover:text-[#6B5DD3] transition-colors duration-200 font-medium">
                        terms and conditions
                    </a> and understand the rental policies.
                </label>
            </div>
        </div>
        
        <!-- Spacer to push buttons to bottom -->
        <div class="flex-grow"></div>
        
        <!-- Action Buttons - Now at bottom -->
        <div class="space-y-4 pt-2 mt-auto">
            <!-- Primary Payment Button -->
            <button 
                class="w-full py-4 px-6 text-white font-bold text-lg rounded-xl bg-gradient-to-r from-[#8B7ED8] to-[#B6B0F7] shadow-lg hover:shadow-xl hover:from-[#7A6BC7] hover:to-[#A299E6] transform hover:scale-[1.02] transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-[#B6B0F7] focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed" 
                type="submit"
                id="payButton"
            >
                <div class="flex items-center justify-center space-x-2">
                    <i class="fas fa-lock text-sm"></i>
                    <span>Pay Rp. {{ number_format($paymentData['pricing']['total'], 0, ',', '.') }}</span>
                </div>
            </button>
            
            <!-- Secondary Action Buttons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <button 
                    class="flex items-center justify-center space-x-2 py-3 px-4 text-[#5B4B7A] font-semibold text-sm rounded-xl border-2 border-[#B6B0F7] bg-white hover:bg-[#F9F7FF] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#B6B0F7] focus:ring-opacity-50" 
                    type="button"
                    onclick="cancelOrder()"
                >
                    <i class="fas fa-times text-sm"></i>
                    <span>CANCEL ORDER</span>
                </button>
                
                <button 
                    class="flex items-center justify-center space-x-2 py-3 px-4 text-[#5B4B7A] font-semibold text-sm rounded-xl border-2 border-[#B6B0F7] bg-white hover:bg-[#F9F7FF] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#B6B0F7] focus:ring-opacity-50" 
                    type="button"
                    onclick="goBackToCart()"
                >
                    <i class="fas fa-arrow-left text-sm"></i>
                    <span>BACK TO CART</span>
                </button>
            </div>
        </div>
    </form>
</section>

<!-- Loading Modal -->
<div id="loadingModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center backdrop-blur-sm">
    <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-sm mx-4">
        <div class="flex flex-col items-center space-y-4">
            <div class="relative">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-gray-200"></div>
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-t-[#B6B0F7] absolute top-0 left-0"></div>
            </div>
            <div class="text-center">
                <h3 class="text-[#5B4B7A] font-bold text-lg mb-1">Processing Payment</h3>
                <p class="text-gray-600 text-sm">Please wait while we secure your payment...</p>
            </div>
        </div>
    </div>
</div>

<!-- Include Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>

<style>
/* Custom Transitions */
.transition-smooth {
    transition: all 0.3s ease-in-out;
}

/* Payment method button active state */
.payment-method-active {
    border-color: #B6B0F7 !important;
    background: linear-gradient(135deg, rgba(249, 217, 255, 0.1) 0%, rgba(182, 176, 247, 0.1) 100%) !important;
    box-shadow: 0 4px 12px rgba(182, 176, 247, 0.2) !important;
}

.payment-method-active .payment-method-check {
    transform: scale(0.7) !important;
}

.payment-method-active .payment-method-indicator {
    border-color: #B6B0F7 !important;
}

/* Hover Effects */
.hover-lift:hover {
    transform: translateY(-2px);
}

/* Custom animations */
@keyframes pulse-subtle {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

.animate-pulse-subtle {
    animation: pulse-subtle 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Payment method selection handling
    const paymentMethodBtns = document.querySelectorAll('.payment-method-btn');
    const selectedPaymentInput = document.getElementById('selectedPaymentMethod');
    const loadingModal = document.getElementById('loadingModal');
    const payButton = document.getElementById('payButton');
    
    paymentMethodBtns.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active state from all payment buttons
            paymentMethodBtns.forEach(btn => {
                btn.classList.remove('payment-method-active');
            });
            
            // Add active state to clicked button
            this.classList.add('payment-method-active');
            
            // Set selected payment method
            const method = this.getAttribute('data-method');
            selectedPaymentInput.value = method;
            
            // Enable pay button
            payButton.disabled = false;
            payButton.classList.remove('opacity-50', 'cursor-not-allowed');
        });
    });
    
    // Form validation and submission
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const termsCheckbox = document.getElementById('terms');
        const selectedMethod = selectedPaymentInput.value;
        
        if (!selectedMethod) {
            showAlert('Please select a payment method.', 'warning');
            return;
        }
        
        if (!termsCheckbox.checked) {
            showAlert('Please accept the terms and conditions to proceed.', 'warning');
            return;
        }
        
        // Show loading modal
        loadingModal.classList.remove('hidden');
        loadingModal.classList.add('flex');
        
        // Disable pay button
        payButton.disabled = true;
        payButton.classList.add('opacity-50', 'cursor-not-allowed');
        
        // Prepare form data
        const formData = new FormData(this);
        
        // Send request to create payment
        fetch('{{ route("payment.process") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Hide loading modal
            loadingModal.classList.add('hidden');
            loadingModal.classList.remove('flex');
            
            // Re-enable pay button
            payButton.disabled = false;
            payButton.classList.remove('opacity-50', 'cursor-not-allowed');
            
            if (data.success) {
                // Open Midtrans Snap popup
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        console.log('Payment success:', result);
                        showAlert('Payment successful! Redirecting...', 'success');
                        setTimeout(() => {
                            window.location.href = '{{ route("payment.finish") }}';
                        }, 2000);
                    },
                    onPending: function(result) {
                        console.log('Payment pending:', result);
                        showAlert('Payment is pending. Please complete your payment.', 'info');
                    },
                    onError: function(result) {
                        console.log('Payment error:', result);
                        showAlert('Payment failed. Please try again.', 'error');
                    },
                    onClose: function() {
                        console.log('Payment popup closed');
                    }
                });
            } else {
                showAlert('Error: ' + data.message, 'error');
            }
        })
        .catch(error => {
            // Hide loading modal
            loadingModal.classList.add('hidden');
            loadingModal.classList.remove('flex');
            
            // Re-enable pay button
            payButton.disabled = false;
            payButton.classList.remove('opacity-50', 'cursor-not-allowed');
            
            console.error('Error:', error);
            showAlert('An error occurred. Please try again.', 'error');
        });
    });
    
    // Initialize pay button as disabled
    payButton.disabled = true;
    payButton.classList.add('opacity-50', 'cursor-not-allowed');
});

// Enhanced alert function
function showAlert(message, type = 'info') {
    const alertColors = {
        success: 'bg-green-100 border-green-400 text-green-700',
        error: 'bg-red-100 border-red-400 text-red-700',
        warning: 'bg-yellow-100 border-yellow-400 text-yellow-700',
        info: 'bg-blue-100 border-blue-400 text-blue-700'
    };
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-lg border-l-4 ${alertColors[type]} shadow-lg transform transition-all duration-300 translate-x-full`;
    alertDiv.innerHTML = `
        <div class="flex items-center">
            <span class="text-sm font-medium">${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-3 text-current hover:text-opacity-75">
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Animate in
    setTimeout(() => {
        alertDiv.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        alertDiv.classList.add('translate-x-full');
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 300);
    }, 5000);
}

// Business logic functions
function cancelOrder() {
    if (confirm('Are you sure you want to cancel this order? This action cannot be undone.')) {
        console.log('Order cancelled');
        showAlert('Order cancelled. Redirecting to home...', 'info');
        setTimeout(() => {
            window.location.href = "{{ route('home') }}";
        }, 2000);
    }
}

function goBackToCart() {
    console.log('Navigating back to cart');
    window.location.href = "{{ route('cart') }}";
}
</script>