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
                <h1 class="h2">Niechciane składniki</h1>
                <a class="add" href="{{ route('administrator.addDiseaseIngredient') }}"><i
                        class="bi bi-plus-square me-2"></i>Dodaj</a>
                <form action="{{ route('administrator.diseaseIngredient') }}" method="GET">
                    <input class="search text-center" type="text" name="search" placeholder="Szukaj"
                           value="{{ request('search') }}">
                </form>
            </div>

            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a href="{{ route('administrator.diseaseIngredient', ['sort' => 'id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id
                            </a></th>
                        <th scope="col">Nazwa choroby</th>
                        <th scope="col">
                            <a href="{{ route('administrator.diseaseIngredient', ['sort' => 'diseases_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id choroby
                            </a></th>
                        <th scope="col">Nazwa składnika</th>
                        <th scope="col">
                            <a href="{{ route('administrator.diseaseIngredient', ['sort' => 'ingredient_id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                Id składnika
                            </a></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($diseaseIngredient as $diseaseIngredients)
                        <tr>
                            <td>{{ $diseaseIngredients->id }}</td>
                            <td>{{ $diseaseIngredients->disease_name }}</td>
                            <td>{{ $diseaseIngredients->diseases_id }}</td>
                            <td>{{ $diseaseIngredients->ingredient_name }}</td>
                            <td>{{ $diseaseIngredients->ingredient_id }}</td>
                            <td colspan="2">
                                <div style="float:right;">
                                    <a href="{{ route('administrator.editDiseaseIngredient', $diseaseIngredients->id) }}"
                                       class="edit"><i class="bi bi-pencil-square mx-1"></i></a>
                                </div>
                                <div style="float:right;">
                                    <form action="{{ route('administrator.removeDiseaseIngredient', $diseaseIngredients->id) }}"
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
                    @if ($diseaseIngredient->onFirstPage())
                        <span class="disabled">&laquo;</span>
                        <span class="disabled">&lsaquo;</span>
                    @else
                        <a href="{{ $diseaseIngredient->url(1) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&laquo;</a>
                        <a href="{{ $diseaseIngredient->previousPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="prev">&lsaquo;</a>
                    @endif

                    <span
                        class="pagination-middle d-flex align-items-center">{{ $diseaseIngredient->currentPage() }} z {{ $diseaseIngredient->lastPage() }}</span>

                    @if ($diseaseIngredient->hasMorePages())
                        <a href="{{ $diseaseIngredient->nextPageUrl() }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}"
                           rel="next">&rsaquo;</a>
                        <a href="{{ $diseaseIngredient->url($diseaseIngredient->lastPage()) }}&sort={{ $sort }}&order={{ $order }}&search={{ $search }}">&raquo;</a>
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
