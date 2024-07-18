@if (isset($breadcrumb))
    <!--breadcrumb-->
    <div class="d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{ $breadcrumb['pageName'] }}</div>
        @if (isset($breadcrumb['breadcrumb']))
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        @foreach ($breadcrumb['breadcrumb'] as $key => $item)
                            <li @class([
                                'breadcrumb-item',
                                'active' => $key === array_key_last($breadcrumb['breadcrumb']),
                            ])>
                                @if (isset($item['link']))
                                    <a href="{{ $item['link'] }}">
                                @endif
                                @if (isset($item['icon']))
                                    <i class="{{ $item['icon'] }}"></i>
                                @endif
                                {{ $item['text'] }}
                                @if (isset($item['link']))
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        @endif
    </div>
    <!--end breadcrumb-->
@endif
