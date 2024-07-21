<button type="{{ $type ?? button }}"
    {{ $attributes->class([
        'btn px-4 d-flex gap-2 justify-content-center align-items-center',
        "btn-outline-$color" => $isOutline,
        "btn-$color" => !$isOutline,
    ]) }}>
    {{ $slot }}
</button>
