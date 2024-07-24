@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table mb-0 table-hover">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Email</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Сообщение</th>
                        <th scope="col">Дата</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feedbacks as $feedback)
                        <tr>
                            <th scope="row">#{{ $feedback->id }}</th>
                            <td>
                                @if (!$feedback->is_read)
                                    <a title="Отметить прочитанным" href="javascript:;" class="read-feedback"
                                        data-feedback="{{ $feedback->id }}">
                                        <i class="fa-regular fa-check-to-slot mx-2"></i>
                                    </a>
                                @else
                                    <i class="fa-regular fa-check-to-slot mx-2"></i>
                                @endif

                            </td>
                            <td>{{ $feedback->email }}</td>
                            <td>{{ $feedback->phone }}</td>
                            <td class="feedback-text">{{ $feedback->message }}</td>
                            <td>{{ $feedback->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2 d-flex justify-content-center">
                {{ $feedbacks->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
