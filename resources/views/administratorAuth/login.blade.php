<!doctype html>
<html lang="pl">

@include('includes.head')

<body>

<div class="container">
    @include('includes.error')

    <div class="row justify-content-center align-items-center" style="height:100vh">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="form-floating my-3">
                            <img src="{{ asset('images/logo-admin.png') }}" alt="logo" width="50" height="44">
                        </div>
                        <div class="form-floating my-3">
                            <input type="email" id="floatingEmail"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="floatingEmail">Adres email</label>
                        </div>
                        <div class="form-floating my-3">
                            <input type="password" id="floatingPassword"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="current-password">
                            <label for="floatingPassword">Hasło</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Zaloguj</button>
                    </form>
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
    body{
        background: rgb(56,56,56);
        background: linear-gradient(90deg, rgba(56,56,56,1) 0%, rgba(0,0,0,1) 50%, rgba(56,56,56,1) 100%);
    }

    .card{
        background-color: #000000;
        border: 1px solid #FFFFFF;
        box-shadow: 0 4px 16px 0 rgba(255, 255, 255, .5);
    }

    .btn{
        background-color: #000000;
        border: 1px solid #FFFFFF;
    }

    .btn:hover{
        background-color: #FFFFFF;
        color: #000000;
        border: 1px solid #000000;
    }
</style>
