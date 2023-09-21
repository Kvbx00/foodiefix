<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>ZAPOTRZEBOWANIE KALORYCZNE UŻYTKOWNIKÓW</h1>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Zapotrzebowanie</th>
        <th>Data</th>
        <th>Id użytkownika</th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($caloricNeed as $caloricNeeds)
        <tr>
            <td>{{ $caloricNeeds->id }}</td>
            <td>{{ $caloricNeeds->caloricNeeds }}</td>
            <td>{{ $caloricNeeds->date }}</td>
            <td>{{ $caloricNeeds->user_id }}</td>
            <td>
                <a href="{{ route('administrator.editUserCaloricNeed', $caloricNeeds->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeUserCaloricNeed', $caloricNeeds->id) }}" method="POST">
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
