@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show fixed-top d-flex justify-content-center" role="alert">
            <li class="me-4">{{ session()->get('success') }}</li>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
