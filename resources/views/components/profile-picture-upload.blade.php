@props(['user'])

<form action="{{ route('profile.uploadPicture') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label class="cursor-pointer relative">
        <img src="{{ asset($user->picture ?? 'default-user.png') }}"
             class="w-32 h-32 rounded-full border-2 border-gray-300 object-cover"
             alt="Profile Picture">
        <input type="file" name="picture" accept="image/*" class="hidden" onchange="this.form.submit()">
        <span class="absolute bottom-0 right-0 bg-white rounded-full p-1 text-xs shadow">Edit</span>
    </label>
</form>
