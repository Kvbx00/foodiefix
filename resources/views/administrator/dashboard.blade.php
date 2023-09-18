<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
{{ ('admin dashboard') }}
<br>
@if( auth()->guard('admin')->user()->role === 'admin')
    <a href="{{ url('adminRegister') }}">Rejestracja pracownika</a>
@endif

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit">Wyloguj się</button>
</form>
</body>

</html>
