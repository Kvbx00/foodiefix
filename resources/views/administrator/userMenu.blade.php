<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>MENU UŻYTKOWNIKÓW</h1>
<a href="{{ route('administrator.addUserMenu') }}">Dodaj menu</a>
<form action="{{ route('administrator.userMenu') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th><a href="{{ route('administrator.userMenu', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th><a href="{{ route('administrator.userMenu', ['sort' => 'date', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Data
            </a></th>
        <th>Dzień tygodnia</th>
        <th><a href="{{ route('administrator.userMenu', ['sort' => 'user_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id użytkownika
            </a></th>
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
            <td>{{ \Carbon\Carbon::parse($menus->date)->format('Y-m-d') }}</td>
            <td>{{ $menus->dayOfTheWeek }}</td>
            <td>{{ $menus->user_id }}</td>
            <td>{{ $menus->user_name }}</td>
            <td>{{ $menus->user_lastName }}</td>
            <td>{{ $menus->user_email }}</td>
            <td>
                <a href="{{ route('administrator.editUserMenu', $menus->id) }}">Edytuj</a>
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
<div class="pagination">
    @if ($menu->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $menu->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $menu->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $menu->currentPage() }} z {{ $menu->lastPage() }}</span>

    @if ($menu->hasMorePages())
        <a href="{{ $menu->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="next">&rsaquo;</a>
        <a href="{{ $menu->url($menu->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
