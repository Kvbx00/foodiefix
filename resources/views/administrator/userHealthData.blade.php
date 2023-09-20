<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>DANE ZDROWOTNE UŻYTKOWNIKÓW</h1>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Waga</th>
        <th>Rozkurczowe ciśnienie krwi</th>
        <th>Skurczowe ciśnienie krwi</th>
        <th>Puls</th>
        <th>Data</th>
        <th>Id użytkownika</th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($healthData as $userHealthData)
        <tr>
            <td>{{ $userHealthData->id }}</td>
            <td>{{ $userHealthData->weight }}</td>
            <td>{{ $userHealthData->diastolicBloodPressure }}</td>
            <td>{{ $userHealthData->systolicBloodPressure }}</td>
            <td>{{ $userHealthData->pulse }}</td>
            <td>{{ $userHealthData->date }}</td>
            <td>{{ $userHealthData->user_id }}</td>
            <td>
                <a href="{{ route('administrator.editUserHealthData', $userHealthData->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeUserHealthData', $userHealthData->id) }}" method="POST">
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
