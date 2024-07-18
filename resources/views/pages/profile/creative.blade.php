<div @class([
    'tab-pane fade',
    'show active' => isset($type) && $type == 'creative',
]) id="primary-pills-creative" role="tabpanel">
    @if ($user->successResult())
        <div class="row">
            <div class="col-12 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <h5 class="mb-0">Поздравляем, <span class="fw-600">{{ $user->name }}</span>
                                </h5>
                                <img src="/assets/images/apps/party-popper.png" width="24" height="24"
                                    alt="">
                            </div>
                            <p class="mb-4">Вы прошли во второй тур.</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="">
                                    <p class="mb-3">Вам предлагается написать <b>ЭССЕ</b> или
                                        снять
                                        <b>ВИДЕО</b> на
                                        одну из тем:
                                    </p>
                                    <dl class="row mt-2">
                                        <dt class="col-sm-3">Экология:</dt>
                                        <dd class="col-sm-9">
                                            <ul class="list-unstyled">
                                                <li>«Опишите экологическую проблему, которую Вы
                                                    считаете
                                                    наиболее важной для
                                                    нашей страны и возможные пути решения»,</li>
                                                <li>«Способы повышения экологической грамотности
                                                    населения», </li>
                                                <li>«Мой экологический след».</li>
                                            </ul>
                                        </dd>
                                        <dt class="col-sm-3">Строительство:</dt>
                                        <dd class="col-sm-9">
                                            <ul class="list-unstyled">
                                                <li>«Современное креативное строительство»,</li>
                                                <li>«Умный дом будущего», </li>
                                                <li>«Современная архитектура»,</li>
                                                <li>«Почему я хочу стать строителем ?».</li>
                                            </ul>
                                        </dd>
                                    </dl>
                                    <p class="mb-3">Работа должна быть выполнена автором
                                        самостоятельно.</p>
                                    <p class="mb-3">Объем эссе 2-3 страницы машинописного текста,
                                        межстрочный
                                        интервал – 1,5,
                                        абзацный отступ – 1,25, выравнивание – по ширине, тип шрифта
                                        Times New Roman.</p>
                                    <p class="mb-3">
                                        Длина видео: 1 минута 30 секунд. Размер файла: не более
                                        100мб.
                                    </p>
                                    <p><strong>Файлы в формате <code class="badge bg-grd-royal">.doc</code>, <code
                                                class="badge bg-grd-royal">.docx</code> или <code
                                                class="badge bg-grd-royal">.mp4</code>
                                            прикрепить в формы ниже.</strong>
                                    </p>
                                </div>
                                <img src="/assets/images/apps/gift-box-3.png" width="100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            @if ($user->result('eco') && $user->result('eco')->points > config('custom.creative.min'))
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <input id="upload-eco" type="file" name="files"
                                accept=".jpg, .png, image/jpeg, image/png" multiple="">
                        </div>
                    </div>
                </div>
            @endif
            @if ($user->result('build') && $user->result('build')->points > config('custom.creative.min'))
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <input id="upload-build" type="file" name="files"
                                accept=".jpg, .png, image/jpeg, image/png" multiple="">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @else
        @include('components.alert', [
            'border' => true,
            'color' => 'primary',
            'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
            'title' => 'Не набрано требуемое количество баллов',
            'text' => 'К сожалению Вы не набрали достаточного количества баллов для участия в креативном задании',
        ])
    @endif
</div>
