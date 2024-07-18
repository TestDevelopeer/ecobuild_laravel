<div @class([
    'alert alert-dismissible fade show',
    'alert-border-' . $color => $border,
    'alert-' . $color => !$border,
    'bg-grd-' . $color => isset($bgGrd),
])>
    <div class="d-flex align-items-center">
        <div class="font-35 text-{{ $color }}"><i class="{{ $icon }}"></i>
        </div>
        <div class="ms-3">
            <h6 class="mb-0 text-{{ $color }}">{{ $title }}</h6>
            <div class="">{!! $text !!}</div>
        </div>
    </div>
</div>
