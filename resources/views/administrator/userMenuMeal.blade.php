<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<body>

@include('includes.admin-header')

<div class="container-fluid">
    <div class="row">
        @include('includes.success')
        @include('includes.admin-sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dania w menu</h1>
                <a class="add" href="{{ route('administrator.addUserMenuMeal') }}"><i class="bi bi-plus-square me-2"></i>Dodaj</a>
                <form action="{{ route('administrator.userMenuMeal') }}" method="GET">
                    <input class="search text-center" type="text" name="search" placeholder="Szukaj"
                           value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a href="{{ route('administrator.userMenuMeal', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userMenuMeal', ['sort' => 'menu_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id menu
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.userMenuMeal', ['sort' => 'meal_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id dania
                            </a></th>
                        <th scope="col">Nazwa dania</th>
                        <th scope="col">
                            <a href="{{ route('administrator.userMenuMeal', ['sort' => 'meal_meal_category_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id Kategorii
                            </a></th>
                        <th scope="col">Nazwa kategorii</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menuMeal as $menuMeals)
                        <tr>
                            <td>{{ $menuMeals->id }}</td>
                            <td>{{ $menuMeals->menu_id }}</td>
                            <td>{{ $menuMeals->meal_id }}</td>
                            <td>{{ $menuMeals->meal_name }}</td>
                            <td>{{ $menuMeals->meal_meal_category_id }}</td>
                            <td>{{ $menuMeals->mealCategory_name }}</td>
                            <td colspan="2">
                                <div style="float:right;">
                                    <a href="{{ route('administrator.editUserMenuMeal', $menuMeals->id) }}"
                                       class="edit"><i class="bi bi-pencil-square mx-1"></i></a>
                                </div>
                                <div style="float:right;">
                                    <form action="{{ route('administrator.removeUserMenuMeal', $menuMeals->id) }}"
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
                    @if ($menuMeal->onFirstPage())
                        <span class="disabled">&laquo;</span>
                        <span class="disabled">&lsaquo;</span>
                    @else
                        <a href="{{ $menuMeal->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
                        <a href="{{ $menuMeal->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="prev">&lsaquo;</a>
                    @endif

                    <span
                        class="pagination-middle d-flex align-items-center">{{ $menuMeal->currentPage() }} z {{ $menuMeal->lastPage() }}</span>

                    @if ($menuMeal->hasMorePages())
                        <a href="{{ $menuMeal->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="next">&rsaquo;</a>
                        <a href="{{ $menuMeal->url($menuMeal->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
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
