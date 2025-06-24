<!-- Modal Structure - Fixed Version -->
<div x-show="editId === {{ $product->id }}" 
     x-transition 
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
     style="display: none;"
     x-data="productUpdateModal({{ $product->id }})">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto"
         @click.away="editId = false">
        
        <!-- All content in one scrollable container -->
        <div class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-[#493862] font-bold text-xl">UPDATE PRODUCT</h2>
                <button type="button" class="text-gray-400 hover:text-gray-600 text-2xl font-bold" @click="editId = false">
                    ×
                </button>
            </div>

            <!-- Form Content -->
            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex gap-8 mb-3">
                    <!-- Upload beberapa gambar -->
                    <div class="w-48 space-y-3 flex-shrink-0">
                        <div class="w-48 max-h-fit overflow-y-auto bg-purple-200 rounded-2xl flex flex-col items-center justify-center p-4 relative">
                            <label class="text-purple-700 font-semibold text-sm text-center mb-2">Update Product Images (optional)</label>
                            <div class="relative w-full overflow-y-auto bg-purple-100 rounded-xl flex items-center justify-center cursor-pointer">
                                <input
                                    type="file"
                                    name="images[]"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    multiple 
                                    accept="image/*"
                                    @change="handleFileSelect($event)">
                                <div class="text-center">
                                    <svg class="w-12 h-12 text-purple-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <small class="text-purple-600 text-xs">Click to upload new images</small>
                                </div>
                            </div>

                            <!-- Current Images Display - FIXED -->
                            <div>
                                <p class="text-purple-700 font-semibold text-sm mb-2">Current Images:</p>
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach ($product->images as $image)
                                        <div class="relative current-image" data-image-id="{{ $image->id }}">
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image" class="w-20 h-20 object-cover border-2 border-purple-300 rounded-lg">
                                            <button type="button" class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full p-1" onclick="removeExistingImage({{ $product->id }}, {{ $image->id }})">×</button>
                                            <div class="absolute top-1 left-1 bg-purple-600 text-white text-xs px-1.5 py-0.5 rounded-full font-semibold">
                                                {{ $loop->iteration }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
    
                            <!-- Preview Container for new images -->
                            <div x-show="selectedFiles.length > 0" class="mt-2">
                                <div class="flex items-center justify-between mb-2 gap-2">
                                    <span class="text-purple-700 font-semibold text-xs">
                                        New Images (<span x-text="selectedFiles.length"></span>/5)
                                    </span>
                                    <button type="button" 
                                            class="text-red-500 hover:text-red-700 text-xs" 
                                            @click="clearAllFiles()">
                                        Clear All
                                    </button>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <template x-for="(fileData, index) in selectedFiles" :key="index">
                                        <div class="relative group">
                                            <div class="relative w-20 h-20 rounded-lg overflow-hidden border-2 border-purple-300 hover:border-purple-500 transition-all duration-200">
                                                <img :src="fileData.preview" class="w-full h-full object-cover" alt="Preview">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-200 flex items-center justify-center">
                                                    <button type="button" 
                                                            @click="removeFile(index)" 
                                                            class="opacity-0 group-hover:opacity-100 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold transition-all duration-200">
                                                        ×
                                                    </button>
                                                </div>
                                                <div class="absolute top-1 left-1 bg-green-600 text-white text-xs px-1.5 py-0.5 rounded-full font-semibold">
                                                    NEW
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-600 mt-1 truncate text-center" 
                                               :title="fileData.name" 
                                               x-text="fileData.name.length > 10 ? fileData.name.substring(0, 8) + '...' : fileData.name">
                                            </p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="flex-1 space-y-3">
                        <!-- Pilih kategori -->
                        <div>
                            <label for="category_id_{{ $product->id }}" class="block text-purple-700 font-semibold mb-2">Category</label>
                            <select name="category_id" id="category_id_{{ $product->id }}" class="w-full border rounded-lg px-4 py-2">
                                <option value="" disabled>-- Choose Category --</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input nama product -->
                        <div>
                            <label class="block text-purple-700 font-semibold mb-2">Product Name</label>
                            <input type="text" name="name" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('name', $product->name) }}" required>
                        </div>

                        <!-- Input harga product -->
                        <div>
                            <label class="block text-purple-700 font-semibold mb-2">Rental Price</label>
                            <input type="number" name="price" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('price', $product->price) }}" required>
                        </div>
                    </div>
                </div>

                <!-- Input description product -->
                <div class="mb-4">
                    <label class="block text-purple-700 font-semibold mb-2">Description</label>
                    <textarea name="description" cols="10" rows="3" class="overflow-y-auto w-full bg-purple-100 rounded-lg px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Input details rental product -->
                <div class="mb-4">
                    <label class="block text-purple-700 font-semibold mb-2">Details</label>
                    <textarea name="details" cols="10" rows="3" class="overflow-y-auto w-full bg-purple-100 rounded-lg px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required>{{ old('details', $product->details) }}</textarea>
                </div>

                <!-- Input jumlah ketersediaan product -->
                <div class="mb-6">
                    <label class="block text-purple-700 font-semibold mb-2">Available Amount</label>
                    <input type="number" name="stock_quantity" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('stock_quantity', $product->stock_quantity) }}" required min="0">
                </div>

                <!-- Input jumlah ketersediaan product -->
                <div class="mb-6">
                    <label class="block text-purple-700 font-semibold mb-2">Max Rent Duration (Days)</label>
                    <input type="number" name="max_rent_duration" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('max_rent_duration', $product->max_rent_duration) }}" required min="1">
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <button type="submit" class="bg-[#C8A8E7] text-[#493862] font-semibold px-6 py-2 rounded-full hover:bg-purple-600 hover:text-white transition-colors">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Define Alpine component untuk setiap product
document.addEventListener('alpine:init', () => {
    Alpine.data('productUpdateModal', (productId) => ({
        selectedFiles: [],
        
        handleFileSelect(event) {
            const files = Array.from(event.target.files);
            
            if (!files || files.length === 0) return;
            
            // Filter hanya file gambar
            const validFiles = files.filter(file => file.type.startsWith('image/'));
            
            if (validFiles.length === 0) {
                alert('Please select valid image files (PNG, JPG, JPEG)');
                event.target.value = '';
                return;
            }
            
            const maxNewImages = 5;
            const currentCount = this.selectedFiles.length;
            const availableSlots = maxNewImages - currentCount;
            
            if (availableSlots <= 0) {
                alert('Maximum 5 new images can be selected at once.');
                event.target.value = '';
                return;
            }
            
            let filesToAdd = validFiles;
            if (validFiles.length > availableSlots) {
                filesToAdd = validFiles.slice(0, availableSlots);
                alert(`Only ${availableSlots} more images can be added.`);
            }
            
            // Process each file
            filesToAdd.forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.selectedFiles.push({
                        file: file,
                        preview: e.target.result,
                        name: file.name
                    });
                    
                    // Update file input setelah semua file diproses
                    this.$nextTick(() => {
                        this.updateFileInput(event.target);
                    });
                };
                reader.readAsDataURL(file);
            });
            
            // Clear input value
            event.target.value = '';
        },
        
        removeFile(index) {
            this.selectedFiles.splice(index, 1);
            // Update file input
            const fileInput = this.$el.querySelector('input[type="file"]');
            if (fileInput) {
                this.updateFileInput(fileInput);
            }
        },
        
        clearAllFiles() {
            if (confirm('Are you sure you want to remove all selected new images?')) {
                this.selectedFiles = [];
                const fileInput = this.$el.querySelector('input[type="file"]');
                if (fileInput) {
                    fileInput.value = '';
                }
            }
        },
        
        updateFileInput(fileInput) {
            const dt = new DataTransfer();
            this.selectedFiles.forEach(item => {
                dt.items.add(item.file);
            });
            fileInput.files = dt.files;
        }
    }));
});

// FIXED: Function untuk menghapus gambar existing
function removeExistingImage(productId, imageId) {
    if (!confirm('Are you sure you want to remove this image?')) {
        return; // Return hanya jika user cancel
    }

    console.log('Removing image:', imageId, 'from product:', productId);

    const url = `/admin/product/${productId}/image/${imageId}`;
    
    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            const imageElement = document.querySelector(`[data-image-id="${imageId}"]`);
            console.log('Found image element:', imageElement);
            if (imageElement) {
                // Hapus gambar preview jika ada
                const previewImage = document.querySelector(`img[src*="${imageElement.querySelector('img').src}"]`);
                console.log('Found preview image:', previewImage);
                if (previewImage) {
                    previewImage.remove();
                }

                // Animasi fade out sebelum remove
                imageElement.style.transition = 'opacity 0.3s';
                imageElement.style.opacity = '0';
                
                setTimeout(() => {
                    imageElement.remove();
                    console.log('Image element removed from DOM');
                }, 300);
            } else {
                console.log('Image element not found');
            }
            
            alert('Image deleted successfully');
        } else {
            throw new Error(data.message || 'Unknown error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error removing image: ' + error.message);
    });
}

</script>