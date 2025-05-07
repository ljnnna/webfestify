@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-purple-600 dark:text-purple-400']) }}>
    {{ $value ?? $slot }}
</label>

