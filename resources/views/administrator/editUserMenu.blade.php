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
                <h1 class="h2">Edycja menu użytkownika</h1>
            </div>

            <form method="POST" action="{{ route('administrator.updateUserMenu', $menu->id) }}">
                @csrf
                @method('PUT')
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="user_id" class="col-form-label">Id użytkownika</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $menu->user_id }}" disabled>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="date" class="col-form-label">Data</label>
                        <input type="date" class="form-control" id="date" name="date"
                               value="{{ \Carbon\Carbon::parse($menu->date)->format('Y-m-d') }}">
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
