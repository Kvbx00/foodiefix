<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h2>Aktualne Menu</h2>
<table>
    @foreach($allMenu as $userMenu)
        <tr>
            {{ $userMenu->dayOfTheWeek }}
        </tr>
    @endforeach
</table>

<h2>Utwórz Nowe Menu</h2>
<form action="{{ route('menu.create') }}" method="post">
    @csrf
    <button type="submit">Utwórz Jadłospis</button>
</form>
</body>
</html>

