<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>DANIA W MENU UŻYTKOWNIKÓW</h1>
<a href="{{ route('administrator.addUserMenuMeal') }}">Dodaj danie</a>
<form action="{{ route('administrator.userMenuMeal') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th><a href="{{ route('administrator.userMenuMeal', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th><a href="{{ route('administrator.userMenuMeal', ['sort' => 'menu_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id Menu
            </a></th>
        <th><a href="{{ route('administrator.userMenuMeal', ['sort' => 'meal_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id Dania
            </a></th>
        <th>Nazwa Dania</th>
        <th><a href="{{ route('administrator.userMenuMeal', ['sort' => 'meal_meal_category_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id Kategorii Dania
            </a></th>
        <th>Nazwa Kategorii Dania</th>
    </tr>
    </thead>
    <tbody>
    @foreach($menuMeal as $menuMeals)
        <tr>
            <td>{{ $menuMeals->id }}</td>
            <td>{{ $menuMeals->menu_id }}</td>
            <td>{{ $menuMeals->meal_id }}</td>
            <td>{{ $menuMeals->meal_name }}</td>
            <td>{{ $menuMeals->meal_meal_category_id }}</td>
            <td>{{ $menuMeals->mealCategory_name }}</td>
            <td>
                <a href="{{ route('administrator.editUserMenuMeal', $menuMeals->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeUserMenuMeal', $menuMeals->id) }}" method="POST">
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
    @if ($menuMeal->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $menuMeal->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $menuMeal->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $menuMeal->currentPage() }} z {{ $menuMeal->lastPage() }}</span>

    @if ($menuMeal->hasMorePages())
        <a href="{{ $menuMeal->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="next">&rsaquo;</a>
        <a href="{{ $menuMeal->url($menuMeal->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
