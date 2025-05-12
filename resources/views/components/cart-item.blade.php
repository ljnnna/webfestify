<div class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-purple-100 to-purple-50 mb-3">
    <div class="flex items-center gap-4">
        <input type="checkbox" checked class="form-checkbox w-4 h-4">
        <img src="{{ $image }}" alt="{{ $name }}" class="w-16 h-16 object-cover rounded-md">
        <div>
            <div class="font-semibold">{{ $name }}</div>
            <div class="text-sm text-gray-500">{{ $version }}</div>
        </div>
    </div>
    <div class="flex items-center gap-6">
        <div class="flex items-center gap-2">
            <button class="text-lg font-bold">-</button>
            <span>1</span>
            <button class="text-lg font-bold">+</button>
        </div>
        <div class="font-semibold whitespace-nowrap">Rp.{{ number_format($price, 0, ',', '.') }}/hari</div>
        <button class="text-red-500 font-bold">x</button>
    </div>
</div>
