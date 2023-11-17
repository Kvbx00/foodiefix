<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<body>

@include('includes.admin-header')

<div class="container-fluid">
    @include('includes.error')

    <div class="row">

        @include('includes.admin-sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edycja menu użytkownika</h1>
            </div>

            <form method="POST" action="{{ route('administrator.updateUserMenu', $menu->id) }}">
                @csrf
                @method('PUT')
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="user_id" class="col-form-label">Użytkownik</label>
                        <select name="user_id" id="user_id" class="form-control" disabled>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    id: {{ $user->id }} | {{ $user->name }} {{ $user->lastName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="date" class="col-form-label">Data</label>
                        <input type="date" class="form-control" id="date" name="date"
                               value="{{ \Carbon\Carbon::parse($menu->date)->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="dayOfTheWeek" class="col-form-label">Dzień tygodnia</label>
                        <select name="dayOfTheWeek" id="dayOfTheWeek" class="form-control">
                            <option value="Poniedziałek" @if($menu->dayOfTheWeek === "Poniedziałek") selected @endif>
                                Poniedziałek
                            </option>
                            <option value="Wtorek" @if($menu->dayOfTheWeek === "Wtorek") selected @endif>Wtorek</option>
                            <option value="Środa" @if($menu->dayOfTheWeek === "Środa") selected @endif>Środa</option>
                            <option value="Czwartek" @if($menu->dayOfTheWeek === "Czwartek") selected @endif>Czwartek
                            </option>
                            <option value="Piątek" @if($menu->dayOfTheWeek === "Piątek") selected @endif>Piątek</option>
                            <option value="Sobota" @if($menu->dayOfTheWeek === "Sobota") selected @endif>Sobota</option>
                            <option value="Niedziela" @if($menu->dayOfTheWeek === "Niedziela") selected @endif>Niedziela
                            </option>
                        </select>
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
