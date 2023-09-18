<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
{{ ('admin dashboard') }}
<br>
<a href="{{ url('adminRegister') }}">Rejestracja pracownika</a>

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit">Wyloguj się</button>
</form>
</body>

</html>
