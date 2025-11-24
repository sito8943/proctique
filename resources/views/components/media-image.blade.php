@if (!empty($url))
    <img src="{{ $url }}" alt="{{ $alt }}" class="{{ $class }}" />
@else
    @php $bg = str_contains($class, 'bg-') ? '' : ' bg-gray-200'; @endphp
    <div class="{{ $class }}{{ $bg }} flex items-center justify-center overflow-hidden">
        <img src="/favicon.svg" alt="" class="w-1/3 h-1/3 opacity-60" />
    </div>
@endif
