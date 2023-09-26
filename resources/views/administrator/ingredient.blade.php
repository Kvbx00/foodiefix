<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>SKŁADNIKI</h1>
<a href="{{ route('administrator.addIngredient') }}">Dodaj składnik</a>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nazwa składnika</th>
        <th>Kategoria</th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ingredient as $ingredients)
        <tr>
            <td>{{ $ingredients->id }}</td>
            <td>{{ $ingredients->name }}</td>
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
</body>

</html>
