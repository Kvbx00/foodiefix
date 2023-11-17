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
                <h1 class="h2">Dodawanie kategorii</h1>
            </div>

            <form action="{{ route('administrator.saveIngredientCategory') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="name" class="col-form-label">Nazwa kategorii</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary my-3">Dodaj kategorię</button>
            </form>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
<style>
    .input {
        width: 400px;
    }
</style>
