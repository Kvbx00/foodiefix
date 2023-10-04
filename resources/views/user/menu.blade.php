<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>

<h2>Utwórz Nowe Menu</h2>
<form action="{{ route('menu.create') }}" method="post">
    @csrf
    <button type="submit">Utwórz Jadłospis</button>
</form>

<table>
    <thead>
    <tr>
        @foreach($daysOfWeek as $day)
            <th>{{ $day }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    <tr>
        @foreach($daysOfWeek as $day)
            <td>
                @foreach($groupedMenuMeals[$day] as $menuMeal)
                    {{ $menuMeal->meal->name }}<br>
                @endforeach
            </td>
        @endforeach
    </tr>
    </tbody>
</table>
</body>
</html>

