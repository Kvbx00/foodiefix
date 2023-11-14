<footer id="footer">
    <div class="container py-5">
        <div class="row">
            <div class="col-sm-3 my-2 d-flex align-items-center justify-content-center">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="logo" width="70" height="64">
                </a>
            </div>
            <div class="col-sm-2 my-2 d-flex flex-column align-items-center justify-content-center">
                <h5>Foodie fix</h5>
                <li><a href="/" class="nav-link px-2 text-body-secondary">Strona domowa</a></li>
                <li><a href="/recipes" class="nav-link px-2 text-body-secondary">Przepisy</a></li>
                <li><a href="/register" class="nav-link px-2 text-body-secondary">Rejestracja</a></li>
            </div>
            <div class="col-sm-2 my-2 d-flex flex-column align-items-center justify-content-center">
                <h5>Konto</h5>
                <li><a href="/userPanel" class="nav-link px-2 text-body-secondary">Profil</a></li>
                <li><a href="/user/menu" class="nav-link px-2 text-body-secondary">Menu</a></li>
                <li><a href="/userPanel/profile" class="nav-link px-2 text-body-secondary">Ustawienia konta</a></li>
            </div>
            <div class="col-sm-2 my-2 d-flex flex-column align-items-center justify-content-center">
                <h5>O nas</h5>
                <li class="nav-item"><a href="/aboutus#whoweare" class="nav-link px-2 text-body-secondary">Kim jesteśmy</a></li>
                <li><a href="/aboutus#history" class="nav-link px-2 text-body-secondary">Historia</a></li>
                <li><a href="/aboutus#development" class="nav-link px-2 text-body-secondary">Rozwój</a></li>
            </div>
            <div class="col-sm-3 my-2 d-flex flex-column align-items-center justify-content-center">
                <div class="social-media fs-2 my-2">
                    <a href="#" class="x mx-1"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="facebook mx-1"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram mx-1"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <p class="text-center text-body-secondary">© 2023 Foodie fix</p>
</footer>
<style>
    #footer {
        box-shadow: 0 -3px 4px rgba(0, 0, 0, .1);
        margin-top: 100px;
    }

    #footer li {
        list-style: none;
    }

    #footer li a:hover {
        color: #000000 !important;
    }

    .x {
        color: #000000;
    }

    .facebook{
        color: #0000FF;
    }

    .instagram {
        background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

</style>
