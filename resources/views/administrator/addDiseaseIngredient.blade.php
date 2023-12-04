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
                <h1 class="h2">Dodaj niechciany składnik</h1>
            </div>

            <form action="{{ route('administrator.saveDiseaseIngredient') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="disease_name" class="col-form-label">Choroba</label>
                        <select name="disease_name" id="disease_name" class="form-control">
                            @foreach($diseases as $disease)
                                <option value="{{ $disease->name }}">id: {{ $disease->id }} | {{ $disease->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="ingredient_name" class="col-form-label">Składnik</label>
                        <select name="ingredient_name" id="ingredient_name" class="form-control">
                            @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->name }}">id: {{ $ingredient->id }} | {{ $ingredient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary my-3">Dodaj składnik</button>
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
        $('#disease_name').select2();
    });
</script>
