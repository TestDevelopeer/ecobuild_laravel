@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Создать тестирование</h5>
                    <form action="{{ route('tests.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 col-md-6">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control @error('name') error @enderror" name="name"
                                id="name" placeholder="Введите название тестирования" value="{{ old('name') }}">
                            @include('components.error-text', ['name' => 'name'])
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="icon" class="form-label">Выберите иконку для личного кабинета
                                пользователя</label>

                            <input class="form-control" name="icon" type="file" id="icon"
                                value="{{ old('icon') }}" accept="image/*">
                            @include('components.error-text', ['name' => 'icon'])
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="icon" class="form-label">Выберите сертификат за участие</label>

                            <input class="form-control" name="certificate" type="file" id="certificate"
                                value="{{ old('certificate') }}" accept="image/*">
                            @include('components.error-text', ['name' => 'certificate'])
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="diplom" class="form-label">Выберите диплом за результат</label>
                            <input class="form-control" name="diplom" type="file" id="diplom"
                                value="{{ old('diplom') }}" accept="image/*">
                            @include('components.error-text', ['name' => 'diplom'])
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <x-button type="submit" color='success' is-outline=true>
                                    <i class="fa-solid fa-circle-plus"></i>
                                    Создать
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
