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
                <h1 class="h2">Dodawanie wartości odżywczych</h1>
            </div>

            <form action="{{ route('administrator.saveNutritionalvalue') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="meal_name" class="col-form-label">Danie</label>
                        <select name="meal_name" id="meal_name" class="form-control">
                            @foreach($meal as $meals)
                                <option value="{{ $meals->name }}">id: {{ $meals->id }} | {{ $meals->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="calories" class="col-form-label">Kalorie</label>
                        <input type="text" class="form-control" id="calories" name="calories" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="protein" class="col-form-label">Białko</label>
                        <input type="text" class="form-control" id="protein" name="protein" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="fats" class="col-form-label">Tłuszcze</label>
                        <input type="text" class="form-control" id="fats" name="fats" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="carbohydrates" class="col-form-label">Węglowodany</label>
                        <input type="text" class="form-control" id="carbohydrates" name="carbohydrates" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary my-3">Dodaj wartości odżywcze</button>
            </form>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#meal_name').select2();
    });
</script>
