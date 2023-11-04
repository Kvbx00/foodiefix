<!doctype html>
<html lang="pl">

@include('includes.head')

<body>

<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center"
     style="background-color: #E4DBB1;">

    @include('includes.error')

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block" id="form-image" style="border-radius: 1rem 0 0 1rem;">
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img src="{{ asset('images/logo.png') }}" alt="logo" width="50" height="44">
                                    </div>
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Zarejestruj się</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating">
                                                <input type="text" id="floatingName"
                                                       class="form-control form-control-lg" placeholder="" name="name"
                                                       value="{{ old('name') }}" required autofocus/>
                                                <label class="form-label" for="floatingName">Imię</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-floating">
                                                <input type="text" id="floatingLastName"
                                                       class="form-control form-control-lg" placeholder=""
                                                       name="lastName"
                                                       value="{{ old('lastName') }}" required/>
                                                <label class="form-label" for="floatingLastName">Nazwisko</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-md-flex justify-content-start align-items-center mb-3 py-2">
                                        <div class="form-check form-check-inline mb-0 me-4">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   id="femaleGender"
                                                   value="Kobieta" checked/>
                                            <label class="form-check-label" for="femaleGender">Kobieta</label>
                                        </div>
                                        <div class="form-check form-check-inline mb-0 me-4">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   id="maleGender"
                                                   value="Mężczyzna"/>
                                            <label class="form-check-label" for="maleGender">Mężczyzna</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <select class="form-select" name="physicalActivity" id="physicalActivity"
                                                    required>
                                                <option value="" selected disabled hidden>Poziom Aktywności</option>
                                                <option {{ old('physicalActivity') == 'Brak treningów' ? 'selected' : '' }}>
                                                    Brak treningów
                                                </option>
                                                <option {{ old('physicalActivity') == 'Niska aktywność' ? 'selected' : '' }}>
                                                    Niska aktywność
                                                </option>
                                                <option {{ old('physicalActivity') == 'Średnia aktywność' ? 'selected' : '' }}>
                                                    Średnia aktywność
                                                </option>
                                                <option {{ old('physicalActivity') == 'Wysoka aktywność' ? 'selected' : '' }}>
                                                    Wysoka aktywność
                                                </option>
                                                <option {{ old('physicalActivity') == 'Bardzo wysoka aktywność' ? 'selected' : '' }}>
                                                    Bardzo wysoka aktywność
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <select class="form-select" name="goal" id="goal" required>
                                                <option value="" selected disabled hidden>Cel diety</option>
                                                <option {{ old('goal') == 'Chcę schudnąć' ? 'selected' : '' }}>Chcę
                                                    schudnąć
                                                </option>
                                                <option {{ old('goal') == 'Chcę utrzymać wagę' ? 'selected' : '' }}>Chcę
                                                    utrzymać wagę
                                                </option>
                                                <option {{ old('goal') == 'Chcę przytyć' ? 'selected' : '' }}>Chcę
                                                    przytyć
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <select class="form-select" name="age" id="age" required>
                                                <option value="" selected disabled hidden>Wiek</option>
                                                @for ($i = 13; $i <= 99; $i++)
                                                    <option
                                                        value="{{ $i }}" {{ old('age') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <select class="form-select" name="height" id="height" required>
                                                <option value="" selected disabled hidden>Wzrost</option>
                                                @for ($i = 100; $i <= 220; $i++)
                                                    <option
                                                        value="{{ $i }}" {{ old('height') == $i ? 'selected' : '' }}>{{ $i }}
                                                        cm
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <select class="form-select" name="weight" id="weight" required>
                                                <option value="" selected disabled hidden>Waga</option>
                                                @for ($i = 30; $i <= 200; $i++)
                                                    <option
                                                        value="{{ $i }}" {{ old('weight') == $i ? 'selected' : '' }}>{{ $i }}
                                                        kg
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control"
                                               id="floatingEmail"
                                               placeholder="" name="email" value="{{ old('email') }}" required>
                                        <label for="floatingEmail">Adres email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password"
                                               class="form-control"
                                               id="floatingPassword"
                                               placeholder="" name="password" required>
                                        <label for="floatingPassword">Hasło</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password"
                                               class="form-control"
                                               id="floatingPassword"
                                               placeholder="" name="password_confirmation" required>
                                        <label for="floatingPassword">Powtórz hasło</label>
                                    </div>
                                    <div class="d-flex justify-content-end pt-3">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit">Zarejestruj</button>
                                    </div>
                                    <p class="" style="color: #393f81;">Masz już konto?
                                        <a href="/login" style="color: #393f81;">Zaloguj się</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>

<style>
    #form-image {
        background-image: url({{ asset('images/signup-user.jpg') }});
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

