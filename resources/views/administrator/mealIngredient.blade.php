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
                <h1 class="h2">Składniki w daniach</h1>
                <a class="add" href="{{ route('administrator.addMealIngredient') }}"><i class="bi bi-plus-square me-2"></i>Dodaj</a>
                <form action="{{ route('administrator.mealIngredient') }}" method="GET">
                    <input class="search text-center" type="text" name="search" placeholder="Szukaj"
                           value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a href="{{ route('administrator.mealIngredient', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.mealIngredient', ['sort' => 'meal_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id dania
                            </a></th>
                        <th scope="col">Nazwa dania</th>
                        <th scope="col">
                            <a href="{{ route('administrator.mealIngredient', ['sort' => 'ingredient_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id składnika
                            </a></th>
                        <th scope="col">Nazwa składnika</th>
                        <th scope="col">
                            <a href="{{ route('administrator.mealIngredient', ['sort' => 'quantity', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Ilość
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.mealIngredient', ['sort' => 'unit', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Jednostka
                            </a></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mealIngredient as $mealIngredients)
                        <tr>
                            <td>{{ $mealIngredients->id }}</td>
                            <td>{{ $mealIngredients->meal_id }}</td>
                            <td>{{ $mealIngredients->meal_name }}</td>
                            <td>{{ $mealIngredients->ingredient_id }}</td>
                            <td>{{ $mealIngredients->ingredient_name }}</td>
                            <td>{{ $mealIngredients->quantity}}</td>
                            <td>{{ $mealIngredients->unit }}</td>
                            <td colspan="2">
                                <div style="float:right;">
                                    <a href="{{ route('administrator.editMealIngredient', $mealIngredients->id) }}"
                                       class="edit"><i class="bi bi-pencil-square mx-1"></i></a>
                                </div>
                                <div style="float:right;">
                                    <form action="{{ route('administrator.removeMealIngredient', $mealIngredients->id) }}"
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
                    @if ($mealIngredient->onFirstPage())
                        <span class="disabled">&laquo;</span>
                        <span class="disabled">&lsaquo;</span>
                    @else
                        <a href="{{ $mealIngredient->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
                        <a href="{{ $mealIngredient->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="prev">&lsaquo;</a>
                    @endif

                    <span
                        class="pagination-middle d-flex align-items-center">{{ $mealIngredient->currentPage() }} z {{ $mealIngredient->lastPage() }}</span>

                    @if ($mealIngredient->hasMorePages())
                        <a href="{{ $mealIngredient->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="next">&rsaquo;</a>
                        <a href="{{ $mealIngredient->url($mealIngredient->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
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
