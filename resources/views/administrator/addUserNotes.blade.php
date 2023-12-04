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
                <h1 class="h2">Dodawanie notatki</h1>
            </div>

            <form action="{{ route('administrator.saveUserNotes') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="title" class="col-form-label">Tytuł</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="text" class="col-form-label">Treść</label>
                        <textarea class="form-control" id="text" placeholder="Treść" name="text"
                                  rows="12"></textarea>
                    </div>
                </div>
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
                <button type="submit" class="btn btn-secondary my-3">Dodaj notatkę</button>
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
        $('#user_id').select2();
    });
</script>
