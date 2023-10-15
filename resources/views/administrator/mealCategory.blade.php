<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>KATEGORIE DAŃ</h1>
<a href="{{ route('administrator.addMealCategory') }}">Dodaj kategorię</a>
<form action="{{ route('administrator.mealCategory') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th><a href="{{ route('administrator.mealCategory', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th><a href="{{ route('administrator.mealCategory', ['sort' => 'name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Nazwa kategorii
            </a></th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mealCategory as $mealCategories)
        <tr>
            <td>{{ $mealCategories->id }}</td>
            <td>{{ $mealCategories->name }}</td>
            <td>
                <a href="{{ route('administrator.editMealCategory', $mealCategories->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeMealCategory', $mealCategories->id) }}" method="POST">
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
    @if ($mealCategory->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $mealCategory->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $mealCategory->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $mealCategory->currentPage() }} z {{ $mealCategory->lastPage() }}</span>

    @if ($mealCategory->hasMorePages())
        <a href="{{ $mealCategory->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="next">&rsaquo;</a>
        <a href="{{ $mealCategory->url($mealCategory->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
