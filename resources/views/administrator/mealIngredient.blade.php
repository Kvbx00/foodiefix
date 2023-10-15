<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>SKŁADNIKI W DANIACH</h1>
<a href="{{ route('administrator.addMealIngredient') }}">Dodaj składnik do dania</a>
<form action="{{ route('administrator.mealIngredient') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th><a href="{{ route('administrator.mealIngredient', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th><a href="{{ route('administrator.mealIngredient', ['sort' => 'meal_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id dania
            </a></th>
        <th>Nazwa dania</th>
        <th><a href="{{ route('administrator.mealIngredient', ['sort' => 'ingredient_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id składnika
            </a></th>
        <th>Nazwa składnika</th>
        <th><a href="{{ route('administrator.mealIngredient', ['sort' => 'quantity', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Ilość
            </a></th>
        <th><a href="{{ route('administrator.mealIngredient', ['sort' => 'unit', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Jednostka
            </a></th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mealIngredient as $mealIngredients)
        <tr>
            <td>{{ $mealIngredients->id }}</td>
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
<div class="pagination">
    @if ($mealIngredient->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $mealIngredient->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $mealIngredient->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $mealIngredient->currentPage() }} z {{ $mealIngredient->lastPage() }}</span>

    @if ($mealIngredient->hasMorePages())
        <a href="{{ $mealIngredient->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="next">&rsaquo;</a>
        <a href="{{ $mealIngredient->url($mealIngredient->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
