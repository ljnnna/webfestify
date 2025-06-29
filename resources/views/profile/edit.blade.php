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
<!-- CONTAINER UTAMA dengan Fixed Height -->
<div class="min-h-screen bg-gray-100">
    <div class="flex h-screen">
        <!-- SIDEBAR FIXED - Sticky ke kiri -->
        <aside class="w-80 bg-gradient-to-b from-pink-100 to-blue-100 shadow-lg flex flex-col">
            <div class="p-6 flex flex-col items-center">
                <!-- Gambar Profil -->
                <x-profile-picture-upload :user="auth()->user()" />

                <!-- Menu Navigasi -->
                <nav class="mt-6 w-full space-y-3 text-center font-semibold text-gray-700">
                    <a href="{{ route('profile.edit') }}"
                       class="block px-4 py-3 rounded-full transition
                       {{ request()->routeIs('profile.edit') ? 'bg-white text-purple-800 font-bold shadow-md' : 'hover:bg-purple-100' }}">
                        ACCOUNT SETTING
                    </a>

                    <a href="{{ route('profile.rentalInfo') }}"
                       class="block px-4 py-3 rounded-full transition
                       {{ request()->routeIs('profile.rentalInfo') ? 'bg-white text-purple-800 font-bold shadow-md' : 'hover:bg-purple-100' }}">
                        RENTAL INFORMATION
                    </a>
                </nav>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 overflow-y-auto bg-gray-50">
            <div class="p-6">
                <div class="max-w-4xl mx-auto space-y-6">
                    
                    {{-- FORM VERIFIKASI --}}
                    @if (!auth()->user()->is_verified)
                        @php
                            $verification = auth()->user()->verification;
                            $verificationStatus = $verification ? $verification->status : null;
                        @endphp

                        @if (!$verification || $verificationStatus === null)
                            {{-- Status: BELUM UPLOAD (MERAH) --}}
                            <div x-data="verificationForm()" 
                                 class="bg-red-50 border-2 border-red-200 rounded-2xl shadow-sm p-6">
                        @elseif ($verificationStatus === 'pending')
                            {{-- Status: MENUNGGU REVIEW (KUNING) --}}
                            <div class="bg-yellow-50 border-2 border-yellow-200 rounded-2xl shadow-sm p-6">
                        @elseif ($verificationStatus === 'rejected')
                            {{-- Status: DITOLAK (MERAH) --}}
                            <div x-data="verificationForm()" 
                                 class="bg-red-50 border-2 border-red-200 rounded-2xl shadow-sm p-6">
                        @endif
                        
                        @if (!$verification || $verificationStatus === null)
                            {{-- FORM UPLOAD UNTUK YANG BELUM SUBMIT --}}
                            <form method="POST" action="{{ route('profile.verify') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="flex items-center mb-6">
                                    <div class="flex-shrink-0">
                                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h2 class="text-xl font-semibold text-red-700">Verifikasi Identitas Diperlukan</h2>
                                        <p class="text-sm text-red-600">Upload dokumen untuk mengaktifkan fitur rental</p>
                                    </div>
                                </div>
                        @elseif ($verificationStatus === 'pending')
                            {{-- STATUS MENUNGGU REVIEW --}}
                            <div class="flex items-center mb-6">
                                <div class="flex-shrink-0">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h2 class="text-xl font-semibold text-yellow-700">Dokumen Sedang Diverifikasi</h2>
                                    <p class="text-sm text-yellow-600">Tim kami sedang meninjau dokumen yang Anda kirim</p>
                                    <p class="text-xs text-yellow-500 mt-1">Dikirim: {{ $verification->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @elseif ($verificationStatus === 'rejected')
                            {{-- STATUS DITOLAK --}}
                            <form method="POST" action="{{ route('profile.verify') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="flex items-center mb-6">
                                    <div class="flex-shrink-0">
                                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h2 class="text-xl font-semibold text-red-700">Verifikasi Ditolak</h2>
                                        <p class="text-sm text-red-600">Dokumen Anda perlu diperbaiki dan dikirim ulang</p>
                                        @if ($verification->rejection_reason)
                                            <div class="mt-3 p-3 bg-red-100 border border-red-200 rounded-lg">
                                                <p class="text-sm font-medium text-red-800">Alasan Penolakan:</p>
                                                <p class="text-sm text-red-700 mt-1">{{ $verification->rejection_reason }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                        @endif

                        {{-- Progress Indicator --}}
                        @if (!$verification || $verificationStatus === null || $verificationStatus === 'rejected')
                        <div class="mb-6">
                            <div class="flex items-center">
                                <div class="flex items-center text-red-600 relative">
                                    <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-2 border-2 border-red-600 bg-red-600 flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">1</span>
                                    </div>
                                    <div class="absolute top-0 -ml-8 text-center mt-12 w-24 text-xs font-medium uppercase text-red-600">Upload KTP</div>
                                </div>
                                <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300 mx-4"></div>
                                <div class="flex items-center relative text-gray-500">
                                    <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-2 border-2 border-gray-300 flex items-center justify-center">
                                        <span class="font-bold text-sm text-gray-500">2</span>
                                    </div>
                                    <div class="absolute top-0 -ml-8 text-center mt-12 w-24 text-xs font-medium uppercase">Foto Selfie</div>
                                </div>
                            </div>
                        </div>
                        @elseif ($verificationStatus === 'pending')
                        <div class="mb-6">
                            <div class="flex items-center">
                                <div class="flex items-center text-yellow-600 relative">
                                    <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-2 border-2 border-yellow-600 bg-yellow-600 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute top-0 -ml-8 text-center mt-12 w-24 text-xs font-medium uppercase text-yellow-600">Dokumen Dikirim</div>
                                </div>
                                <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-yellow-600 mx-4"></div>
                                <div class="flex items-center relative text-yellow-600">
                                    <div class="rounded-full transition duration-500 ease-in-out h-10 w-10 py-2 border-2 border-yellow-600 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-yellow-600 animate-spin" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute top-0 -ml-8 text-center mt-12 w-24 text-xs font-medium uppercase">Sedang Review</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if (!$verification || $verificationStatus === null || $verificationStatus === 'rejected')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            {{-- Upload KTP --}}
                            <div class="bg-white rounded-xl p-4 border border-red-200">
                                <div class="text-center">
                                    <svg class="w-8 h-8 text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m0 0a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9a2 2 0 012-2m0 0V7a2 2 0 012-2h4zm-6 4v6m4-6v6m-4-4h4"></path>
                                    </svg>
                                    
                                    <label for="ktp_photo" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Foto KTP <span class="text-red-500">*</span>
                                    </label>
                                    <p class="text-xs text-gray-500 mb-3">
                                        Upload foto KTP yang jelas. Format: JPG, PNG. Max 5MB.
                                    </p>
                                    
                                    @if ($verificationStatus === 'rejected' && $verification && $verification->ktp_path)
                                        {{-- Tampilkan foto KTP sebelumnya jika ditolak --}}
                                        <div class="mb-3 p-2 bg-gray-50 rounded border">
                                            <p class="text-xs text-gray-600 mb-2">Foto KTP sebelumnya:</p>
                                            <img src="{{ Storage::url($verification->ktp_path) }}" alt="KTP Sebelumnya" class="max-w-full h-24 object-cover rounded border mx-auto">
                                        </div>
                                    @endif
                                    
                                    <input type="file" 
                                           name="ktp_photo" 
                                           id="ktp_photo"
                                           accept="image/jpeg,image/png,image/jpg"
                                           @change="handleKtpUpload($event)"
                                           class="hidden" 
                                           required>
                                    
                                    <div x-show="!ktpPreview" @click="document.getElementById('ktp_photo').click()" 
                                         class="cursor-pointer bg-red-50 border-2 border-dashed border-red-300 rounded-lg p-4 hover:bg-red-100 transition-colors">
                                        <svg class="mx-auto h-8 w-8 text-red-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="mt-1 text-xs text-red-600 font-medium">
                                            {{ $verificationStatus === 'rejected' ? 'Upload KTP Baru' : 'Klik untuk upload' }}
                                        </p>
                                    </div>

                                    {{-- KTP Preview --}}
                                    <div x-show="ktpPreview" class="mt-2">
                                        <div class="relative inline-block">
                                            <img :src="ktpPreview" alt="Preview KTP" class="max-w-full h-32 object-cover rounded-lg border">
                                            <button type="button" @click="removeKtpPreview()" 
                                                    class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">
                                                ×
                                            </button>
                                        </div>
                                        <p class="text-xs text-green-600 mt-1 flex items-center justify-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Berhasil diupload
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Upload Selfie with KTP --}}
                            <div class="bg-white rounded-xl p-4 border border-red-200">
                                <div class="text-center">
                                    <svg class="w-8 h-8 text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    
                                    <label for="selfie_with_ktp" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Foto Selfie dengan KTP <span class="text-red-500">*</span>
                                    </label>
                                    <p class="text-xs text-gray-500 mb-3">
                                        Foto diri memegang KTP. Wajah dan KTP harus jelas.
                                    </p>
                                    
                                    @if ($verificationStatus === 'rejected' && $verification && $verification->selfie_path)
                                        {{-- Tampilkan foto selfie sebelumnya jika ditolak --}}
                                        <div class="mb-3 p-2 bg-gray-50 rounded border">
                                            <p class="text-xs text-gray-600 mb-2">Foto Selfie sebelumnya:</p>
                                            <img src="{{ Storage::url($verification->selfie_path) }}" alt="Selfie Sebelumnya" class="max-w-full h-24 object-cover rounded border mx-auto">
                                        </div>
                                    @endif
                                    
                                    <input type="file" 
                                           name="selfie_with_ktp" 
                                           id="selfie_with_ktp"
                                           accept="image/jpeg,image/png,image/jpg"
                                           @change="handleSelfieUpload($event)"
                                           class="hidden" 
                                           required>
                                    
                                    <div x-show="!selfiePreview" @click="document.getElementById('selfie_with_ktp').click()" 
                                         class="cursor-pointer bg-red-50 border-2 border-dashed border-red-300 rounded-lg p-4 hover:bg-red-100 transition-colors">
                                        <svg class="mx-auto h-8 w-8 text-red-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="mt-1 text-xs text-red-600 font-medium">
                                            {{ $verificationStatus === 'rejected' ? 'Upload Selfie Baru' : 'Klik untuk upload' }}
                                        </p>
                                    </div>

                                    {{-- Selfie Preview --}}
                                    <div x-show="selfiePreview" class="mt-2">
                                        <div class="relative inline-block">
                                            <img :src="selfiePreview" alt="Preview Selfie" class="max-w-full h-32 object-cover rounded-lg border">
                                            <button type="button" @click="removeSelfiePreview()" 
                                                    class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">
                                                ×
                                            </button>
                                        </div>
                                        <p class="text-xs text-green-600 mt-1 flex items-center justify-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Berhasil diupload
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tips Section --}}
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Tips untuk verifikasi yang sukses:</h3>
                                    <div class="mt-1 text-sm text-red-700">
                                        <ul class="list-disc list-inside space-y-1">
                                            <li>Pastikan foto KTP jelas dan tidak buram</li>
                                            <li>Hindari pantulan cahaya pada KTP</li>
                                            <li>Wajah dan KTP harus terlihat jelas pada foto selfie</li>
                                            <li>Gunakan pencahayaan yang cukup</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="text-center">
                            <button type="submit" 
                                    :disabled="!ktpUploaded || !selfieUploaded || isSubmitting"
                                    :class="ktpUploaded && selfieUploaded && !isSubmitting ? 
                                           'bg-red-600 hover:bg-red-700 cursor-pointer' : 
                                           'bg-gray-400 cursor-not-allowed'"
                                    class="inline-flex items-center px-6 py-3 text-white font-semibold rounded-lg shadow transition-all duration-200 disabled:opacity-50">
                                <span x-show="!isSubmitting">
                                    {{ $verificationStatus === 'rejected' ? 'Kirim Ulang Verifikasi' : 'Kirim Verifikasi' }}
                                </span>
                                <span x-show="isSubmitting" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Mengirim...
                                </span>
                            </button>
                        </div>
                        </form>
                        @elseif ($verificationStatus === 'pending')

