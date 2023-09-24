<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>SKŁADNIKI W DANIACH</h1>
<a href="{{ route('administrator.addMealIngredient') }}">Dodaj składnik do dania</a>
<table>
    <thead>
    <tr>
        <th>Id dania</th>
        <th>Nazwa dania</th>
        <th>Id składnika</th>
        <th>Nazwa składnika</th>
        <th>Ilość</th>
        <th>Jednostka</th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mealIngredient as $mealIngredients)
        <tr>
            <td>{{ $mealIngredients->meal_id }}</td>
            <td>{{ $mealIngredients->meal_name }}</td>
            <td>{{ $mealIngredients->ingredient_id }}</td>
            <td>{{ $mealIngredients->ingredient_name }}</td>
            <td>{{ $mealIngredients->quantity}}</td>
            <td>{{ $mealIngredients->unit }}</td>
            <td>
                <a href="{{ route('administrator.editMealIngredient', $mealIngredients->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeMealIngredient', $mealIngredients->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Usuń</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>

</html>
