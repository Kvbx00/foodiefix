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
                <h1 class="h2">Zapotrzebowanie kaloryczne użytkowników</h1>
                <form action="{{ route('administrator.userCaloricNeed') }}" method="GET">
                    <input class="search text-center" type="text" name="search" placeholder="Szukaj"
                           value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a href="{{ route('administrator.userCaloricNeed', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userCaloricNeed', ['sort' => 'caloricNeeds', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Ilość kcal
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userCaloricNeed', ['sort' => 'date', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Data
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userCaloricNeed', ['sort' => 'user_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id użytkownika
                            </a></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($caloricNeed as $caloricNeeds)
                        <tr>
                            <td>{{ $caloricNeeds->id }}</td>
                            <td>{{ $caloricNeeds->caloricNeeds }}</td>
                            <td>{{ $caloricNeeds->date }}</td>
                            <td>{{ $caloricNeeds->user_id }}</td>
                            <td colspan="2">
                                <div style="float:right;">
                                    <a href="{{ route('administrator.editUserCaloricNeed', $caloricNeeds->id) }}"
                                       class="edit"><i class="bi bi-pencil-square mx-1"></i></a>
                                </div>
                                <div style="float:right;">
                                    <form action="{{ route('administrator.removeUserCaloricNeed', $caloricNeeds->id) }}"
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
                    @if ($caloricNeed->onFirstPage())
                        <span class="disabled">&laquo;</span>
                        <span class="disabled">&lsaquo;</span>
                    @else
                        <a href="{{ $caloricNeed->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
                        <a href="{{ $caloricNeed->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="prev">&lsaquo;</a>
                    @endif

                    <span
                        class="pagination-middle d-flex align-items-center">{{ $caloricNeed->currentPage() }} z {{ $caloricNeed->lastPage() }}</span>

                    @if ($caloricNeed->hasMorePages())
                        <a href="{{ $caloricNeed->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="next">&rsaquo;</a>
                        <a href="{{ $caloricNeed->url($caloricNeed->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
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

    .search {
        border: 1px solid grey;
        border-left: 5px solid grey;
        width: 150px;
    }

    .search:focus {
        outline: none;
    }

    .edit {
        text-decoration: none;
        color: #069;
    }
</style>
