@props([
    'href',
    'active' => false,
    'layout' => 'desktop', // 'desktop' | 'mobile'
])

@php
    if ($layout === 'mobile') {
        $base = 'block w-full rounded-3xl px-4 py-2';
        $state = $active ? 'text-white bg-blue-600' : 'text-blue-600 hover:bg-blue-50';
    } else {
        $base = 'transition rounded-3xl px-4 py-1 hover:text-blue-600 hover:bg-white';
        $state = $active ? 'text-blue-600 bg-white' : 'text-white';
    }
    $classes = trim("$base $state");
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
