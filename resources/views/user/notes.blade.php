<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/user/notes.css') }}">

<body>
@include('includes.header')
@include('includes.success')
@include('includes.error')

<div class="container">
    <div class="d-flex justify-content-center mt-5">
        <p class="fw-normal text-center" style="font-size:40px; letter-spacing: 1px">Notatki</p>
    </div>

    <div class="d-flex justify-content-center mb-5 mt-4">
        <div class="col-auto">
            <a href="{{ route('notes.add') }}"><i class="bi bi-file-earmark-plus-fill"></i></a>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-5 mt-4">
        <div class="col-auto">
            <form action="{{ route('notes.show') }}" method="GET">
                <input class="search text-center" type="text" name="search" placeholder="Szukaj"
                       value="{{ request('search') }}">
            </form>
        </div>
    </div>

    <div class="row">
        @forelse($notes as $note)
            <div class="col-md-6 mb-4">
                <div class="card d-flex flex-row align-items-center justify-content-between p-2">
                    <div class="fs-5">
                        {{ $note->title }}
                    </div>
                    <a href="{{ route('note.edit', $note->id) }}" class="stretched-link"></a>
                    <form action="{{ route('notes.delete', $note->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="delete-single" type="submit"><i class="bi bi-trash-fill"></i></button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-md-12 my-5">
                <p class="text-center fs-5">Nie masz żadnych notatek.</p>
            </div>
        @endforelse
    </div>
    <div class="pagination d-flex justify-content-center mt-5">
        @if ($notes->onFirstPage())
            <span class="disabled">&laquo;</span>
            <span class="disabled">&lsaquo;</span>
        @else
            <a href="{{ $notes->url(1) }}&search={{ $search }}">&laquo;</a>
            <a href="{{ $notes->previousPageUrl() }}&search={{ $search }}" rel="prev">&lsaquo;</a>
        @endif

        <span
            class="pagination-middle d-flex align-items-center">{{ $notes->currentPage() }} z {{ $notes->lastPage() }}</span>

        @if ($notes->hasMorePages())
            <a href="{{ $notes->nextPageUrl() }}&search={{ $search }}" rel="next">&rsaquo;</a>
            <a href="{{ $notes->url($notes->lastPage()) }}&search={{ $search }}">&raquo;</a>
        @else
            <span class="disabled">&rsaquo;</span>
            <span class="disabled">&raquo;</span>
        @endif
    </div>
</div>


@include('includes.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
