@php
    $user = auth()->user();
    $verificationStatus = $user->verification_status;
@endphp

@extends('layouts.app')

@section('title', 'Edit Profile')

@section('desktop-menu')
<div class="hidden lg:flex space-x-6 items-center">
    <a href="{{ route('home') }}"
        class="{{ request()->routeIs('home') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Home
    </a>
    <a href="{{ route('catalog') }}"
        class="{{ request()->routeIs('catalog') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Catalog
    </a>
    <a href="{{ route('team') }}"
        class="{{ request()->routeIs('team') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Team
    </a>
    <a href="{{ route('contact') }}"
        class="{{ request()->routeIs('contact') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Contact
    </a>
</div>
@endsection

@section('content')
<!-- Main Container -->
<div class="min-h-screen bg-gray-100">
    <div class="flex h-screen">

<!-- Fixed Sidebar -->
<x-sidebar-profile :user="auth()->user()" />

<!-- Main Content Area -->
<div class="flex-1 overflow-y-auto bg-gray-50">
    <div class="p-6">
        <div class="w-full pl-4 pr-6 space-y-6">
            
<!-- VERIFICATION FORM SECTION -->
@if ($user->isVerified())
<div x-data="{ open: false }" class="max-w-3xl mx-auto">
    <!-- Verified Badge with Gradient -->
    <div 
        class="bg-gradient-to-r from-violet-600 via-purple-500 to-rose-400 text-white rounded-full shadow-lg flex items-center justify-between px-6 py-2 mb-4 cursor-pointer transition-all duration-200 hover:shadow-xl"
        @click="open = !open"
    >
        <div class="flex items-center">
            <i class="fa-regular fa-circle-check text-white text-base mr-2"></i>
            <span class="font-semibold text-sm">You're Verified</span>
        </div>

        <!-- Icon toggle pakai Font Awesome -->
        <div class="ml-2">
            <i x-show="!open" class="fa-solid fa-chevron-down text-white text-sm"></i>
            <i x-show="open" x-cloak class="fa-solid fa-chevron-up text-white text-sm"></i>
        </div>
    </div>

    <!-- Expandable Section -->
    <div x-show="open" x-transition
         class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white border border-pink-300 rounded-xl p-4">
        @if ($user->ktp_photo)
            <div class="border border-pink-300 rounded-lg p-3">
                <h5 class="text-sm font-medium text-pink-800 mb-1">Foto KTP</h5>
                <img src="{{ Storage::url($user->ktp_photo) }}"
                     alt="KTP"
                     class="w-full h-32 object-cover rounded border">
            </div>
        @endif

        @if ($user->ktp_selfie_photo)
            <div class="border border-pink-300 rounded-lg p-3">
                <h5 class="text-sm font-medium text-pink-800 mb-1">Selfie dengan KTP</h5>
                <img src="{{ Storage::url($user->ktp_selfie_photo) }}"
                     alt="Selfie"
                     class="w-full h-32 object-cover rounded border">
            </div>
        @endif
    </div>
</div>

