<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/user/shoppingList.css') }}">

<body>
@include('includes.header')
@include('includes.success')
@include('includes.error')

<div class="container">
    <div class="d-flex justify-content-center mt-5">
        <p class="fw-normal text-center" style="font-size:40px; letter-spacing: 1px">Lista zakupów</p>
    </div>

    <div class="d-flex flex-row justify-content-center mb-3 mt-4">
        <form action="{{ route('shoppingList.addItem') }}" method="post">
            @csrf
            <div class="row align-items-center justify-content-center">
                <div class="col-4">
                    <input type="text" class="form-control" id="ingredient_name" name="ingredient_name"
                           placeholder="Nazwa"
                           required>
                </div>
                <div class="col-4">
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Ilość">
                </div>
                <div class="col-3">
                    <select class="form-select" id="unit" name="unit">
                        <option value="" selected disabled hidden>Jednostka</option>
                        <option>szt.</option>
                        <option>g</option>
                        <option>ml</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button class="delete-single" type="submit"><i class="bi bi-cart-plus"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="d-flex justify-content-between mb-5 mt-5">
        <form action="{{ route('shoppingList.show') }}" method="GET">
            <input class="search text-center" type="text" name="search" placeholder="Szukaj"
                   value="{{ request('search') }}">
        </form>
        <form action="{{ route('shoppingList.show') }}" method="get">
            <select class="form-select" id="sort" name="sort" onchange="this.form.submit()">
                <option
                    value="ingredient_name|asc" {{ $sort === 'ingredient_name' && $order === 'asc' ? 'selected' : '' }}>
                    Rosnąco
                </option>
                <option
                    value="ingredient_name|desc" {{ $sort === 'ingredient_name' && $order === 'desc' ? 'selected' : '' }}>
                    Malejąco
                </option>
                <option value="id|asc" {{ $sort === 'id' && $order === 'asc' ? 'selected' : '' }}>Najnowsze</option>
                <option value="id|desc" {{ $sort === 'id' && $order === 'desc' ? 'selected' : '' }}>Najstarsze</option>
            </select>
        </form>
        <form action="{{ route('shoppingList.deleteAll') }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">Wyczyść wszystko <i class="bi bi-x-lg"></i></button>
        </form>
    </div>

    <div class="row">
        @forelse($shoppingList as $item)
            <div class="col-md-4 mb-4">
                <div class="card d-flex flex-row justify-content-between {{ $item->checked ? 'checked' : '' }}">
                    <p id="item-{{ $item->id }}"
                       class="fs-5 {{ $item->checked ? 'text-decoration-line-through text-muted' : '' }}">
                        <input class="form-check-input me-3" type="checkbox"
                               onchange="toggleItem({{ $item->id }})" {{ $item->checked ? 'checked' : '' }}>
                        {{ $item->ingredient_name }} {{ $item->quantity }} {{ $item->unit }}
                    </p>
                    <form action="{{ route('shoppingList.delete', $item->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="delete-single" type="submit"><i class="bi bi-trash-fill"></i></button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-md-12 my-5">
                <p class="text-center fs-5">Lista zakupów jest pusta.</p>
            </div>
        @endforelse
    </div>
    <div class="pagination d-flex justify-content-center mt-5">
        @if ($shoppingList->onFirstPage())
            <span class="disabled">&laquo;</span>
            <span class="disabled">&lsaquo;</span>
        @else
            <a href="{{ $shoppingList->url(1) }}&sort={{ $sort }}%7C{{ $order }}&search={{ $search }}">&laquo;</a>
            <a href="{{ $shoppingList->previousPageUrl() }}&sort={{ $sort }}%7C{{ $order }}&search={{ $search }}"
               rel="prev">&lsaquo;</a>
        @endif

        <span
            class="pagination-middle d-flex align-items-center">{{ $shoppingList->currentPage() }} z {{ $shoppingList->lastPage() }}</span>

        @if ($shoppingList->hasMorePages())
            <a href="{{ $shoppingList->nextPageUrl() }}&sort={{ $sort }}%7C{{ $order }}&search={{ $search }}"
               rel="next">&rsaquo;</a>
            <a href="{{ $shoppingList->url($shoppingList->lastPage()) }}&sort={{ $sort }}%7C{{ $order }}&search={{ $search }}">&raquo;</a>
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
<script>
    function toggleItem(itemId) {
        fetch(`{{ url('/user/shoppingList/toggle/') }}/${itemId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({}),
        })
            .then(response => response.json())
            .then(data => {
                const itemElement = document.querySelector(`#item-${itemId}`);
                if (data.checked) {
                    itemElement.classList.add('text-decoration-line-through', 'text-muted');
                } else {
                    itemElement.classList.remove('text-decoration-line-through', 'text-muted');
                }
            });
    }
</script>
