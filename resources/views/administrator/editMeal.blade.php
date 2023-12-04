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
                <h1 class="h2">Edycja danie</h1>
            </div>

            <form method="POST" action="{{ route('administrator.updateMeal', $meal->id) }}">
                @csrf
                @method('PUT')
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="name" class="col-form-label">Nazwa dania</label>
                        <input type="text" id="name" name="name" value="{{$meal->name}}" required class="form-control">
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="recipe" class="col-form-label">Przepis</label>
                        <textarea id="recipe" name="recipe" required
                                  class="form-control" rows="12">{{$meal->recipe}}
                        </textarea>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="meal_category_name" class="col-form-label">Kategoria</label>
                        <select id="meal_category_name" name="meal_category_name" class="form-control">
                            @foreach($mealCategory as $mealCategories)
                                <option value="{{ $mealCategories->name }}"
                                        @if($mealCategories->id == $meal->meal_category_id) selected @endif>{{ $mealCategories->name }}</option>
                            @endforeach
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
