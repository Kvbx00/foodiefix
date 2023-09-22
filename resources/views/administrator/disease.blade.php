<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>CHOROBY</h1>
<a href="{{ route('administrator.addDisease') }}">Dodaj chorobę</a>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nazwa choroby</th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($disease as $diseases)
        <tr>
            <td>{{ $diseases->id }}</td>
            <td>{{ $diseases->name }}</td>
            <td>
                <a href="{{ route('administrator.editDisease', $diseases->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeDisease', $diseases->id) }}" method="POST">
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
