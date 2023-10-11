<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>MENU UŻYTKOWNIKÓW</h1>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Data</th>
        <th>Dzień tygodnia</th>
        <th>Id użytkownika</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($menu as $menus)
        <tr>
            <td>{{ $menus->id }}</td>
            <td>{{ $menus->date }}</td>
            <td>{{ $menus->dayOfTheWeek }}</td>
            <td>{{ $menus->user_id }}</td>
            <td>{{ $menus->user_name }}</td>
            <td>{{ $menus->user_lastName }}</td>
            <td>{{ $menus->user_email }}</td>
            <td>
                <form action="{{ route('administrator.removeUserMenu', $menus->id) }}" method="POST">
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
