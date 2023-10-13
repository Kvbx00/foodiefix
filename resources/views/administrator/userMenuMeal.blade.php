<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>DANIA W MENU UŻYTKOWNIKÓW</h1>
<a href="{{ route('administrator.addUserMenuMeal') }}">Dodaj danie</a>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Id Menu</th>
        <th>Id Dania</th>
        <th>Nazwa Dania</th>
        <th>Id Kategorii Dania</th>
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
</body>

</html>
