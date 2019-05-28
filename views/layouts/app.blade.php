<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>TO DO list</title>
</head>
<body>


    <div style="padding: 30px;background: #6c757d;height: 96px;text-align: right;">
        @if (\App\Core\Auth::hasAuth())
            <span style="color: white;vertical-align: middle;">Здравствуйте, {{\App\Core\Auth::user()->name}}.</span>
            <a class="btn btn-link" href="/logout">Выйти</a>
        @else
            <form class="input-group input-group-sm" style="max-width: 400px;float: right;" method="post" action="/auth">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Авторизация:</span>
                </div>
                <input type="text" placeholder="Логин" name="login" class="form-control form-control-sm">
                <input type="password" placeholder="Пароль" name="password" class="form-control form-control-sm">
                <button type="submit" class="btn btn-sm btn-primary">ОК</button>
            </form>
        @endif
    </div>

    <div class="container">

        @if (\App\Core\Session::get('error'))
            <div class="alert alert-danger"
                 style="margin-top: 10px;white-space: pre-line;"
                 role="alert">{{\App\Core\Session::getAndRemove('error')}}</div>
        @endif

        @yield('content')
        <hr>

        <footer>
            <p>&copy; Амиров Эльдар 2019</p>
        </footer>
    </div> <!-- /container -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</body>
</html>