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
                <h1 class="h2">Dodawanie dań do menu</h1>
            </div>

            <form action="{{ route('administrator.saveUserMenuMeal') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="menu_id" class="col-form-label">Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                            @foreach($menu as $menus)
                                <option value="{{ $menus->id }}">id: {{ $menus->id }} | {{ $menus->dayOfTheWeek }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="meal_name" class="col-form-label">Danie</label>
                        <select name="meal_name" id="meal_name" class="form-control">
                            @foreach($meal as $meals)
                                <option value="{{ $meals->name }}">id: {{$meals->id}} | {{ $meals->name }}
                                    | {{ $meals->meal_category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary my-3">Dodaj danie</button>
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
        $('#menu_id').select2();
        $('#meal_name').select2();
    });
</script>
