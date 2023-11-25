<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/administrator/admin.css') }}">
<body>

@include('includes.admin-header')

<div class="container-fluid">
    <div class="row">
        @include('includes.success')
        @include('includes.error')
        @include('includes.admin-sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Użytkownicy</h1>
                <form action="{{ route('administrator.userProfile') }}" method="GET">
                    <input class="search text-center" type="text" name="search" placeholder="Szukaj"
                           value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a href="{{ route('administrator.userProfile', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userProfile', ['sort' => 'name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Imię
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userProfile', ['sort' => 'lastName', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Nazwisko
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userProfile', ['sort' => 'email', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Email
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userProfile', ['sort' => 'gender', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Płeć
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userProfile', ['sort' => 'height', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Wzrost
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userProfile', ['sort' => 'weight', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Waga
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userProfile', ['sort' => 'age', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Wiek
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userProfile', ['sort' => 'physicalActivity', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Aktywność fizyczna
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userProfile', ['sort' => 'goal', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Cel
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userProfile', ['sort' => 'created_at', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Data utworzenia
                            </a></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
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
                            <td colspan="2">
                                <div style="float:right;">
                                    <a href="{{ route('administrator.editUserProfile', $users->id) }}"
                                       class="edit"><i class="bi bi-pencil-square mx-1"></i></a>
                                </div>
                                <div style="float:right;">
                                    <form action="{{ route('administrator.removeUserProfile', $users->id) }}"
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
                    @if ($user->onFirstPage())
                        <span class="disabled">&laquo;</span>
                        <span class="disabled">&lsaquo;</span>
                    @else
                        <a href="{{ $user->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
                        <a href="{{ $user->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="prev">&lsaquo;</a>
                    @endif

                    <span
                        class="pagination-middle d-flex align-items-center">{{ $user->currentPage() }} z {{ $user->lastPage() }}</span>

                    @if ($user->hasMorePages())
                        <a href="{{ $user->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="next">&rsaquo;</a>
                        <a href="{{ $user->url($user->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
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
