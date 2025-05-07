@props(['disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'border border-purple-500 focus:border-purple-700 focus:ring-purple-500 rounded-md shadow-sm bg-white text-gray-900'
    ]) !!}
/>
