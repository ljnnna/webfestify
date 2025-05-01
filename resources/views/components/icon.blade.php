@props([
    'name',
    'style' => 'solid', // solid, regular, brands, dsb.
    'class' => '',       // class tambahan seperti text color, size, margin, dst.
])

@php
    // Map style ke prefix FontAwesome
    $stylePrefixMap = [
        'solid' => 'fa-solid',
        'regular' => 'fa-regular',
        'brands' => 'fa-brands',
        'light' => 'fa-light',
        'thin' => 'fa-thin',
        'duotone' => 'fa-duotone',
    ];

    $prefix = $stylePrefixMap[$style] ?? 'fa-solid';
    $iconClass = 'fa-' . $name;
@endphp

<i class="{{ $prefix }} {{ $iconClass }} {{ $class }}"></i>
