<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>DANE ZDROWOTNE UŻYTKOWNIKÓW</h1>
<form action="{{ route('administrator.userHealthData') }}" method="GET">
    <input type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
    <button type="submit">Szukaj</button>
</form>
<table>
    <thead>
    <tr>
        <th><a href="{{ route('administrator.userHealthData', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id
            </a></th>
        <th><a href="{{ route('administrator.userHealthData', ['sort' => 'weight', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Waga
            </a></th>
        <th><a href="{{ route('administrator.userHealthData', ['sort' => 'diastolicBloodPressure', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Rozkurczowe ciśnienie krwi
            </a></th>
        <th><a href="{{ route('administrator.userHealthData', ['sort' => 'systolicBloodPressure', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Skurczowe ciśnienie krwi
            </a></th>
        <th><a href="{{ route('administrator.userHealthData', ['sort' => 'pulse', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Puls
            </a></th>
        <th><a href="{{ route('administrator.userHealthData', ['sort' => 'date', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Data
            </a></th>
        <th><a href="{{ route('administrator.userHealthData', ['sort' => 'user_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                Id użytkownika
            </a></th>
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
<div class="pagination">
    @if ($healthData->onFirstPage())
        <span class="disabled">&laquo;</span>
        <span class="disabled">&lsaquo;</span>
    @else
        <a href="{{ $healthData->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
        <a href="{{ $healthData->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}" rel="prev">&lsaquo;</a>
    @endif

    <span>Strona {{ $healthData->currentPage() }} z {{ $healthData->lastPage() }}</span>

    @if ($healthData->hasMorePages())
        <a href="{{ $healthData->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}" rel="next">&rsaquo;</a>
        <a href="{{ $healthData->url($healthData->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
    @else
        <span class="disabled">&rsaquo;</span>
        <span class="disabled">&raquo;</span>
    @endif
</div>
</body>

</html>
