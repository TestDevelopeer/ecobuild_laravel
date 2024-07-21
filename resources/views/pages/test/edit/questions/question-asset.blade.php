@if (isset($questionEdit->id) && $questionEdit->type_id > 1 && $questionEdit->assets)
    <div class="row">
        @foreach ($questionEdit->assets as $asset)
            <div @class([
                'col-12',
                'col-lg-4' => $questionEdit->type_id < 4,
                'col-lg-6' => $questionEdit->type_id == 4,
            ])>
                <div class="chip chip-md bg-white border-0 question-asset question-{{ $questionEdit->type->slug }}">
                    @if ($questionEdit->type_id == 2)
                        <img src="{{ asset("storage/$asset") }}" alt="{{ $asset }}">
                        <span class="closebtn delete-question-asset" data-path="{{ $asset }}"><i
                                class="fa-solid fa-trash"></i></span>
                        <span class="zoombtn"><a data-lightbox="image-{{ $questionEdit->id }}"
                                data-title="{{ $asset }}" href="{{ asset("storage/$asset") }}"><i
                                    class="fa-solid fa-magnifying-glass-plus"></i></a></span>
                    @elseif ($questionEdit->type_id == 3)
                        <video src="{{ asset("storage/$asset") }}" controls></video>
                        <span class="closebtn delete-question-asset" data-path="{{ $asset }}"><i
                                class="fa-solid fa-trash"></i></span>
                    @elseif ($questionEdit->type_id == 4)
                        <audio src="{{ asset("storage/$asset") }}" controls></audio>
                        <span class="closebtn delete-question-asset" data-path="{{ $asset }}"><i
                                class="fa-solid fa-trash"></i></span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif
