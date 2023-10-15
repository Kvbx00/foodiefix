<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>DANE UŻYTKOWNIKÓW</h1>
<form action="{{ route('administrator.userProfile') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th>
            <a href="{{ route('administrator.userProfile', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th>
            <a href="{{ route('administrator.userProfile', ['sort' => 'name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Imię
            </a></th>
        <th>
            <a href="{{ route('administrator.userProfile', ['sort' => 'lastName', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Nazwisko
            </a></th>
        <th>
            <a href="{{ route('administrator.userProfile', ['sort' => 'email', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Email
            </a></th>
        <th>
            <a href="{{ route('administrator.userProfile', ['sort' => 'gender', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Płeć
            </a></th>
        <th>
            <a href="{{ route('administrator.userProfile', ['sort' => 'height', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Wzrost
            </a></th>
        <th>
            <a href="{{ route('administrator.userProfile', ['sort' => 'weight', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Waga
            </a></th>
        <th>
            <a href="{{ route('administrator.userProfile', ['sort' => 'age', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Wiek
            </a></th>
        <th>
            <a href="{{ route('administrator.userProfile', ['sort' => 'physicalActivity', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Aktywność fizyczna
            </a></th>
        <th>
            <a href="{{ route('administrator.userProfile', ['sort' => 'goal', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Cel
            </a></th>
        <th>
            <a href="{{ route('administrator.userProfile', ['sort' => 'created_at', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Data utworzenia
            </a></th>
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
<div class="pagination">
    @if ($user->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $user->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $user->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}" rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $user->currentPage() }} z {{ $user->lastPage() }}</span>

    @if ($user->hasMorePages())
        <a href="{{ $user->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}" rel="next">&rsaquo;</a>
        <a href="{{ $user->url($user->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
