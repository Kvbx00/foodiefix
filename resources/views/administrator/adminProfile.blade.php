<!doctype html>
<html lang="pl">

@include('includes.head')

<body>

@include('includes.admin-header')

<div class="container-fluid">
    <div class="row">
        @include('includes.success')
        @include('includes.admin-sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Pracownicy</h1>
                <form action="{{ route('administrator.adminProfile') }}" method="GET">
                    <input class="search text-center" type="text" name="search" placeholder="Szukaj"
                           value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col"><a
                                href="{{ route('administrator.adminProfile', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id
                            </a></th>
                        <th scope="col"><a
                                href="{{ route('administrator.adminProfile', ['sort' => 'email', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Email
                            </a></th>
                        <th scope="col"><a
                                href="{{ route('administrator.adminProfile', ['sort' => 'role', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Rola
                            </a></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($administrator as $administrators)
                        <tr>
                            <td>{{ $administrators->id }}</td>
                            <td>{{ $administrators->email }}</td>
                            <td>{{ $administrators->role }}</td>
                            <td colspan="2">
                                <div style="float:right;">
                                    <a href="{{ route('administrator.editAdminProfile', $administrators->id) }}"
                                       class="edit"><i class="bi bi-pencil-square mx-1"></i></a>
                                </div>
                                <div style="float:right;">
                                    <form action="{{ route('administrator.removeAdminProfile', $administrators->id) }}"
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
                    @if ($administrator->onFirstPage())
                        <span>&laquo;</span>
                        <span>&lsaquo;</span>
                    @else
                        <a href="{{ $administrator->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
                        <a href="{{ $administrator->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="prev">&lsaquo;</a>
                    @endif

                    <span
                        class="pagination-middle d-flex align-items-center">{{ $administrator->currentPage() }} z {{ $administrator->lastPage() }}</span>

                    @if ($administrator->hasMorePages())
                        <a href="{{ $administrator->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="next">&rsaquo;</a>
                        <a href="{{ $administrator->url($administrator->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
                    @else
                        <span>&rsaquo;</span>
                        <span>&raquo;</span>
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

<style>
    .pagination a, .pagination span {
        height: 25px;
        width: 25px;
        text-align: center;
        justify-content: center;
        display: flex;
        margin-left: 7px;
        text-decoration: none;
        color: #000000;
    }

    .pagination .pagination-middle {
        border-radius: 20px;
        height: 25px;
        width: 105px;
        background-color: #F2F2F2;
        font-weight: 500;
        text-align: center;
        margin-left: 7px;
        color: #7F7F7F;
    }

    .delete {
        background: none !important;
        border: none;
        padding: 0 !important;
        color: #069;
        cursor: pointer;
    }

    .edit {
        text-decoration: none;
        color: #069;
    }

    .search {
        border: 1px solid grey;
        border-left: 5px solid grey;
        width: 150px;
    }

    .search:focus {
        outline: none;
    }
</style>
