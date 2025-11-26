<div {{ $attributes->merge(['class' => 'text-yellow-600']) }}>
    @for ($i = 1; $i <= $max; $i++)
        {{ $i <= $value ? '★' : '☆' }}
    @endfor
</div>