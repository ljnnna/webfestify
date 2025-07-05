<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- KTP Upload -->
    <div class="bg-white rounded-xl p-4 border border-red-200">
        <div class="text-center">
            <svg class="w-8 h-8 text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m0 0a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9a2 2 0 012-2m0 0V7a2 2 0 012-2h4zm-6 4v6m4-6v6m-4-4h4"></path>
            </svg>
            
            <label for="ktp_photo" class="block text-sm font-semibold text-gray-700 mb-2">
                KTP Photo <span class="text-red-500">*</span>
            </label>
            <p class="text-xs text-gray-500 mb-3">
                Upload clear KTP photo. Format: JPG, PNG. Max 5MB.
            </p>
            
            @if ($status === 'rejected' && $user->ktp_photo)
                <div class="mb-3 p-2 bg-gray-50 rounded border">
                    <p class="text-xs text-gray-600 mb-2">Previous KTP Photo:</p>
                    <img src="{{ Storage::url($user->ktp_photo) }}" alt="Previous KTP" class="max-w-full h-24 object-cover rounded border mx-auto">
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
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H9a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="mt-1 text-xs text-red-600 font-medium">
                    {{ $status === 'rejected' ? 'Upload New KTP' : 'Click to upload' }}
                </p>
            </div>

            <!-- KTP Preview -->
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
                    Upload successful
                </p>
            </div>
        </div>
    </div>

    <!-- Selfie Upload -->
    <div class="bg-white rounded-xl p-4 border border-red-200">
        <div class="text-center">
            <svg class="w-8 h-8 text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            
            <label for="selfie_with_ktp" class="block text-sm font-semibold text-gray-700 mb-2">
                Selfie with KTP <span class="text-red-500">*</span>
            </label>
            <p class="text-xs text-gray-500 mb-3">
                Photo of yourself holding KTP. Face and KTP must be clear.
            </p>
            
            @if ($status === 'rejected' && $user->ktp_selfie_photo)
                <div class="mb-3 p-2 bg-gray-50 rounded border">
                    <p class="text-xs text-gray-600 mb-2">Previous Selfie:</p>
                    <img src="{{ Storage::url($user->ktp_selfie_photo) }}" alt="Previous Selfie" class="max-w-full h-24 object-cover rounded border mx-auto">
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
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H9a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="mt-1 text-xs text-red-600 font-medium">
                    {{ $status === 'rejected' ? 'Upload New Selfie' : 'Click to upload' }}
                </p>
            </div>

            <!-- Selfie Preview -->
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
                    Upload successful
                </p>
            </div>
        </div>
    </div>
</div>