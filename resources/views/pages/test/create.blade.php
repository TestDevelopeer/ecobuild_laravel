@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Создать тестирование</h5>
                    <form action="{{ route('test.create') }}" method="post" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Введите название тестирования">
                        </div>
                        <div class="col-md-6">
                            <label for="icon" class="form-label">Выберите иконку тестирования для личного кабинета
                                пользователя</label>
                            <input class="form-control" name="icon" type="file" id="icon">
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-success px-4">Создать</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
