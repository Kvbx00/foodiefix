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
                <h1 class="h2">Wartości odżywcze dań</h1>
                <a class="add" href="{{ route('administrator.addNutritionalvalue') }}"><i class="bi bi-plus-square me-2"></i>Dodaj</a>
                <form action="{{ route('administrator.nutritionalvalue') }}" method="GET">
                    <input class="search text-center" type="text" name="search" placeholder="Szukaj"
                           value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a href="{{ route('administrator.nutritionalvalue', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.nutritionalvalue', ['sort' => 'calories', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Kalorie
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.nutritionalvalue', ['sort' => 'protein', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Białko
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.nutritionalvalue', ['sort' => 'fats', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Tłuszcze
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.nutritionalvalue', ['sort' => 'carbohydrates', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Węglowodany
                            </a></th>
                        <th scope="col">
                            <a href="{{ route('administrator.nutritionalvalue', ['sort' => 'meal_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id dania
                            </a></th>
                        <th scope="col">Nazwa dania</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($nutritionalvalue as $nutritionalvalues)
                        <tr>
                            <td>{{ $nutritionalvalues->id }}</td>
                            <td>{{ $nutritionalvalues->calories }}</td>
                            <td>{{ $nutritionalvalues->protein }}</td>
                            <td>{{ $nutritionalvalues->fats }}</td>
                            <td>{{ $nutritionalvalues->carbohydrates }}</td>
                            <td>{{ $nutritionalvalues->meal_id }}</td>
                            <td>{{ $nutritionalvalues->meal_name }}
                            <td colspan="2">
                                <div style="float:right;">
                                    <a href="{{ route('administrator.editNutritionalvalue', $nutritionalvalues->id) }}"
                                       class="edit"><i class="bi bi-pencil-square mx-1"></i></a>
                                </div>
                                <div style="float:right;">
                                    <form action="{{ route('administrator.removeNutritionalvalue', $nutritionalvalues->id) }}"
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
                    @if ($nutritionalvalue->onFirstPage())
                        <span class="disabled">&laquo;</span>
                        <span class="disabled">&lsaquo;</span>
                    @else
                        <a href="{{ $nutritionalvalue->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
                        <a href="{{ $nutritionalvalue->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="prev">&lsaquo;</a>
                    @endif

                    <span
                        class="pagination-middle d-flex align-items-center">{{ $nutritionalvalue->currentPage() }} z {{ $nutritionalvalue->lastPage() }}</span>

                    @if ($nutritionalvalue->hasMorePages())
                        <a href="{{ $nutritionalvalue->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="next">&rsaquo;</a>
                        <a href="{{ $nutritionalvalue->url($nutritionalvalue->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
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
