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
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="{{ asset('/images/login-user.jpg') }}"
                                 alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;"/>
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img src="{{ asset('images/logo.png') }}" alt="logo" width="50" height="44">
                                    </div>
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Zaloguj się na swoje
                                        konto</h5>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="floatingEmail"
                                               placeholder="" name="email" value="{{ old('email') }}" required
                                               autocomplete="email" autofocus>
                                        <label for="floatingEmail">Adres email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="floatingPassword"
                                               placeholder="" name="password" required autocomplete="current-password">
                                        <label for="floatingPassword">Hasło</label>
                                    </div>
                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit">Zaloguj</button>
                                    </div>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Nie masz konta?
                                        <a href="/register" style="color: #393f81;">Zarejestruj się</a></p>
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
