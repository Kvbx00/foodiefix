<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>KATEGORIE SKŁADNIKÓW</h1>
<a href="{{ route('administrator.addIngredientCategory') }}">Dodaj kategorię</a>
<form action="{{ route('administrator.ingredientCategory') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th>
            <a href="{{ route('administrator.ingredientCategory', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th>
            <a href="{{ route('administrator.ingredientCategory', ['sort' => 'name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Nazwa kategorii
            </a></th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ingredientCategory as $ingredientCategories)
        <tr>
            <td>{{ $ingredientCategories->id }}</td>
            <td>{{ $ingredientCategories->name }}</td>
            <td>
                <a href="{{ route('administrator.editIngredientCategory', $ingredientCategories->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeIngredientCategory', $ingredientCategories->id) }}"
                      method="POST">
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
    @if ($ingredientCategory->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $ingredientCategory->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $ingredientCategory->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $ingredientCategory->currentPage() }} z {{ $ingredientCategory->lastPage() }}</span>

    @if ($ingredientCategory->hasMorePages())
        <a href="{{ $ingredientCategory->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="next">&rsaquo;</a>
        <a href="{{ $ingredientCategory->url($ingredientCategory->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
