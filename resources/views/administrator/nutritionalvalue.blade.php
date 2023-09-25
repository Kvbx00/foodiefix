<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>WARTOŚCI ODŻYWCZE</h1>
<a href="{{ route('administrator.addNutritionalvalue') }}">Dodaj wartości odżywcze do dania</a>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Kalorie</th>
        <th>Białko</th>
        <th>Tłuszcze</th>
        <th>Węglowodany</th>
        <th>Id dania</th>
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
</body>

</html>
