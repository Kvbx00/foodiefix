<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/administrator/admin.css') }}">
<body>

@include('includes.admin-header')

<div class="container-fluid">
    @include('includes.error')

    <div class="row">

        @include('includes.admin-sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edycja składnika w daniu</h1>
            </div>

            <form method="POST" action="{{ route('administrator.updateMealIngredient', $mealIngredient->id) }}">
                @csrf
                @method('PUT')
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="meal_id" class="col-form-label">Id dania</label>
                        <input type="text" class="form-control" id="meal_id" name="meal_id" value="{{$mealIngredient->meal_id}}" disabled>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="meal_name" class="col-form-label">Nazwa dania</label>
                        <input type="text" class="form-control" id="meal_name" name="meal_name" value="{{$mealIngredient->meal->name}}" disabled>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="ingredient_name" class="col-form-label">Składnik</label>
                        <select name="ingredient_name" id="ingredient_name" class="form-control">
                            @foreach($ingredient as $ingredients)
                                <option value="{{ $ingredients->name }}"
                                        @if($ingredients->id == $mealIngredient->ingredient_id) selected @endif>{{ $ingredients->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="quantity" class="col-form-label">Ilość</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" value="{{$mealIngredient->quantity}}" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="unit" class="col-form-label">Jednostka</label>
                        <select name="unit" id="unit" class="form-control">
                            <option value="g" @if($mealIngredient->unit == 'g') selected @endif>g</option>
                            <option value="szt." @if($mealIngredient->unit == 'szt.') selected @endif>szt.</option>
                            <option value="ml" @if($mealIngredient->unit == 'ml') selected @endif>ml</option>
                        </select>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#ingredient_name').select2();
    });
</script>
