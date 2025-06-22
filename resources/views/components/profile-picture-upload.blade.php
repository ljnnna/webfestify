@props(['user'])

<form id="profile-picture-form" action="{{ route('profile.uploadPicture') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label class="cursor-pointer relative group">
        <img src="{{ $user->picture 
                 ? asset('storage/' . $user->picture) . '?' . $user->updated_at->timestamp 
                 : asset('images/default-user.png') }}"
             class="w-32 h-32 rounded-full border-2 border-gray-300 object-cover transition duration-200 group-hover:opacity-80"
             alt="Profile Picture">

        <input 
            type="file" 
            name="picture" 
            accept="image/*" 
            class="hidden" 
            onchange="checkFileSize(this)">
        
        <span class="absolute bottom-0 right-0 bg-white text-purple-700 border border-purple-300 rounded-full p-1 text-xs shadow group-hover:bg-purple-100">
            Edit
        </span> 
    </label>
</form>
