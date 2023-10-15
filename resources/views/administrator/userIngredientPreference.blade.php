<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>PREFERENCJE SKŁADNIKÓW UŻYTKOWNIKÓW</h1>
<a href="{{ route('administrator.addUserIngredientPreference') }}">Dodaj preferencję składnika dla użytkownika</a>
<form action="{{ route('administrator.userIngredientPreference') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th>
            <a href="{{ route('administrator.userIngredientPreference', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th>Nazwa składnika</th>
        <th>
            <a href="{{ route('administrator.userIngredientPreference', ['sort' => 'ingredient_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id składnika
            </a></th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>
            <a href="{{ route('administrator.userIngredientPreference', ['sort' => 'user_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id użytkownika
            </a></th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ingredientPreference as $ingredientPreferences)
        <tr>
            <td>{{ $ingredientPreferences->id }}</td>
            <td>{{ $ingredientPreferences->ingredient_name }}</td>
            <td>{{ $ingredientPreferences->ingredient_id }}</td>
            <td>{{ $ingredientPreferences->user_name }}</td>
            <td>{{ $ingredientPreferences->user_lastName }}</td>
            <td>{{ $ingredientPreferences->user_email }}</td>
            <td>{{ $ingredientPreferences->user_id }}</td>
            <td>
                <form action="{{ route('administrator.removeUserIngredientPreference', $ingredientPreferences->id) }}"
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
    @if ($ingredientPreference->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $ingredientPreference->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $ingredientPreference->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $ingredientPreference->currentPage() }} z {{ $ingredientPreference->lastPage() }}</span>

    @if ($ingredientPreference->hasMorePages())
        <a href="{{ $ingredientPreference->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="next">&rsaquo;</a>
        <a href="{{ $ingredientPreference->url($ingredientPreference->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
