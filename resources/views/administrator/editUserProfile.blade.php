<!doctype html>
<html lang="pl">

@include('includes.head')

<body>

@include('includes.admin-header')

<div class="container-fluid">
    @include('includes.error')

    <div class="row">

        @include('includes.admin-sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edycja użytkownika</h1>
            </div>

            <form method="POST" action="{{ route('administrator.updateUserProfile', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="name" class="col-form-label">Imię</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="lastName" class="col-form-label">Nazwisko</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $user->lastName }}">
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="gender" class="col-form-label">Płeć</label>
                        <select id="gender" name="gender" class="form-control">
                            <option value="Mężczyzna" {{ $user->gender === 'Mężczyzna' ? 'selected' : '' }}>Mężczyzna</option>
                            <option value="Kobieta" {{ $user->gender === 'Kobieta' ? 'selected' : '' }}>Kobieta</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="height" class="col-form-label">Wzrost</label>
                        <br>
                        <select id="height" name="height" class="form-control">
                            @for ($i = 100; $i <= 220; $i++)
                                <option value="{{ $i }}" {{ $user->height == $i ? 'selected' : '' }}>{{ $i }} cm</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="age" class="col-form-label">Wiek</label>
                        <br>
                        <select id="age" name="age" class="form-control">
                            @for ($i = 13; $i <= 99; $i++)
                                <option value="{{ $i }}" {{ $user->age == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="physicalActivity" class="col-form-label">Aktywność fizyczna</label>
                        <select id="physicalActivity" name="physicalActivity" class="form-control">
                            <option value="Brak treningów" {{ $user->physicalActivity === 'Brak treningów' ? 'selected' : '' }}>
                                Brak treningów
                            </option>
                            <option
                                value="Niska aktywność" {{ $user->physicalActivity === 'Niska aktywność' ? 'selected' : '' }}>
                                Niska aktywność
                            </option>
                            <option
                                value="Średnia aktywność" {{ $user->physicalActivity === 'Średnia aktywność' ? 'selected' : '' }}>
                                Średnia aktywność
                            </option>
                            <option
                                value="Wysoka aktywność" {{ $user->physicalActivity === 'Wysoka aktywność' ? 'selected' : '' }}>
                                Wysoka aktywność
                            </option>
                            <option
                                value="Bardzo wysoka aktywność" {{ $user->physicalActivity === 'Bardzo wysoka aktywność' ? 'selected' : '' }}>
                                Bardzo wysoka aktywność
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="goal" class="col-form-label">Cel</label>
                        <select id="goal" name="goal" class="form-control">
                            <option value="Chcę schudnąć" {{ $user->goal === 'Chcę schudnąć' ? 'selected' : '' }}>Chcę
                                schudnąć
                            </option>
                            <option value="Chcę utrzymać wagę" {{ $user->goal === 'Chcę utrzymać wagę' ? 'selected' : '' }}>Chcę
                                utrzymać wagę
                            </option>
                            <option value="Chcę przytyć" {{ $user->goal === 'Chcę przytyć' ? 'selected' : '' }}>Chcę przytyć
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="password" class="col-form-label">Hasło</label>
                        <input type="password" id="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="input">
                        <label for="password_confirmation" class="col-form-label">Powtórz hasło</label>
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
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

<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#height').select2();
        $('#age').select2();
    });
</script>

<style>
    .input {
        width: 400px;
    }

    .select2-selection {
        border: none !important;
    }

    .select2 {
        width: 100% !important;
        padding: 0.375rem 2.25rem 0.375rem 0 !important;
        -moz-padding-start: calc(0.75rem - 3px) !important;
        font-size: 1rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        color: #212529 !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 0.25rem !important;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
    }

    .select2-dropdown {
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
        padding: 0.375rem 0 0.375rem 0.75rem;
    }

    .select2-results__option {
        font-weight: normal !important;
        display: block !important;
        min-height: 1.2em !important;
        padding: 0 2px 1px !important;
    }

    .select2-search {
        background-color: #fff !important;
        -webkit-box-shadow: none !important;
        -moz-box-shadow: none !important;
        box-shadow: none !important;
        border: none !important;
        padding-right: 0.75rem;
    }

    .select2-search__field {
        outline: none !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
    }

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #0d6efd !important;
        color: white !important;
    }

    .select2-selection__arrow b{
        display:none !important;
    }
</style>
