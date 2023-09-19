<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>CHOROBY UŻYTKOWNIKÓW</h1>
<a href="{{ route('administrator.addUserDisease') }}">Dodaj chorobę użytkownikowi</a>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nazwa choroby</th>
        <th>Id choroby</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>Id użytkownika</th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($userDisease as $userDiseases)
        <tr>
            <td>{{ $userDiseases->id }}</td>
            <td>{{ $userDiseases->disease_name }}</td>
            <td>{{ $userDiseases->diseases_id }}</td>
            <td>{{ $userDiseases->user_name }}</td>
            <td>{{ $userDiseases->user_lastName }}</td>
            <td>{{ $userDiseases->user_email }}</td>
            <td>{{ $userDiseases->user_id }}</td>
            <td>
                <form action="{{ route('administrator.removeUserDisease', $userDiseases->id) }}" method="POST">
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
