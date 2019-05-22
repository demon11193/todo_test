@extends('layouts.app')

@section('content')

    <h1>Список задач</h1>
    <div class="row" style="margin-top: 30px;margin-bottom: 20px;">
        <div class="col-md-6">
            <form method="get">
                <input type="hidden" name="page" value="{{$page}}" />
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Сортировка:</div>
                    </div>
                    <select name="sort" class="form-control">
                        <option value="id"{{$sort=='id'?' selected':''}}>№</option>
                        <option value="user"{{$sort=='user'?' selected':''}}>Имя пользователя</option>
                        <option value="email"{{$sort=='email'?' selected':''}}>Email</option>
                        <option value="status"{{$sort=='status'?' selected':''}}>Статус</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary">ОК</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6" style="text-align: right;">
            <a class="btn btn-secondary" href="/tasks" role="button">Создать задачу</a>
        </div>
    </div>
    <hr>
    @if ($tasks->isEmpty())
        <i>Нет доступных задач.</i>
    @else
        @foreach($tasks as $task)
            <h2>Задача {{$task->id}}{!! $task->is_finished?' <b>(Завершена)</b>':'' !!}</h2>
            <div class="row">
                <div class="col-md-8">{{$task->content}}</div>
                <div class="col-md-4 text-right">
                    @if (!is_null($task->user))
                        <i style="padding-left: 10px;">Автор: {{$task->user->name}}</i>
                    @endif
                    @if (\App\Core\Auth::hasAuth())
                        <a class="btn btn-link" href="/tasks/{{$task->id}}" role="button">Редактировать</a>
                    @endif
                </div>
            </div>
            <hr>
        @endforeach
    @endif

    @if ($max_page > 1)
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="?page=1&sort={{$sort}}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                @if ($page > 1)
                    <li class="page-item">
                        <a class="page-link" href="?page={{$page-1}}&sort={{$sort}}">{{$page-1}}</a>
                    </li>
                @endif
                <li class="page-item active"><a class="page-link" href="?page={{$page}}&sort={{$sort}}">{{$page}}</a></li>
                @if ($page < $max_page)
                    <li class="page-item">
                        <a class="page-link" href="?page={{$page+1}}&sort={{$sort}}">{{$page+1}}</a>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="?page={{$max_page}}&sort={{$sort}}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    @endif
@endsection