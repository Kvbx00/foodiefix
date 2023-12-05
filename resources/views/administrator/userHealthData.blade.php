<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/administrator/admin.css') }}">
<body>

@include('includes.admin-header')

<div class="container-fluid">
    <div class="row">
        @include('includes.success')
        @include('includes.admin-sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dane zdrowotne użytkowników</h1>
                <form action="{{ route('administrator.userHealthData') }}" method="GET">
                    <input class="search text-center" type="text" name="search" placeholder="Szukaj"
                           value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a href="{{ route('administrator.userHealthData', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userHealthData', ['sort' => 'weight', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Waga
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userHealthData', ['sort' => 'systolicBloodPressure', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Skurczowe ciśnienie krwi
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userHealthData', ['sort' => 'diastolicBloodPressure', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Rozkurczowe ciśnienie krwi
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userHealthData', ['sort' => 'pulse', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Puls
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userHealthData', ['sort' => 'date', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Data
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userHealthData', ['sort' => 'user_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id użytkownika
                            </a></th>
                        <th scope="col"></th>
                        <th scope="col">
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($healthData as $userHealthData)
                        <tr>
                            <td>{{ $userHealthData->id }}</td>
                            <td>{{ $userHealthData->weight }}</td>
                            <td>{{ $userHealthData->systolicBloodPressure }}</td>
                            <td>{{ $userHealthData->diastolicBloodPressure }}</td>
                            <td>{{ $userHealthData->pulse }}</td>
                            <td>{{ $userHealthData->date }}</td>
                            <td>{{ $userHealthData->user_id }}</td>
                            <td colspan="2">
                                <div style="float:right;">
                                    <a href="{{ route('administrator.editUserHealthData', $userHealthData->id) }}"
                                       class="edit"><i class="bi bi-pencil-square mx-1"></i></a>
                                </div>
                                <div style="float:right;">
                                    <form
                                        action="{{ route('administrator.removeUserHealthData', $userHealthData->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete" type="submit"><i class="bi bi-trash mx-1"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination d-flex justify-content-center mt-3">
                    @if ($healthData->onFirstPage())
                        <span class="disabled">&laquo;</span>
                        <span class="disabled">&lsaquo;</span>
                    @else
                        <a href="{{ $healthData->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
                        <a href="{{ $healthData->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="prev">&lsaquo;</a>
                    @endif

                    <span
                        class="pagination-middle d-flex align-items-center">{{ $healthData->currentPage() }} z {{ $healthData->lastPage() }}</span>

                    @if ($healthData->hasMorePages())
                        <a href="{{ $healthData->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="next">&rsaquo;</a>
                        <a href="{{ $healthData->url($healthData->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
                    @else
                        <span class="disabled">&rsaquo;</span>
                        <span class="disabled">&raquo;</span>
                    @endif
                </div>
            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
