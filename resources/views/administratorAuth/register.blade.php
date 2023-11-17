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
                <h1 class="h2">Rejestracja pracownika</h1>
            </div>

            <form method="POST" action="{{ route('admin.register') }}">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="password" class="col-form-label">Hasło</label>
                        <input type="password" id="password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="password_confirmation" class="col-form-label">Powtórz hasło</label>
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="role" class="col-form-label">Rola</label>
                        <select name="role" id="role" class="form-control">
                            <option value="admin">Administrator</option>
                            <option value="dietician">Dietetyk</option>
                        </select>
                    </div>
                </div>
                    <button type="submit" class="btn btn-secondary mt-3">Zarejestruj</button>
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
