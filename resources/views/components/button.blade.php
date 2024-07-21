<button
    @if (isset($data)) @foreach ($data as $key => $d)
	data-{{ $key }}="{{ $d }}"
@endforeach @endif
    type="{{ $type ?? button }}" @class([
        'btn px-4 d-flex gap-2 justify-content-center align-items-center',
        'btn-outline-{{ $style }}' => $outline,
        'btn-{{ $style }}' => !$outline,
        $classes,
    ])>
    @if (isset($icon))
        <i class="{{ $icon }}"></i>
    @endif
    @if (isset($text))
        {{ $text }}
    @endif
</button>
