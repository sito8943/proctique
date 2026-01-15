@props([
    'href',
    'active' => false,
    'layout' => 'desktop', // 'desktop' | 'mobile'
])

@php
    if ($layout === 'mobile') {
        $base = 'flex items-center h-[34px] w-full rounded-3xl px-4';
        $state = $active ? 'text-white bg-blue-600' : 'text-blue-600 hover:bg-blue-50';
    } else {
        $base = 'transition rounded-3xl px-4 flex items-center h-[34px] hover:text-blue-600 hover:bg-white';
        $state = $active ? 'text-white bg-blue-600' : 'text-white';
    }
    $classes = trim("$base $state");
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
