<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>SKŁADNIKI</h1>
<a href="{{ route('administrator.addIngredient') }}">Dodaj składnik</a>
<form action="{{ route('administrator.ingredient') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th><a href="{{ route('administrator.ingredient', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th><a href="{{ route('administrator.ingredient', ['sort' => 'name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Nazwa składnika
            </a></th>
        <th><a href="{{ route('administrator.ingredient', ['sort' => 'category_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id kategorii
            </a></th>
        <th>Kategoria</th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ingredient as $ingredients)
        <tr>
            <td>{{ $ingredients->id }}</td>
            <td>{{ $ingredients->name }}</td>
            <td>{{ $ingredients->category_id }}</td>
            <td>{{ $ingredients->ingredient_category_name }}</td>
            <td>
                <a href="{{ route('administrator.editIngredient', $ingredients->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeIngredient', $ingredients->id) }}" method="POST">
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
    @if ($ingredient->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $ingredient->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $ingredient->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $ingredient->currentPage() }} z {{ $ingredient->lastPage() }}</span>

    @if ($ingredient->hasMorePages())
        <a href="{{ $ingredient->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="next">&rsaquo;</a>
        <a href="{{ $ingredient->url($ingredient->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
