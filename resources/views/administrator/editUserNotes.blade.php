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
                <h1 class="h2">Edycja notatki</h1>
            </div>
            <form method="POST" action="{{ route('administrator.updateUserNotes', $notes->id) }}">
                @csrf
                @method('PUT')
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="id" class="col-form-label">Id</label>
                        <input type="text" class="form-control" id="id" name="id"
                               value="{{$notes->id}}"
                               disabled>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="title" class="col-form-label">Tytuł</label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="{{$notes->title}}">
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="text" class="col-form-label">Treść</label>
                        <textarea class="form-control" id="text" placeholder="Treść" name="text"
                                  rows="12">{{ $notes->text }}</textarea>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="user_id" class="col-form-label">Id użytkownika</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                               value="{{$notes->user_id}}"
                               disabled>
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