@else
    @if ($user->verification_status === 'pending')
        <!-- PENDING REVIEW STATUS (YELLOW) -->
        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-2xl shadow-sm p-6">
            <div class="flex items-center mb-6">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h2 class="text-xl font-semibold text-yellow-700">Documents Under Review</h2>
                    <p class="text-sm text-yellow-600">Our team is reviewing your submitted documents</p>
                    <p class="text-xs text-yellow-500 mt-1">
                        Submitted: {{ $user->verification_submitted_at ? $user->verification_submitted_at->format('d M Y, H:i') : '-' }}
                    </p>
                </div>
            </div>
            
            <!-- Show uploaded documents -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                @if ($user->ktp_photo)
                <div class="bg-white rounded-lg border p-4">
                    <h5 class="font-medium text-gray-800 mb-2">Submitted KTP:</h5>
                    <img src="{{ Storage::url($user->ktp_photo) }}" alt="KTP" class="max-w-full h-32 object-cover rounded border mx-auto">
                </div>
                @endif
                
                @if ($user->ktp_selfie_photo)
                <div class="bg-white rounded-lg border p-4">
                    <h5 class="font-medium text-gray-800 mb-2">Submitted Selfie:</h5>
                    <img src="{{ Storage::url($user->ktp_selfie_photo) }}" alt="Selfie with KTP" class="max-w-full h-32 object-cover rounded border mx-auto">
                </div>
                @endif
            </div>
        </div>
    @elseif ($user->verification_status === 'rejected')
        <!-- REJECTED STATUS (RED) -->
        <div x-data="verificationForm()" class="bg-red-50 border-2 border-red-200 rounded-2xl shadow-sm p-6">
            <form method="POST" action="{{ route('profile.verify') }}" enctype="multipart/form-data">
                @csrf
                <!-- Header -->
                <div class="flex items-start gap-3 mb-4">
                    <div class="text-red-600 text-5xl">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-red-700">Verification Rejected</h2>
                        <p class="text-sm text-red-600 mt-1">Your documents could not be verified. Please review the reason and try again.</p>
                    </div>
                </div>

                <!-- Alasan Penolakan -->
                @if ($user->verification_notes)
                <p class="flex items-center gap-2 text-sm text-red-700 bg-red-200/60 px-4 py-2 border border-red-300 rounded-md mb-6 mt-4">
                    <i class="fas fa-info-circle text-red-600"></i>
                    <span><strong>Rejection Reason:</strong> {{ $user->verification_notes }}</span>
                </p>
                @endif

                <!-- Form Upload -->
                @include('partials.verification-upload-fields', ['status' => 'rejected'])
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" 
                            :disabled="!ktpUploaded || !selfieUploaded || isSubmitting"
                            :class="ktpUploaded && selfieUploaded && !isSubmitting ? 
                                   'bg-red-600 hover:bg-red-700 cursor-pointer' : 
                                   'bg-gray-400 cursor-not-allowed'"
                            class="inline-flex items-center px-6 py-3 text-white font-semibold rounded-lg shadow transition-all duration-200 disabled:opacity-50">
                        <span x-show="!isSubmitting">Resubmit Verification</span>
                        <span x-show="isSubmitting" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Submitting...
                        </span>
                    </button>

                    <!-- Warning jika belum upload -->
                    <p x-show="!ktpUploaded || !selfieUploaded" class="mt-2 text-xs text-red-600">
                        Silakan unggah ulang foto KTP dan selfie sebelum mengirim ulang verifikasi.
                    </p>
                </div>
                </div>
            </form>
        </div>

    @else
        <!-- NOT UPLOADED STATUS (RED) -->
        <div x-data="verificationForm()" class="bg-red-50 border-2 border-red-200 rounded-2xl shadow-sm p-6">
            <form method="POST" action="{{ route('profile.verify') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="flex items-center mb-6">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-600 text-4xl"></i>
                    </div>
                    <div class="ml-3">
                        <h2 class="text-xl font-semibold text-red-700">Identity Verification Required</h2>
                        <p class="text-sm text-red-600">Upload documents to activate rental features</p>
                    </div>
                </div>

                <!-- Form upload fields -->
                @include('partials.verification-upload-fields', ['status' => 'new'])
                
                <!-- Tips Section -->
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Tips for successful verification:</h3>
                            <div class="mt-1 text-sm text-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Make sure KTP photo is clear and not blurry</li>
                                    <li>Avoid light reflections on the KTP</li>
                                    <li>Face and KTP must be clearly visible in the selfie</li>
                                    <li>Use adequate lighting</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" 
                            :disabled="!ktpUploaded || !selfieUploaded || isSubmitting"
                            :class="ktpUploaded && selfieUploaded && !isSubmitting ? 
                                   'bg-red-600 hover:bg-red-700 cursor-pointer' : 
                                   'bg-gray-400 cursor-not-allowed'"
                            class="inline-flex items-center px-6 py-3 text-white font-semibold rounded-lg shadow transition-all duration-200 disabled:opacity-50">
                        <span x-show="!isSubmitting">Submit Verification</span>
                        <span x-show="isSubmitting" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Submitting...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    @endif
