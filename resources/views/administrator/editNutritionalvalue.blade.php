<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<body>

@include('includes.admin-header')

<div class="container-fluid">
    @include('includes.error')

    <div class="row">

        @include('includes.admin-sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edycja wartości odżywczych</h1>
            </div>
            <form method="POST" action="{{ route('administrator.updateNutritionalvalue', $nutritionalvalue->id) }}">
                @csrf
                @method('PUT')
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="meal_id" class="col-form-label">Id dania</label>
                        <input type="text" class="form-control" id="meal_id" name="meal_id"
                               value="{{$nutritionalvalue->meal_id}}"
                               disabled>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="meal_name" class="col-form-label">Danie</label>
                        <input type="text" class="form-control" id="meal_name" name="meal_name"
                               value="{{$nutritionalvalue->meal_name}}"
                               disabled>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="calories" class="col-form-label">Kalorie</label>
                        <input type="text" class="form-control" id="calories" name="calories"
                               value="{{$nutritionalvalue->calories}}" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="protein" class="col-form-label">Białko</label>
                        <input type="text" class="form-control" id="protein" name="protein"
                               value="{{$nutritionalvalue->protein}}" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="fats" class="col-form-label">Tłuszcze</label>
                        <input type="text" class="form-control" id="fats" name="fats"
                               value="{{$nutritionalvalue->fats}}" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="carbohydrates" class="col-form-label">Węglowodany</label>
                        <input type="text" class="form-control" id="carbohydrates" name="carbohydrates"
                               value="{{$nutritionalvalue->carbohydrates}}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary my-3">Zapisz zmiany</button>
            </form>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
