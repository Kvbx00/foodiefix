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
                <h1 class="h2">Edycja listy zakupów</h1>
            </div>
            <form method="POST" action="{{ route('administrator.updateUserShoppingList', $shoppingList->id) }}">
                @csrf
                @method('PUT')
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="id" class="col-form-label">Id</label>
                        <input type="text" class="form-control" id="id" name="id"
                               value="{{$shoppingList->id}}"
                               disabled>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="ingredient_name" class="col-form-label">Nazwa</label>
                        <input type="text" class="form-control" id="ingredient_name" name="ingredient_name"
                               value="{{$shoppingList->ingredient_name}}" required>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="quantity" class="col-form-label">Ilość</label>
                        <input type="number" class="form-control" id="quantity" name="quantity"
                               value="{{$shoppingList->quantity}}">
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="unit" class="col-form-label">Jednostka</label>
                        <select name="unit" id="unit" class="form-control">
                            <option value=""></option>
                            <option value="g" {{ $shoppingList->unit === 'g' ? 'selected' : '' }}>
                                g
                            </option>
                            <option value="ml" {{ $shoppingList->unit === 'ml' ? 'selected' : '' }}>
                                ml
                            </option>
                            <option value="szt." {{ $shoppingList->unit === 'szt.' ? 'selected' : '' }}>
                                szt.
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="checked" class="col-form-label">Checked</label>
                        <select name="checked" id="checked" class="form-control" required>
                            <option value="0" {{ $shoppingList->checked === 0 ? 'selected' : '' }}>
                                0
                            </option>
                            <option value="1" {{ $shoppingList->checked === 1 ? 'selected' : '' }}>
                                1
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="user_id" class="col-form-label">Id użytkownika</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                               value="{{$shoppingList->user_id}}"
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
