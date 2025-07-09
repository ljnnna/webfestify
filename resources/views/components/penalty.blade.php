                <!-- Penalty Information -->
                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <span class="bg-red-100 text-red-600 p-2 rounded-full mr-3">
                            <i class="fas fa-exclamation-triangle text-sm"></i>
                        </span>
                        <span>Penalty Information</span>
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Due Date</span>
                            <span class="text-sm font-medium">{{ $order->end_date->format('d M Y, H:i') }}</span>
                        </div>
                        
                        @if($order->penalties && $order->penalties->count() > 0)
                            <div class="bg-red-50 rounded-lg p-3 border border-red-100">
                                <h4 class="text-sm font-semibold text-red-800 mb-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    Applied Penalties:
                                </h4>
                                <div class="space-y-2">
                                    @php $totalPenalty = 0; @endphp
                                    @foreach($order->penalties as $penalty)
                                        <div class="flex justify-between items-center text-xs">
                                            <span class="text-red-700">{{ $penalty->description }}</span>
                                            <span class="font-semibold text-red-600">
                                                Rp {{ number_format($penalty->amount, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        @php $totalPenalty += $penalty->amount; @endphp
                                    @endforeach
                                    
                                    @if($order->penalties->count() > 1)
                                        <div class="border-t border-red-200 pt-2 mt-2">
                                            <div class="flex justify-between items-center text-xs font-bold">
                                                <span class="text-red-800">Total Penalty</span>
                                                <span class="text-red-600">
                                                    Rp {{ number_format($totalPenalty, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="bg-green-50 rounded-lg p-4 text-center border border-green-100">
                                <i class="fas fa-check-circle text-green-500 text-xl mb-2"></i>
                                <p class="text-sm text-green-700 font-medium">No Penalties Applied</p>
                                <p class="text-xs text-green-600 mt-1">Return as scheduled</p>
                            </div>
                        @endif
                        
                        <div class="text-xs text-gray-500 bg-gray-50 rounded p-3 border border-gray-100">
                            <p class="font-medium mb-1 text-gray-600">Possible Penalties:</p>
                            <ul class="space-y-1">
                                <li class="flex items-start">
                                    <i class="fas fa-clock text-xs mt-0.5 mr-1.5 text-gray-400"></i>
                                    <span>Late return fee (Rp50,000/day)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-times-circle text-xs mt-0.5 mr-1.5 text-gray-400"></i>
                                    <span>Item damage or missing parts</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-broom text-xs mt-0.5 mr-1.5 text-gray-400"></i>
                                    <span>Excessive cleaning required</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>