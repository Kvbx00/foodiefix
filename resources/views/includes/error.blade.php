@if ($errors->any())
    <div class="alert alert-warning alert-dismissible fade show fixed-top d-flex justify-content-center" role="alert">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