{{-- STATUS PENDING - HANYA TAMPILAN INFO --}}
                        <div class="text-center space-y-4">
                            <div class="bg-yellow-100 rounded-full w-20 h-20 mx-auto flex items-center justify-center">
                                <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-yellow-800 mb-2">Dokumen Telah Dikirim</h3>
                                <p class="text-yellow-700 mb-4">Terima kasih! Dokumen verifikasi Anda sedang dalam proses review.</p>
                                <div class="bg-yellow-100 border border-yellow-300 rounded-lg p-4 text-left">
                                    <h4 class="font-medium text-yellow-800 mb-2">Informasi:</h4>
                                    <ul class="text-sm text-yellow-700 space-y-1">
                                        <li>• Proses verifikasi membutuhkan waktu 1-3 hari kerja</li>
                                        <li>• Anda akan mendapat notifikasi via email setelah selesai</li>
                                        <li>• Jika ada masalah, tim kami akan menghubungi Anda</li>
                                        <li>• Status akan otomatis terupdate setelah verifikasi selesai</li>
                                    </ul>
                                </div>
                                
                                {{-- Tampilkan dokumen yang sudah diupload --}}
                                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    {{-- Preview KTP yang sudah diupload --}}
                                    @if($verification && $verification->ktp_path)
                                    <div class="bg-white border border-yellow-300 rounded-lg p-4">
                                        <h5 class="text-sm font-medium text-yellow-800 mb-2">Foto KTP</h5>
                                        <img src="{{ Storage::url($verification->ktp_path) }}" 
                                             alt="KTP yang diupload" 
                                             class="w-full h-32 object-cover rounded border">
                                        <p class="text-xs text-yellow-600 mt-2">✓ Sudah dikirim</p>
                                    </div>
                                    @endif
                                    
                                    {{-- Preview Selfie yang sudah diupload --}}
                                    @if($verification && $verification->selfie_path)
                                    <div class="bg-white border border-yellow-300 rounded-lg p-4">
                                        <h5 class="text-sm font-medium text-yellow-800 mb-2">Foto Selfie dengan KTP</h5>
                                        <img src="{{ Storage::url($verification->selfie_path) }}" 
                                             alt="Selfie yang diupload" 
                                             class="w-full h-32 object-cover rounded border">
                                        <p class="text-xs text-yellow-600 mt-2">✓ Sudah dikirim</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        </div> {{-- Penutup untuk div status verifikasi --}}
                    @endif

                    {{-- FORM EDIT PROFILE --}}
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Account Settings</h2>

                        @if (session('status') === 'profile-updated')
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">
                                            Profil berhasil diperbarui!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (session('status') === 'verification-submitted')
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">
                                            Dokumen verifikasi berhasil dikirim! Tim kami akan meninjau dalam 1-3 hari kerja.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form method="post" action="{{ route('profile.saveAll') }}">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama Lengkap
                                    </label>
                                    <input id="name" 
                                           name="name" 
                                           type="text" 
                                           value="{{ old('name', $user->name) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                           required autofocus autocomplete="name">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input id="email" 
                                           name="email" 
                                           type="email" 
                                           value="{{ old('email', $user->email) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                           required autocomplete="username">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                        <div class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                            <p class="text-sm text-yellow-800">
                                                Email Anda belum terverifikasi.
                                                <button form="send-verification" 
                                                        class="underline text-yellow-600 hover:text-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                    Klik di sini untuk mengirim ulang email verifikasi.
                                                </button>
                                            </p>

                                            @if (session('status') === 'verification-link-sent')
                                                <p class="mt-2 text-sm font-medium text-green-600">
                                                    Link verifikasi baru telah dikirim ke alamat email Anda.
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nomor Telepon
                                    </label>
                                    <input id="phone" 
                                           name="phone" 
                                           type="tel" 
                                           value="{{ old('phone', $user->phone) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                           placeholder="Contoh: 08123456789">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Date of Birth -->
                                <div>
                                    <label for="date_of_birth" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tanggal Lahir
                                    </label>
                                    <input id="date_of_birth" 
                                           name="date_of_birth" 
                                           type="date" 
                                           value="{{ old('date_of_birth', $user->date_of_birth) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                    @error('date_of_birth')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="mt-6">
                                <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Alamat
                                </label>
                                <textarea id="address" 
                                          name="address" 
                                          rows="3"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                          placeholder="Masukkan alamat lengkap Anda">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end mt-6 space-x-4">
                                @if (session('status') === 'profile-updated')
                                    <p class="text-sm text-green-600 font-medium">Tersimpan.</p>
                                @endif

                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- FORM GANTI PASSWORD --}}
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Ganti Password</h2>
                        
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="space-y-6">
                                <!-- Current Password -->
                                <div>
                                    <label for="update_password_current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Password Saat Ini
                                    </label>
                                    <input id="update_password_current_password" 
                                           name="current_password" 
                                           type="password" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                           autocomplete="current-password">
                                    @error('current_password', 'updatePassword')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div>
                                    <label for="update_password_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Password Baru
                                    </label>
                                    <input id="update_password_password" 
                                           name="password" 
                                           type="password" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                           autocomplete="new-password">
                                    @error('password', 'updatePassword')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Konfirmasi Password Baru
                                    </label>
                                    <input id="update_password_password_confirmation" 
                                           name="password_confirmation" 
                                           type="password" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                           autocomplete="new-password">
                                    @error('password_confirmation', 'updatePassword')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-6 space-x-4">
                                @if (session('status') === 'password-updated')
                                    <p class="text-sm text-green-600 font-medium">Password berhasil diperbarui.</p>
                                @endif

                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Ganti Password
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- DELETE ACCOUNT SECTION --}}
                    <div class="bg-red-50 border border-red-200 rounded-2xl shadow-sm p-6">
                        <h2 class="text-2xl font-bold text-red-800 mb-4">Hapus Akun</h2>
                        <p class="text-red-700 mb-6">
                            Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. 
                            Silakan unduh data yang ingin Anda simpan sebelum menghapus akun.
                        </p>

                        <button type="button"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Akun
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk konfirmasi hapus akun --}}
<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            Apakah Anda yakin ingin menghapus akun?
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. 
            Masukkan password Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun secara permanen.
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
                Batal
            </button>

            <button type="submit" 
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                Hapus Akun
            </button>
        </div>
    </form>
</x-modal>

{{-- JavaScript untuk form verifikasi --}}
@if (!auth()->user()->is_verified && (!$verification || $verificationStatus === null || $verificationStatus === 'rejected'))
<script>
function verificationForm() {
    return {
        ktpPreview: null,
        selfiePreview: null,
        ktpUploaded: false,
        selfieUploaded: false,
        isSubmitting: false,
        
        handleKtpUpload(event) {
            const file = event.target.files[0];
            if (file) {
                // Validasi ukuran file (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    event.target.value = '';
                    return;
                }
                
                // Validasi tipe file
                if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG atau PNG.');
                    event.target.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.ktpPreview = e.target.result;
                    this.ktpUploaded = true;
                };
                reader.readAsDataURL(file);
            }
        },
        
        handleSelfieUpload(event) {
            const file = event.target.files[0];
            if (file) {
                // Validasi ukuran file (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    event.target.value = '';
                    return;
                }
                
                // Validasi tipe file
                if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG atau PNG.');
                    event.target.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.selfiePreview = e.target.result;
                    this.selfieUploaded = true;
                };
                reader.readAsDataURL(file);
            }
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
    }
}
</script>
@endif

{{-- Email verification form --}}
@if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
@endif
@endsection