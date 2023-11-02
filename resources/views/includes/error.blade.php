@if ($errors->any())
    <div class="alert alert-warning alert-dismissible fade show fixed-top d-flex justify-content-center" role="alert">
        @foreach ($errors->all() as $error)
            <li class="me-4">{{ $error }}</li>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
