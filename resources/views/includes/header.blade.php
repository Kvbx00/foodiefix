<nav class="autohide navbar navbar-expand-lg fixed-top">
    <a class="navbar-brand ms-4" href="/">
        <img src="{{ asset('images/logo.png') }}" alt="logo" width="50" height="44">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-semibold">
            <li class="nav-item ms-5">
                <a class="nav-link active" aria-current="page" href="/">Strona główna</a>
            </li>
            <li class="nav-item ms-5">
                <a class="nav-link" href="/recipes">Przepisy</a>
            </li>
            <li class="nav-item ms-5">
                <a class="nav-link" href="/aboutus">O nas</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown ms-5">
                @if(auth()->check())
                    <a class="nav-link active p-0 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="user-icon">
                        <img src="{{ asset('images/user-icon.png') }}" alt="icon" height="40px">
                    </a>
                    <a class="nav-link active p-0 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="user-account">Twoje konto</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/userPanel">Profil</a></li>
                        <li><a class="dropdown-item" href="/user/menu">Menu</a></li>
                        <li><a class="dropdown-item" href="/userPanel/profile">Ustawienia konta</a></li>
                    </ul>
                @endif
            </li>
            <li class="nav-item me-5 ms-5" id="login-button">
                @if(auth()->check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link active fw-semibold d-inline">Wyloguj się</button>
                    </form>
                @else
                    <a class="nav-link active fw-bold" href="/login">Zaloguj się</a>
                @endif
            </li>
        </ul>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function(){

        el_autohide = document.querySelector('.autohide');

        navbar_height = document.querySelector('.navbar').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';

        if(el_autohide){
            var last_scroll_top = 0;
            window.addEventListener('scroll', function() {
                let scroll_top = window.scrollY;
                if(scroll_top < last_scroll_top) {
                    el_autohide.classList.remove('scrolled-down');
                    el_autohide.classList.add('scrolled-up');
                }
                else {
                    el_autohide.classList.remove('scrolled-up');
                    el_autohide.classList.add('scrolled-down');
                }
                last_scroll_top = scroll_top;
            });
        }
    });
</script>

<style>
    .navbar {
        background-color: white;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .2);
    }

    #login-button {
        background-color: #fdcc56;
        border-radius: 30px;
        width: 120px;
        text-align: center;
        transition: 0.3s;
        letter-spacing: 1px;
    }

    #login-button:hover {
        box-shadow: 0 5px 20px rgba(253, 204, 86, 0.4);
        background-color: #fdc056;
        transform: translateY(-5px);
    }

    #user-account{
        visibility: hidden;
        height: 0;
        width: 0;
    }

    .dropdown-menu{
        border: none;
    }

    .dropdown-item:hover{
        background-color: transparent;
    }

    .dropdown-toggle::after{
        margin: 0;
        transition: 1s;
    }

    .dropdown-toggle:hover::after{
        transform: translateY(13px);
    }

    @media (max-width: 991px) {

        .navbar-nav .nav-item {
            margin: 0;
        }

        #login-button {
            background-color: transparent;
            border: none;
            font-weight: 600;
            letter-spacing: 0;
            text-align: left;
            transition: 0s;
        }

        #login-button:hover {
            transform: none;
            box-shadow: none;
            background-color: transparent;
        }

        #user-icon{
            display: none;
        }

        #user-account{
            visibility: visible;
            font-weight: 600;
            height: auto;
            width: auto;
        }
    }

    .scrolled-down{
        transform:translateY(-100%); transition: all 0.3s ease-in-out;
    }
    .scrolled-up{
        transform:translateY(0); transition: all 0.3s ease-in-out;
    }
</style>
