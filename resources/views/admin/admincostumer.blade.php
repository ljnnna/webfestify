@extends('layouts.admin')

@section('title', 'User')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-[#493862]">Customer Overview</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total User -->
        <x-card-stat title="Total User" :value="$total_customers" />

        <!-- Active User -->
        <x-card-stat title="Active User" :value="$active_users ?? 0" />

        <!-- New Signups -->
        <x-card-stat title="New Signups" :value="$new_signups ?? 0" />

        <!-- Feedback -->
        <x-card-stat title="Feedback Received" :value="$feedback_count ?? 0" />
        
    </div>

    <!-- Section untuk verifikasi Customer -->
    <div class="mt-10 overflow-x-auto">
        <table class="w-full text-sm text-center text-gray-700 border border-gray-200 rounded-lg">
            <thead class="text-xs text-white uppercase bg-[#d3b9f6]">
                <tr>
                    <th class="px-6 py-3">Username</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Verification Status</th>
                    <th class="px-6 py-3">Verification Notes</th>
                    <th class="px-6 py-3">KTP</th>
                    <th class="px-6 py-3">Selfie KTP</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($users as $user)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <!-- Username -->
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $user->name }}
                    </td>
                    
                    <!-- Email -->
                    <td class="px-6 py-4 text-gray-700">
                        {{ $user->email }}
                    </td>
                    
                    <!-- Verification Status -->
                    <td class="px-6 py-4">
                        @if($user->verification_status == 'pending')
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu Verifikasi
                            </span>
                        @elseif($user->verification_status == 'approved')
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                Terverifikasi
                            </span>
                        @elseif($user->verification_status == 'rejected')
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                Ditolak
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                Belum Submit
                            </span>
                        @endif
                    </td>
                    
                    <!-- Verification Notes -->
                    <td class="px-6 py-4 text-gray-700">
                        {{ $user->verification_notes ?? '-' }}
                    </td>
                    
                    <!-- KTP Photo -->
                    <td class="px-6 py-4">
                        @if($user->ktp_photo)
                            <img src="{{ $user->ktp_photo_url }}" 
                                alt="KTP {{ $user->name }}" 
                                class="w-20 h-12 object-cover rounded border cursor-pointer"
                                onclick="openModal('{{ $user->ktp_photo_url }}', 'KTP {{ $user->name }}')">
                        @else
                            <span class="text-gray-400">Tidak ada foto</span>
                        @endif
                    </td>
                    
                    <!-- Selfie KTP Photo -->
                    <td class="px-6 py-4">
                        @if($user->ktp_selfie_photo)
                            <img src="{{ $user->ktp_selfie_photo_url }}" 
                                alt="Selfie KTP {{ $user->name }}" 
                                class="w-20 h-12 object-cover rounded border cursor-pointer"
                                onclick="openModal('{{ $user->ktp_selfie_photo_url }}', 'Selfie KTP {{ $user->name }}')">
                        @else
                            <span class="text-gray-400">Tidak ada foto</span>
                        @endif
                    </td>
                    
                    <!-- Action Buttons -->
                    <td class="px-6 py-4">
                        @if($user->verification_status == 'pending')
                            <div class="flex space-x-2">
                                <!-- Approve Button -->
                                <form action="{{ route('admin.user.verification.approve', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="px-3 py-1 bg-green-500 text-white text-xs rounded hover:bg-green-600 transition"
                                            onclick="return confirm('Yakin ingin approve user ini?')">
                                        Approve
                                    </button>
                                </form>
                                
<!-- Reject Button with input -->
<form action="{{ route('admin.user.verification.reject', $user) }}" method="POST" class="inline-block">
    @csrf
    <input type="text" name="rejection_reason" placeholder="Alasan penolakan..." 
           class="text-xs border px-2 py-1 rounded mb-1 w-full" required>
    <button type="submit" 
            class="w-full px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition"
            onclick="return confirm('Yakin ingin reject user ini?')">
        Reject
    </button>
</form>

                            </div>
                        @else
                            <span class="text-gray-400 text-sm">
                                Sudah di{{ $user->verification_status == 'approved' ? 'approve' : 'reject' }}
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach

                <!-- Jika tidak ada data -->
                @if($users->isEmpty())
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        Tidak ada data user untuk verifikasi
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Modal untuk melihat foto -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 z-50" style="display: none;">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white p-4 rounded-lg max-w-2xl max-h-full relative">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modalTitle" class="text-lg font-semibold"></h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <img id="modalImage" src="" alt="" class="max-w-full max-h-96 object-contain mx-auto">
            </div>
        </div>
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
    
    <!-- Section Review Customer -->
    <div class="mt-12">
        <h2 class="text-2xl font-semibold mb-4 text-[#3a2e52]">Review Customer</h2>
        <div class="bg-white rounded-xl shadow p-6 space-y-4">
            @forelse ($reviews as $review)
            <x-review-item 
            :username="$review->user->username ?? '-'" 
            :product="$review->product->name ?? '-'" 
            :content="$review->content" 
            :date="$review->created_at->format('d M Y')" 
            />
            @empty
            <p class="text-gray-500">Belum ada review dari customer.</p>
            @endforelse
        </div>
    </div>

    <script>
    function openModal(imageSrc, title) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('imageModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }

    // Close modal when clicking outside
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    </script>
@endsection