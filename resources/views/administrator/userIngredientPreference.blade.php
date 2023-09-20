<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>PREFERENCJE SKŁADNIKÓW UŻYTKOWNIKÓW</h1>
<a href="{{ route('administrator.addUserIngredientPreference') }}">Dodaj preferencję składnika dla użytkownika</a>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nazwa składnika</th>
        <th>Id składnika</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>Id użytkownika</th>
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
                <form action="{{ route('administrator.removeUserIngredientPreference', $ingredientPreferences->id) }}" method="POST">
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
