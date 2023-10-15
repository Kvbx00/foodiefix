<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>CHOROBY UŻYTKOWNIKÓW</h1>
<a href="{{ route('administrator.addUserDisease') }}">Dodaj chorobę użytkownikowi</a>
<form action="{{ route('administrator.userDisease') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th>
            <a href="{{ route('administrator.userDisease', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th>Nazwa choroby</th>
        <th>
            <a href="{{ route('administrator.userDisease', ['sort' => 'diseases_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id choroby
            </a></th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>
            <a href="{{ route('administrator.userDisease', ['sort' => 'user_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id użytkownika
            </a></th>
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
<div class="pagination">
    @if ($userDisease->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $userDisease->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $userDisease->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}" rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $userDisease->currentPage() }} z {{ $userDisease->lastPage() }}</span>

    @if ($userDisease->hasMorePages())
        <a href="{{ $userDisease->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}" rel="next">&rsaquo;</a>
        <a href="{{ $userDisease->url($userDisease->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
