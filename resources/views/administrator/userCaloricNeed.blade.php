<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>ZAPOTRZEBOWANIE KALORYCZNE UŻYTKOWNIKÓW</h1>
<form action="{{ route('administrator.userCaloricNeed') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th>
            <a href="{{ route('administrator.userCaloricNeed', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th>
            <a href="{{ route('administrator.userCaloricNeed', ['sort' => 'caloricNeeds', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Zapotrzebowanie
            </a></th>
        <th>
            <a href="{{ route('administrator.userCaloricNeed', ['sort' => 'date', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Data
            </a></th>
        <th>
            <a href="{{ route('administrator.userCaloricNeed', ['sort' => 'user_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id użytkownika
            </a></th>
        <th>Akcja</th>
    </tr>
    </thead>
    <tbody>
    @foreach($caloricNeed as $caloricNeeds)
        <tr>
            <td>{{ $caloricNeeds->id }}</td>
            <td>{{ $caloricNeeds->caloricNeeds }}</td>
            <td>{{ $caloricNeeds->date }}</td>
            <td>{{ $caloricNeeds->user_id }}</td>
            <td>
                <a href="{{ route('administrator.editUserCaloricNeed', $caloricNeeds->id) }}">Edytuj</a>
                <form action="{{ route('administrator.removeUserCaloricNeed', $caloricNeeds->id) }}" method="POST">
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
    @if ($caloricNeed->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $caloricNeed->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $caloricNeed->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $caloricNeed->currentPage() }} z {{ $caloricNeed->lastPage() }}</span>

    @if ($caloricNeed->hasMorePages())
        <a href="{{ $caloricNeed->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
           rel="next">&rsaquo;</a>
        <a href="{{ $caloricNeed->url($caloricNeed->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>

</body>

</html>
