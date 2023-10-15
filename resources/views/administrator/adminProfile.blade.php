<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>PRACOWNICY</h1>
<form action="{{ route('administrator.adminProfile') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th><a href="{{ route('administrator.adminProfile', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th><a href="{{ route('administrator.adminProfile', ['sort' => 'email', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Email
            </a></th>
        <th><a href="{{ route('administrator.adminProfile', ['sort' => 'role', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Role
            </a></th>
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
<div class="pagination">
    @if ($administrator->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $administrator->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $administrator->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $administrator->currentPage() }} z {{ $administrator->lastPage() }}</span>

    @if ($administrator->hasMorePages())
        <a href="{{ $administrator->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="next">&rsaquo;</a>
        <a href="{{ $administrator->url($administrator->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
