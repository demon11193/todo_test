@extends('layouts.app')

@section('content')

    <h1>{{is_null($task->id)?'Создание задачи':'Редактирование задачи #' . $task->id}}</h1>
    <form action="/tasks{{is_null($task->id)?'':'/'.$task->id}}" method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{$task->email}}"/>
        </div>
        <div class="form-group">
            <label>Имя пользователя</label>
            <input type="text" class="form-control" name="username" value="{{$task->username}}"/>
        </div>
        <div class="form-group">
            <label>Текст</label>
            <textarea class="form-control" name="content">{{$task->content}}</textarea>
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input"
                       value="1" name="is_finished" {{$task->is_finished?'checked':''}}/> Выполнено?
            </label>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <a class="btn btn-link" href="/">Назад к списку</a>
        </div>
    </form>

@endsection