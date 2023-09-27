<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>DANE UŻYTKOWNIKÓW</h1>
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Email</th>
            <th>Płeć</th>
            <th>Wzrost</th>
            <th>Waga</th>
            <th>Wiek</th>
            <th>Aktywność fizyczna</th>
            <th>Cel</th>
            <th>Data utworzenia</th>
            <th>Akcja</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user as $users)
            <tr>
                <td>{{ $users->id }}</td>
                <td>{{ $users->name }}</td>
                <td>{{ $users->lastName }}</td>
                <td>{{ $users->email }}</td>
                <td>{{ $users->gender }}</td>
                <td>{{ $users->height }}</td>
                <td>{{ $users->weight }}</td>
                <td>{{ $users->age }}</td>
                <td>{{ $users->physicalActivity }}</td>
                <td>{{ $users->goal }}</td>
                <td>{{ $users->created_at }}</td>
                <td>
                    <a href="{{ route('administrator.editUserProfile', $users->id) }}">Edytuj</a>
                    <form action="{{ route('administrator.removeUserProfile', $users->id) }}" method="POST">
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
