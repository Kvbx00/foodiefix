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
        @foreach($groupedMenuMeals as $dayOfWeek => $meals)
            <th>{{ $dayOfWeek }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($meals as $menuMeal)
        <tr>
            @foreach($groupedMenuMeals as $dayOfWeek => $meals)
                <td>
                    @foreach($meals as $dayMeal)
                        @if($dayMeal->meal->meal_category_id == $menuMeal->meal->meal_category_id)
                            <div>{{ $dayMeal->meal->meal_category_name }}</div>
                            <div>{{ $dayMeal->meal->name }}</div>
                        @endif
                    @endforeach
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

