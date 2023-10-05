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
                    @if(isset($menuMeal->meal))
                        {{ $menuMeal->meal->mealCategory_name }}<br>
                        {{ $menuMeal->meal->name }}<br>
                    @endif
                @endforeach
                    <strong>Total Calories: {{ $groupedMenuMeals[$day]['totalCalories'] }}</strong>
            </td>
        @endforeach
    </tr>
    </tbody>
</table>
</body>
</html>

