<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>KATEGORIE SKŁADNIKÓW</h1>
<a href="{{ route('administrator.addIngredientCategory') }}">Dodaj kategorię</a>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nazwa kategorii</th>
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
                <form action="{{ route('administrator.removeIngredientCategory', $ingredientCategories->id) }}" method="POST">
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
