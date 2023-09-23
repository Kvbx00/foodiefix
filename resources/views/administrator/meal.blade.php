<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>DANIA</h1>
<a href="{{ route('administrator.addMeal') }}">Dodaj danie</a>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nazwa dania</th>
        <th>Przepis</th>
        <th>Kategoria</th>
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
</body>

</html>
