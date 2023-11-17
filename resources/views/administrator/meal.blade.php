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
                <h1 class="h2">Dania</h1>
                <a class="add" href="{{ route('administrator.addMeal') }}"><i class="bi bi-plus-square me-2"></i>Dodaj</a>
                <form action="{{ route('administrator.meal') }}" method="GET">
                    <input class="search text-center" type="text" name="search" placeholder="Szukaj"
                           value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a href="{{ route('administrator.meal', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.meal', ['sort' => 'name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Nazwa dania
                            </a></th>
                        <th scope="col">Przepis</th>
                        <th scope="col">
                            <a href="{{ route('administrator.meal', ['sort' => 'meal_category_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Kategoria
                            </a></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($meal as $meals)
                        <tr>
                            <td>{{ $meals->id }}</td>
                            <td>{{ $meals->name }}</td>
                            <td>{{ $meals->recipe }}</td>
                            <td>{{ $meals->meal_category_name }}</td>
                            <td colspan="2">
                                <div style="float:right;">
                                    <a href="{{ route('administrator.editMeal', $meals->id) }}"
                                       class="edit"><i class="bi bi-pencil-square mx-1"></i></a>
                                </div>
                                <div style="float:right;">
                                    <form action="{{ route('administrator.removeMeal', $meals->id) }}"
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
                <div class="pagination d-flex justify-content-center my-3">
                    @if ($meal->onFirstPage())
                        <span class="disabled">&laquo;</span>
                        <span class="disabled">&lsaquo;</span>
                    @else
                        <a href="{{ $meal->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
                        <a href="{{ $meal->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="prev">&lsaquo;</a>
                    @endif

                    <span
                        class="pagination-middle d-flex align-items-center">{{ $meal->currentPage() }} z {{ $meal->lastPage() }}</span>

                    @if ($meal->hasMorePages())
                        <a href="{{ $meal->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="next">&rsaquo;</a>
                        <a href="{{ $meal->url($meal->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
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

    .add {
        font-weight: 500;
        text-decoration: none;
        color: #000000;
    }

    .edit {
        text-decoration: none;
        color: #069;
    }
</style>
