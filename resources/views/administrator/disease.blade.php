<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>CHOROBY</h1>
<a href="{{ route('administrator.addDisease') }}">Dodaj chorobę</a>
<form action="{{ route('administrator.disease') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th>
            <a href="{{ route('administrator.disease', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th>
            <a href="{{ route('administrator.disease', ['sort' => 'name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Nazwa choroby
            </a></th>
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
<div class="pagination">
    @if ($disease->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $disease->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $disease->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $disease->currentPage() }} z {{ $disease->lastPage() }}</span>

    @if ($disease->hasMorePages())
        <a href="{{ $disease->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="next">&rsaquo;</a>
        <a href="{{ $disease->url($disease->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
