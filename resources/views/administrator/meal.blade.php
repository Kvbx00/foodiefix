<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>DANIA</h1>
<a href="{{ route('administrator.addMeal') }}">Dodaj danie</a>
<form action="{{ route('administrator.meal') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th><a href="{{ route('administrator.meal', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th>
            <a href="{{ route('administrator.meal', ['sort' => 'name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Nazwa dania
            </a></th>
        <th>Przepis</th>
        <th>
            <a href="{{ route('administrator.meal', ['sort' => 'meal_category_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Kategoria
            </a></th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($meal as $meals)
        <tr>
            <td>{{ $meals->id }}</td>
            <td>{{ $meals->name }}</td>
            <td>{{ $meals->recipe }}</td>
            <td>{{ $meals->meal_category_name }}</td>
            <td>
                <a href="{{ route('administrator.editMeal', $meals->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeMeal', $meals->id) }}" method="POST">
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
    @if ($meal->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $meal->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $meal->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}" rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $meal->currentPage() }} z {{ $meal->lastPage() }}</span>

    @if ($meal->hasMorePages())
        <a href="{{ $meal->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}" rel="next">&rsaquo;</a>
        <a href="{{ $meal->url($meal->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
