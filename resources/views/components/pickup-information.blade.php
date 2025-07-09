                <!-- Pickup Information -->
                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <h2 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3">
                            <i class="fas fa-truck text-sm"></i>
                        </span>
                        <span>Pickup Information</span>
                    </h2>
                    
                    <div class="bg-blue-50 rounded-lg p-4 mb-4 border border-blue-100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-0.5">
                                <i class="fas fa-info-circle text-blue-500"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Pickup Instructions</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <ul class="space-y-1.5">
                                        <li class="flex items-start">
                                            <i class="fas fa-phone-alt text-xs mt-1 mr-2 text-blue-500"></i>
                                            <span>Our courier will call you 30 minutes before arrival</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-box-open text-xs mt-1 mr-2 text-blue-500"></i>
                                            <span>Please have the item ready and packed securely</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-user-check text-xs mt-1 mr-2 text-blue-500"></i>
                                            <span>Ensure someone is available at the pickup address</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-white border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                            <h3 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-500 mr-2 text-sm"></i>
                                Pickup Address
                            </h3>
                            <p class="text-gray-900 text-sm">{{ $order->delivery_address ?? auth()->user()->address ?? 'Address not set' }}</p>
                            <a href="https://maps.google.com/?q={{ urlencode($order->delivery_address ?? auth()->user()->address ?? '') }}" 
                               target="_blank"
                               class="inline-flex items-center mt-2 text-xs text-blue-600 hover:text-blue-800">
                                <i class="fas fa-external-link-alt mr-1 text-xs"></i>
                                View on Map
                            </a>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                            <h3 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-user-circle text-blue-500 mr-2 text-sm"></i>
                                Contact Information
                            </h3>
                            <p class="text-gray-900 text-sm">{{ auth()->user()->name }}</p>
                            <p class="text-gray-900 text-sm">{{ auth()->user()->phone ?? 'Phone not set' }}</p>
                        </div>
                    </div>
                </div>
            </div>