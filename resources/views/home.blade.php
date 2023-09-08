<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
    {{ ('Witaj na stronie domowej') }}

    <a href="{{ url('userPanel') }}">Panel użytkownika</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Wyloguj się</button>
    </form>
</body>

</html>
