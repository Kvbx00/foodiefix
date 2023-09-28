<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>PRACOWNICY</h1>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Rola</th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($administrator as $administrators)
        <tr>
            <td>{{ $administrators->id }}</td>
            <td>{{ $administrators->email }}</td>
            <td>{{ $administrators->role }}</td>
            <td>
                <a href="{{ route('administrator.editAdminProfile', $administrators->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeAdminProfile', $administrators->id) }}" method="POST">
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
