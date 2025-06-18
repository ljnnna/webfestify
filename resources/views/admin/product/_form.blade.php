<!-- Modal Structure - Add New Product styled with Update modal CSS -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" id="productModal">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-[#493862] font-bold text-xl">ADD NEW PRODUCT</h2>
                <button type="button" class="text-gray-400 hover:text-gray-600 text-2xl font-bold" @click="showAddModal = false">
                    &times;
                </button>
            </div>

            <!-- Form Content -->
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="flex gap-8 mb-3">
                    <div class="w-48 space-y-3 flex-shrink-0">
                        <!-- Left Section: Image Upload -->
                        <div class="w-48 max-h-fit overflow-y-auto bg-purple-200 rounded-2xl flex flex-col items-center justify-center p-4 relative">
                            <label class="text-purple-700 font-semibold text-sm text-center mb-2">Product Images (Max 5)</label>
                            <div class="relative w-full overflow-y-auto bg-purple-100 rounded-xl flex items-center justify-center cursor-pointer">
                                <input type="file" name="image[]" id="imageInput" class="absolute inset-0 opacity-0 cursor-pointer" multiple accept="image/*" required>
                                <div class="text-center">
                                    <svg class="w-12 h-12 text-purple-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <small class="text-purple-600 text-xs">Click to upload</small>
                                </div>
                            </div>
                            <div id="image-preview-info" class="mt-2 hidden">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-purple-700 font-semibold text-xs">Images (<span id="image-count">0</span>/5)</span>
                                    <button type="button" id="clear-all-btn" class="text-red-500 hover:text-red-700 text-xs">Clear All</button>
                                </div>
                                <div id="image-preview" class="grid grid-cols-2 gap-2"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Section: Form Fields -->
                    <div class="space-y-4 flex-1">
                        <div>
                            <label for="category_id" class="block text-purple-700 font-semibold mb-2">Category</label>
                            <select name="category_id" id="category_id" class="w-full border rounded-lg px-4 py-2">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-purple-700 font-semibold mb-2">Product Name</label>
                            <input type="text" name="name" placeholder="Input product name here..." class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required>
                        </div>

                        <div>
                            <label class="block text-purple-700 font-semibold mb-2">Available Amount</label>
                            <input type="number" name="stock_quantity" min="0" placeholder="Input available amount of product here..." class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required>
                        </div>
                    </div>
                </div>

                <!-- Additional Inputs -->
                <div class="mt-6 space-y-4">
                    <div>
                        <label class="block text-purple-700 font-semibold mb-2">Description</label>
                        <textarea name="description" id="" cols="10" rows="3" placeholder="Input product description here..." class="overflow-y-auto w-full bg-purple-100 rounded-lg px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required></textarea>
                    </div>
                    <div>
                        <label class="block text-purple-700 font-semibold mb-2">Details</label>
                        <textarea name="details" id="" cols="10" rows="3" placeholder="Input product details here..." class="overflow-y-auto w-full bg-purple-100 rounded-lg px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required></textarea>
                    </div>
                    <div>
                        <label class="block text-purple-700 font-semibold mb-2">Rental Price</label>
                        <input type="number" name="price" placeholder="e.g. 75000" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <button type="submit" class="bg-[#C8A8E7] text-[#493862] font-semibold px-6 py-2 rounded-full hover:bg-purple-600 hover:text-white transition-colors">
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- JavaScript -->
<script>
// Global variables to store selected files
let selectedFiles = [];

function resetForm() {
    selectedFiles = [];
    document.getElementById('image-preview').innerHTML = '';
    document.getElementById('image-preview-info').classList.add('hidden');
    document.getElementById('imageInput').value = '';
    updateImageCount();
}

// Update image count display
function updateImageCount() {
    document.getElementById('image-count').textContent = selectedFiles.length;
}

// Remove image from selection
function removeImage(index) {
    selectedFiles.splice(index, 1);
    updatePreview();
    updateImageCount();
    
    if (selectedFiles.length === 0) {
        document.getElementById('image-preview-info').classList.add('hidden');
    }
    
    // Update the file input
    updateFileInput();
}

// Update file input with current selected files
function updateFileInput() {
    const dt = new DataTransfer();
    selectedFiles.forEach(file => {
        dt.items.add(file);
    });
    document.getElementById('imageInput').files = dt.files;
}

// Update preview display
function updatePreview() {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    
    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const imgContainer = document.createElement('div');
            imgContainer.className = 'relative group';
            
            imgContainer.innerHTML = `
                <div class="relative w-20 h-20 rounded-lg overflow-hidden border-2 border-purple-300 hover:border-purple-500 transition-all duration-200">
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-200 flex items-center justify-center">
                        <button type="button" onclick="removeImage(${index})" class="opacity-0 group-hover:opacity-100 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold transition-all duration-200">
                            ×
                        </button>
                    </div>
                    <div class="absolute top-1 left-1 bg-purple-600 text-white text-xs px-1.5 py-0.5 rounded-full font-semibold">
                        ${index + 1}
                    </div>
                </div>
                <p class="text-xs text-gray-600 mt-1 truncate text-center" title="${file.name}">${file.name.length > 10 ? file.name.substring(0, 8) + '...' : file.name}</p>
            `;
            
            preview.appendChild(imgContainer);
        };
        
        reader.readAsDataURL(file);
    });
}

// Image input change handler
document.getElementById('imageInput').addEventListener('change', function(e) {
    const files = Array.from(e.target.files);
    
    if (!files || files.length === 0) return;
    
    // Filter valid image files
    const validFiles = files.filter(file => file.type.startsWith('image/'));
    
    if (validFiles.length === 0) {
        alert('Please select valid image files (PNG, JPG, JPEG)');
        return;
    }
    
    // Check total count
    const totalFiles = selectedFiles.length + validFiles.length;
    if (totalFiles > 5) {
        const remainingSlots = 5 - selectedFiles.length;
        if (remainingSlots > 0) {
            selectedFiles = selectedFiles.concat(validFiles.slice(0, remainingSlots));
            alert(`Maximum 5 images allowed. Only first ${remainingSlots} images were added.`);
        } else {
            alert('Maximum 5 images already selected. Please remove some images first.');
            return;
        }
    } else {
        selectedFiles = selectedFiles.concat(validFiles);
    }
    
    // Show preview info
    document.getElementById('image-preview-info').classList.remove('hidden');
    
    // Update preview and count
    updatePreview();
    updateImageCount();
    
    // Update file input
    updateFileInput();
});

// Clear all images
document.getElementById('clear-all-btn').addEventListener('click', function() {
    if (confirm('Are you sure you want to remove all selected images?')) {
        resetForm();
    }
});
</script>