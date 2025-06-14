<!-- Modal Structure - Simple Scrollable for UPDATE -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" id="productUpdateModal">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        
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
                        <div class="w-48 h-64 bg-purple-200 rounded-2xl flex flex-col items-center justify-center p-4 relative">
                            <label class="text-purple-700 font-semibold text-sm text-center mb-2">Update Product Images (optional)</label>
                            <input
                                type="file"
                                name="images[]"
                                id="imageInputUpdate"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                multiple accept="image/*">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-purple-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <small class="text-purple-600 text-xs">Click to upload new images</small>
                            </div>
                        </div>
                        
                        <!-- Current Images Display -->
                        <div>
                            <p class="text-purple-700 font-semibold text-sm mb-2">Current Images:</p>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ($product->images as $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image" class="w-20 h-20 object-cover border-2 border-purple-300 rounded-lg">
                                        <div class="absolute top-1 left-1 bg-purple-600 text-white text-xs px-1.5 py-0.5 rounded-full font-semibold">
                                            {{ $loop->iteration }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Preview Container for new images -->
                        <div id="image-preview-info-update" class="hidden">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-purple-700 font-semibold text-xs">New Images (<span id="image-count-update">0</span>/5)</span>
                                <button type="button" id="clear-all-btn-update" class="text-red-500 hover:text-red-700 text-xs">Clear All</button>
                            </div>
                        </div>
                        <div id="image-preview-update" class="grid grid-cols-2 gap-2"></div>
                    </div>
                    
                    <div class="flex-1 space-y-3">
                        <!-- Pilih kategori -->
                        <div>
                            <label for="category_id" class="block text-purple-700 font-semibold mb-2">Category</label>
                            <select name="category_id" id="category_id" class="w-full border rounded-lg px-4 py-2">
                                <option value="" disabled selected>-- Choose Category --</option>
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
                    <input type="text" name="description" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('description', $product->description) }}" required>
                </div>

                <!-- Input details rental product -->
                <div class="mb-4">
                    <label class="block text-purple-700 font-semibold mb-2">Details</label>
                    <input type="text" name="details" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('details', $product->details) }}" required>
                </div>

                <!-- Input jumlah ketersediaan product -->
                <div class="mb-6">
                    <label class="block text-purple-700 font-semibold mb-2">Available Amount</label>
                    <input type="number" name="stock_quantity" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('stock_quantity', $product->stock_quantity) }}" required min="0">
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
document.addEventListener('DOMContentLoaded', function() {
    // Global variables for update form
    let selectedFilesUpdate = [];

    function resetUpdateForm() {
        selectedFilesUpdate = [];
        const previewContainer = document.getElementById('image-preview-update');
        const previewInfo = document.getElementById('image-preview-info-update');
        const imageInput = document.getElementById('imageInputUpdate');
        
        if (previewContainer) previewContainer.innerHTML = '';
        if (previewInfo) previewInfo.classList.add('hidden');
        if (imageInput) imageInput.value = '';
        updateImageCountUpdate();
    }

    // Update image count display
    function updateImageCountUpdate() {
        const countElement = document.getElementById('image-count-update');
        if (countElement) {
            countElement.textContent = selectedFilesUpdate.length;
        }
    }

    // Remove image from selection
    function removeImageUpdate(index) {
        selectedFilesUpdate.splice(index, 1);
        updatePreviewUpdate();
        updateImageCountUpdate();
        
        if (selectedFilesUpdate.length === 0) {
            const previewInfo = document.getElementById('image-preview-info-update');
            if (previewInfo) previewInfo.classList.add('hidden');
        }
        
        // Update the file input
        updateFileInputUpdate();
    }

    // Update file input with current selected files
    function updateFileInputUpdate() {
        const imageInput = document.getElementById('imageInputUpdate');
        if (!imageInput) return;
        
        const dt = new DataTransfer();
        selectedFilesUpdate.forEach(file => {
            dt.items.add(file);
        });
        imageInput.files = dt.files;
    }

    // Update preview display
    function updatePreviewUpdate() {
        const preview = document.getElementById('image-preview-update');
        if (!preview) return;
        
        preview.innerHTML = '';
        
        selectedFilesUpdate.forEach((file, index) => {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'relative group';
                
                imgContainer.innerHTML = `
                    <div class="relative w-20 h-20 rounded-lg overflow-hidden border-2 border-purple-300 hover:border-purple-500 transition-all duration-200">
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-200 flex items-center justify-center">
                            <button type="button" onclick="removeImageUpdate(${index})" class="opacity-0 group-hover:opacity-100 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold transition-all duration-200">
                                ×
                            </button>
                        </div>
                        <div class="absolute top-1 left-1 bg-green-600 text-white text-xs px-1.5 py-0.5 rounded-full font-semibold">
                            NEW
                        </div>
                    </div>
                    <p class="text-xs text-gray-600 mt-1 truncate text-center" title="${file.name}">${file.name.length > 10 ? file.name.substring(0, 8) + '...' : file.name}</p>
                `;
                
                preview.appendChild(imgContainer);
            };
            
            reader.readAsDataURL(file);
        });
    }

    // Image input change handler for update
    const imageInputUpdate = document.getElementById('imageInputUpdate');
    if (imageInputUpdate) {
        imageInputUpdate.addEventListener('change', function(e) {
            console.log('File input changed:', e.target.files); // Debug log
            
            const files = Array.from(e.target.files);
            
            if (!files || files.length === 0) return;
            
            // Filter valid image files
            const validFiles = files.filter(file => file.type.startsWith('image/'));
            
            if (validFiles.length === 0) {
                alert('Please select valid image files (PNG, JPG, JPEG)');
                return;
            }
            
            console.log('Valid files:', validFiles); // Debug log
            
            // Check total count
            const totalFiles = selectedFilesUpdate.length + validFiles.length;
            if (totalFiles > 5) {
                const remainingSlots = 5 - selectedFilesUpdate.length;
                if (remainingSlots > 0) {
                    selectedFilesUpdate = selectedFilesUpdate.concat(validFiles.slice(0, remainingSlots));
                    alert(`Maximum 5 images allowed. Only first ${remainingSlots} images were added.`);
                } else {
                    alert('Maximum 5 images already selected. Please remove some images first.');
                    return;
                }
            } else {
                selectedFilesUpdate = selectedFilesUpdate.concat(validFiles);
            }
            
            console.log('Selected files:', selectedFilesUpdate); // Debug log
            
            // Show preview info
            const previewInfo = document.getElementById('image-preview-info-update');
            if (previewInfo) previewInfo.classList.remove('hidden');
            
            // Update preview and count
            updatePreviewUpdate();
            updateImageCountUpdate();
            
            // Update file input
            updateFileInputUpdate();
        });
    }

    // Clear all images for update
    const clearAllBtn = document.getElementById('clear-all-btn-update');
    if (clearAllBtn) {
        clearAllBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to remove all selected new images?')) {
                resetUpdateForm();
            }
        });
    }

    // Make removeImageUpdate function globally accessible
    window.removeImageUpdate = removeImageUpdate;
    
    // Close update modal function
    window.closeUpdateModal = function() {
        const modal = document.getElementById('productUpdateModal');
        if (modal) {
            modal.style.display = 'none';
            resetUpdateForm();
        }
    };
});
</script>