@endif

<!-- AlpineJS Component -->
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('verificationForm', () => ({
        ktpPreview: null,
        selfiePreview: null,
        ktpUploaded: false,
        selfieUploaded: false,
        isSubmitting: false,

        init() {
            // Check if there are existing files (for rejected case)
            @if($user->verification_status === 'rejected')
                @if($user->ktp_photo)
                    this.ktpPreview = '{{ Storage::url($user->ktp_photo) }}';
                    this.ktpUploaded = true;
                @endif
                @if($user->ktp_selfie_photo)
                    this.selfiePreview = '{{ Storage::url($user->ktp_selfie_photo) }}';
                    this.selfieUploaded = true;
                @endif
            @endif
        },

        handleKtpUpload(event) {
            this.uploadFile(event, 'ktp');
        },

        handleSelfieUpload(event) {
            this.uploadFile(event, 'selfie');
        },

        uploadFile(event, type) {
            const file = event.target.files[0];
            if (!file) return;

            // Validate file type
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                alert('Please upload a valid image file (JPEG, JPG, PNG)');
                return;
            }

            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size should not exceed 5MB');
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                if (type === 'ktp') {
                    this.ktpPreview = e.target.result;
                    this.ktpUploaded = true;
                } else {
                    this.selfiePreview = e.target.result;
                    this.selfieUploaded = true;
                }
            };
            reader.readAsDataURL(file);
        },

        removeKtpPreview() {
            this.ktpPreview = null;
            this.ktpUploaded = false;
            document.getElementById('ktp_photo').value = '';
        },

        removeSelfiePreview() {
            this.selfiePreview = null;
            this.selfieUploaded = false;
            document.getElementById('selfie_with_ktp').value = '';
        }
    }));
});

document.querySelector('input[name="picture"]').addEventListener('change', function() {
    if (this.files && this.files[0]) {
        document.getElementById('profile-picture-form').submit();
    }
});
</script>
<!-- END VERIFICATION FORM SECTION -->

                    <!-- PROFILE EDIT FORM -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="border-b border-gray-200 pb-4 mb-6">
                            <h1 class="text-2xl font-bold text-gray-900">Account Settings</h1>
                            <p class="text-gray-600 mt-1">Manage your personal information and account preferences</p>
                        </div>

                        @if (session('success'))
                            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.saveAll') }}" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <!-- Personal Information Section -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Personal Information</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                                               required>
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                                               required>
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    </div>
                                </div>

                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <textarea name="address" id="address" rows="3" 
                                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('address', $user->address) }}</textarea>
                                </div>
                            </div>

                            <!-- Security Section -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Security</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                        <input type="password" name="current_password" id="current_password" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Leave blank if you don't want to change password</p>
                                    </div>

                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                        <input type="password" name="password" id="password" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    </div>

                                    <div class="md:col-span-2">
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    </div>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="flex justify-end pt-4">
                                <button type="submit" 
                                        class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- DELETE ACCOUNT SECTION -->
                    <div class="bg-red-50 border border-red-200 rounded-2xl shadow-sm p-6">
                        <h2 class="text-2xl font-bold text-red-800 mb-4">Delete Account</h2>
                        <p class="text-red-700 mb-6">
                            Once your account is deleted, all data and information will be permanently deleted. 
                            Please download any data you wish to keep before deleting your account.
                        </p>

                        <button type="button"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Account Deletion Confirmation Modal -->
<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            Are you sure you want to delete your account?
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            After your account is deleted, all data and information will be permanently deleted. 
            Please enter your password to confirm you want to permanently delete your account.
        </p>

        <div class="mt-6">
            <label for="password" class="sr-only">Password</label>
            <input id="password"
                   name="password"
                   type="password"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                   placeholder="Password">

            @error('password', 'userDeletion')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" 
                    x-on:click="$dispatch('close')" 
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg transition-colors">
                Cancel
            </button>

            <button type="submit" 
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                Delete Account
            </button>
        </div>
    </form>
</x-modal>



@endsection