<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/user/notes.css') }}">

<body>
@include('includes.header')

<div class="container">
    <div class="d-flex justify-content-center mt-5">
        <p class="fw-normal text-center" style="font-size:40px; letter-spacing: 1px">Notatki</p>
    </div>

    <div class="d-flex mb-5 mt-4">
        <div class="d-flex flex-row align-items-center return">
            <i class="bi bi-caret-left"></i>
            <form action="{{ url()->previous() }}">
                @csrf
                <button type="submit">Powrót</button>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-8 mb-4">
            <form method="POST" action="{{ route('note.update', $note->id) }}">
                @csrf
                @method('PUT')
                <div class="form-outline mb-3">
                    <input type="text" class="form-control" id="title" placeholder="Tytuł" name="title" value="{{ $note->title }}">
                </div>

                <div class="form-outline mb-3">
                    <textarea class="form-control" id="floatingText" placeholder="Treść" name="text"
                              rows="12">{{ $note->text }}</textarea>
                </div>

                <button class="btn btn-dark btn-block" type="submit"
                        style="background-color: #6FAD55; border: none">Zapisz
                </button>
            </form>
        </div>
    </div>
</div>


@include('includes.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
