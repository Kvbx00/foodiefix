<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>WARTOŚCI ODŻYWCZE</h1>
<a href="{{ route('administrator.addNutritionalvalue') }}">Dodaj wartości odżywcze do dania</a>
<form action="{{ route('administrator.nutritionalvalue') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th><a href="{{ route('administrator.nutritionalvalue', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th><a href="{{ route('administrator.nutritionalvalue', ['sort' => 'calories', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Kalorie
            </a></th>
        <th><a href="{{ route('administrator.nutritionalvalue', ['sort' => 'protein', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Białko
            </a></th>
        <th><a href="{{ route('administrator.nutritionalvalue', ['sort' => 'fats', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Tłuszcze
            </a></th>
        <th><a href="{{ route('administrator.nutritionalvalue', ['sort' => 'carbohydrates', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Węglowodany
            </a></th>
        <th><a href="{{ route('administrator.nutritionalvalue', ['sort' => 'meal_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id dania
            </a></th>
        <th>Nazwa dania</th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nutritionalvalue as $nutritionalvalues)
        <tr>
            <td>{{ $nutritionalvalues->id }}</td>
            <td>{{ $nutritionalvalues->calories }}</td>
            <td>{{ $nutritionalvalues->protein }}</td>
            <td>{{ $nutritionalvalues->fats }}</td>
            <td>{{ $nutritionalvalues->carbohydrates }}</td>
            <td>{{ $nutritionalvalues->meal_id }}</td>
            <td>{{ $nutritionalvalues->meal_name }}<td>
                <a href="{{ route('administrator.editNutritionalvalue', $nutritionalvalues->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeNutritionalvalue', $nutritionalvalues->id) }}" method="POST">
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
    @if ($nutritionalvalue->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $nutritionalvalue->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $nutritionalvalue->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $nutritionalvalue->currentPage() }} z {{ $nutritionalvalue->lastPage() }}</span>

    @if ($nutritionalvalue->hasMorePages())
        <a href="{{ $nutritionalvalue->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="next">&rsaquo;</a>
        <a href="{{ $nutritionalvalue->url($nutritionalvalue->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
