<x-app-layout>
    <!-- ISI HALAMAN -->
    <div class="flex flex-col md:flex-row min-h-screen bg-gray-50">
        <!-- SIDEBAR (Sekarang tampil di mobile juga) -->
        <aside class="w-full md:w-1/4 bg-gradient-to-b from-pink-100 to-blue-100 p-6 md:rounded-r-3xl shadow-md mt-2 md:mt-10">
            <div class="flex flex-col items-center">
                <!-- Gambar Profil -->
                <form action="{{ route('profile.uploadPicture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="cursor-pointer relative">
                        <img src="{{ asset(auth()->user()->picture ?? 'default-user.png') }}"
                             class="w-32 h-32 rounded-full border-2 border-gray-300 object-cover"
                             alt="Profile Picture">
                        <input type="file" name="picture" class="hidden" onchange="this.form.submit()">
                        <span class="absolute bottom-0 right-0 bg-white rounded-full p-1 text-xs shadow">Edit</span>
                    </label>
                </form>

                <!-- Menu -->
                <nav class="mt-10 space-y-3 text-center font-semibold text-gray-700">
                    <a href="{{ route('profile.edit') }}" 
                    class="block px-3 py-2 rounded-full transition 
                    {{ request()->routeIs('profile.edit') ? 'bg-white text-purple-800 font-bold' : 'hover:bg-purple-100' }}">
                    ACCOUNT SETTING
                    </a>

                    <a href="{{ route('profile.rentalInfo') }}" 
                    class="block px-3 py-2 rounded-full transition 
                    {{ request()->routeIs('profile.rentalInfo') ? 'bg-white text-purple-800 font-bold' : 'hover:bg-purple-100' }}">
                    RENTAL INFORMATION
                    </a>
                </nav>
            </div>
        </aside>

        <!-- FORM KONTEN -->
        <main class="flex-1 p-6 flex justify-center items-center min-h-screen">
            <form method="POST" action="{{ route('profile.saveAll') }}"
            class="bg-white rounded-2xl shadow-lg p-8 max-w-3xl w-full mx-auto mb-10">
                  
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Username -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700">Username</label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                    </div>

                    <!-- No. Telepon -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700">No. Telepon</label>
                        <input type="text" name="phone" id="phone"
                               value="{{ old('phone', auth()->user()->phone) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700">Alamat</label>
                        <input type="text" name="address" id="address"
                               value="{{ old('address', auth()->user()->address) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-start gap-4 mt-6">
                    <button type="submit" name="delete_account" value="on"
                            class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">
                        Delete Account
                    </button>
                    <button type="submit"
                            class="bg-gray-300 px-4 py-2 rounded shadow hover:bg-gray-400 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </main>
    </div>

    <!-- Script Toggle Navbar -->
    <script>
        const toggle = document.getElementById('nav-toggle');
        const menu = document.getElementById('mobile-menu');

        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</x-app-layout>
