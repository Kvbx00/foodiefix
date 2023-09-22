<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>KATEGORIE DAŃ</h1>
<a href="{{ route('administrator.addMealCategory') }}">Dodaj kategorię</a>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nazwa kategorii</th>
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
</body>

</html>
