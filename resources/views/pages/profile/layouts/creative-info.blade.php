<div class="row">
    <div class="col-12 d-flex">
        <div class="">
            {!! $creative->html !!}
        </div>
    </div>
    <div class="col-12" id="creative-upload-container">
        @if ($creativeUpload)
            @if ($userId == null)
                @include('components.alert', [
                    'border' => true,
                    'color' => 'success',
                    'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
                    'title' => 'Файлы загружены!',
                    'text' => 'Задание отправлено на проверку, ответ появится в вашем профиле',
                ])
            @else
            @endif
            <form method="post"
                action="{{ route('creative.archive', ['creativeId' => $creative->id, 'userId' => $userId ?? Auth::id()]) }}">
                @csrf
                <button type="submit" class="btn btn-primary px-4 raised align-items-center d-flex gap-2"><i
                        class="fa-regular fa-cloud-arrow-down"></i>Скачать прикрепленные файлы</button>
            </form>
        @else
            <form id="creative-form" action="{{ route('creative.upload', ['creative' => $creative->id]) }}"
                method="POST">
                @csrf
                <input id="creative-uploader" type="file" class="filepond" name="creative_assets[]" multiple
                    data-max-file-size="3MB" data-max-files="3" />
                <button id="creative-upload" type="button" disabled
                    class="btn btn-outline-secondary align-items-center justify-content-center px-4 d-flex gap-2 w-100 upload-creative"><i
                        class="fa-regular fa-upload"></i>Загрузить</button>
            </form>
        @endif
    </div>
</div>
