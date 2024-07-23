@if ($remainigQuiz)
    <div class="col-12">
        <div class="progress mb-4">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                style="width: {{ (($quizReadyCount + 1) / $quizRemainigCount) * 100 }}%;"
                aria-valuenow="{{ $quizReadyCount + 1 }}" aria-valuemin="1" aria-valuemax="{{ $quizRemainigCount }}">
                {{ $quizReadyCount + 1 }}/{{ $quizRemainigCount }}
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="alert alert-border-secondary alert-dismissible fade show">
            <div class="d-flex align-items-center">
                <div class="font-35 text-secondary"><i class="fa-duotone fa-solid fa-question fa-2x"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-secondary">{{ $remainigQuiz->question->text }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card h-100">
            <div class="card-body">
                <div class="row justify-content-center question-assets">
                    @if ($remainigQuiz->question->type_id > 1)
                        <div class="col-12 col-lg-6">
                            @if ($remainigQuiz->question->type_id == 2)
                                <div id="carouselExampleControls" class="carousel slide question-assets-carousel"
                                    data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($remainigQuiz->assets as $key => $value)
                                            <div @class(['carousel-item', 'active' => $key == 0])>
                                                <a data-lightbox="image-{{ $remainigQuiz->id }}"
                                                    data-title="{{ $remainigQuiz->text }}"
                                                    href="{{ asset("storage/$value") }}">
                                                    <img src="{{ asset("storage/$value") }}" class="d-block w-100"
                                                        alt="..."></a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                        data-bs-slide="prev"> <i class="fa-solid fa-chevron-left fa-2x"
                                            aria-hidden="true"></i>
                                        <span class="visually-hidden">Назад</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                        data-bs-slide="next"> <i class="fa-solid fa-chevron-right fa-2x"
                                            aria-hidden="true"></i>
                                        <span class="visually-hidden">Далее</span>
                                    </a>
                                </div>
                            @elseif ($remainigQuiz->question->type_id == 3)
                                @foreach ($remainigQuiz->assets as $key => $value)
                                    <div class="col-12">
                                        <video class="d-block w-100" src="{{ asset("storage/$value") }}"
                                            controls></video>
                                    </div>
                                @endforeach
                            @elseif ($remainigQuiz->question->type_id == 4)
                                @foreach ($remainigQuiz->assets as $key => $value)
                                    <div class="col-12">
                                        <audio class="w-100" src="{{ asset("storage/$value") }}" controls></audio>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endif
                    <div class="col-12 col-lg-6">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="quiz-form" action="{{ route('quizzes.update', ['quiz' => $remainigQuiz->id]) }}"
                            method="post">
                            @csrf
                            @foreach ($remainigQuiz->question->answersForQuiz as $key => $value)
                                <div class="input-field bounce-left">
                                    <div class="option">
                                        {{ $key + 1 }}
                                    </div>
                                    <div class="radio-field">
                                        <input type="radio" name="answer_id" value="{{ $value->id }}">
                                        <label>{{ $value->text }}</label>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-success px-5" disabled id="next-quiz">
                                    <span class="spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Далее
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
@endif
