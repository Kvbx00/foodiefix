<!doctype html>
<html lang="pl">

@include('includes.head')

<body>

@include('includes.admin-header')

<div class="container-fluid">
    @include('includes.error')

    <div class="row">

        @include('includes.admin-sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dodaj preferencję użytkownikowi</h1>
            </div>

            <form action="{{ route('administrator.saveUserIngredientPreference') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="user_id" class="col-form-label">Użytkownik</label>
                        <select name="user_id" id="user_id" class="form-control">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">id: {{ $user->id }}
                                    | {{ $user->name }} {{ $user->lastName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="ingredient_name" class="col-form-label">Składnik</label>
                        <select name="ingredient_name" id="ingredient_name" class="form-control">
                            @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->name }}">{{ $ingredient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary my-3">Dodaj preferencję</button>
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
        $('#user_id').select2();
        $('#ingredient_name').select2();
    });
</script>
<style>
    .input {
        width: 400px;
    }

    .select2-selection {
        border: none !important;
    }

    .select2 {
        width: 100% !important;
        padding: 0.375rem 2.25rem 0.375rem 0 !important;
        -moz-padding-start: calc(0.75rem - 3px) !important;
        font-size: 1rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        color: #212529 !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 0.25rem !important;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
    }

    .select2-dropdown {
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
        padding: 0.375rem 0 0.375rem 0.75rem;
    }

    .select2-results__option {
        font-weight: normal !important;
        display: block !important;
        min-height: 1.2em !important;
        padding: 0 2px 1px !important;
    }

    .select2-search {
        background-color: #fff !important;
        -webkit-box-shadow: none !important;
        -moz-box-shadow: none !important;
        box-shadow: none !important;
        border: none !important;
        padding-right: 0.75rem;
    }

    .select2-search__field {
        outline: none !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
    }

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #0d6efd !important;
        color: white !important;
    }

    .select2-selection__arrow b {
        display: none !important;
    }
</style>
