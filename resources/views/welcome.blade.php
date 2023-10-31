<!doctype html>
<html lang="pl">

@include('includes.head')

<body>

@include('includes.header')

<div class="container-fluid">
    <div class="row min-vh-100 align-items-center" id="first-main">
        <div class="col-6 d-flex flex-column" id="first-sub-main">
            <p class="fs-2 fw-bold" id="first-sub-main-text-secondary">Zdrowie</p>
            <p class="fs-1 fw-bold" id="first-sub-main-text-primary">to nasza pasja</p>
            <p class="fs-4" id="first-sub-main-text-primary">Nasze przepisy są starannie dobierane przez naszych
                wyspecjalizowanych dietetyków w oparciu o najlepsze produkty.</p>
            <form action="{{ route('login') }}" class="align-self-center">
                <button class="mt-3 fw-bold" id="first-sub-main-button">Sprawdź teraz</button>
            </form>
        </div>
    </div>
    <div class="row align-items-center" id="second-main" style="height: 20vh">
        <div>
            <b class="d-flex justify-content-center mb-3 fs-6" id="second-main-text-primary">OFERTA</b>
            <b class="d-flex justify-content-center fs-3" id="second-main-text-secondary">Co nas wyróżnia?</b>
        </div>
    </div>
    <div class="row align-items-center mb-5" id="third-main" style="height: 45vh">
        <div class="col d-flex justify-content-center">
            <div class="col-sm-5">
                <img src="{{ asset('/images/grid1.svg') }}" class="img-fluid" alt="grid1">
                <p class="d-flex justify-content-center mt-2 fw-medium">Składniki</p>
                <p class="d-flex justify-content-center mt-2 text-center" id="third-main-subtext">Dostosujemy jadłospis
                    do twoich potrzeb! Możesz wybrać do 5-ciu składników których nie lubisz, a my wykluczymy je z twoich
                    dań!</p>
            </div>
        </div>
        <div class="col d-flex justify-content-center">
            <div class="col-sm-5">
                <img src="{{ asset('/images/grid2.svg') }}" class="img-fluid" alt="grid2">
                <p class="d-flex justify-content-center mt-2 fw-medium">Kalorie</p>
                <p class="d-flex justify-content-center mt-2 text-center" id="third-main-subtext">Obliczymy dla Ciebie
                    zapotrzebowanie kaloryczne według Twoich potrzeb, niezależnie czy uprawiasz bardzo dużo sportu, czy
                    prowadzisz biurowy styl żyica!</p>
            </div>
        </div>
        <div class="col d-flex justify-content-center">
            <div class="col-sm-5">
                <img src="{{ asset('/images/grid3.svg') }}" class="img-fluid" alt="grid3">
                <p class="d-flex justify-content-center mt-2 fw-medium">Zdrowie</p>
                <p class="d-flex justify-content-center mt-2 text-center" id="third-main-subtext">Będziemy monitorować
                    twoje dane, dzięki którym będziesz mieć wgląd do swojej historii zdrowia!</p>
            </div>
        </div>
    </div>
    <div class="row" id="fourth-main">
        <div class="col p-0">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner text-center">
                    <div class="carousel-item active" id="car1">
                        <div class="d-flex h-100 align-items-center justify-content-center">
                            <div class="d-flex align-items-center justify-content-center p-5" id="center">Twoje
                                zdrowie, nasza pasja: indywidualne przepisy, profesjonalne doradztwo!<br> Oferujemy nie
                                tylko smaczne dania, ale także specjalnie układane przepisy
                                przez doświadczonych dietetyków. Odkryj smak zdrowego życia z naszymi unikalnymi
                                recepturami, dostosowanymi do Twoich potrzeb – z nami dieta może być zarówno smaczna,
                                jak i zdrowa.
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" id="car2">
                        <div class="d-flex h-100 align-items-center justify-content-center">
                            <div class="d-flex align-items-center justify-content-center pe-5 ps-5" id="center">
                                Odkryj
                                swoją najlepszą wersję z nami! <br> Foodie fix nie tylko pomaga Ci osiągnąć
                                swoje cele wagowe, ale także utrzymać zdrową wagę przez długi czas. Dzięki naszemu
                                doświadczeniu i pasji pomożemy Ci zrzucić zbędne kilogramy lub osiągnąć wymarzoną
                                sylwetkę. Zaufaj nam na swojej drodze do lepszej wersji siebie!
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" id="car3">
                        <div class="d-flex h-100 align-items-center justify-content-center">
                            <div class="d-flex align-items-center justify-content-center pe-5 ps-5" id="center">
                                Osiągnij swoje cele dzięki precyzyjnemu podejściu! <br> Oferujemy nie tylko
                                wyliczanie kalorii, ale również kompleksowe wsparcie w Twojej drodze do zdrowia. Dzięki
                                dokładnemu monitorowaniu kaloryczności posiłków, możemy dostosować Twoją dietę do Twoich
                                indywidualnych potrzeb. Odpowiednio obliczone kalorie - to klucz do osiągnięcia
                                wymarzonej sylwetki i pełnego energii życia!
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>

<style>
    #car1 {
        height: 50vh;
        background-size: cover;
        background-position: center center;
        background-image: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url({{ asset('images/carousel1.jpg') }});
    }

    #car2 {
        height: 50vh;
        background-size: cover;
        background-position: center center;
        background-image: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url({{ asset('images/carousel2.jpg') }});
    }

    #car3 {
        height: 50vh;
        background-size: cover;
        background-position: center center;
        background-image: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url({{ asset('images/carousel3.jpg') }});
    }

    #center {
        margin: 0;
        width: 50%;
        height: 300px;
        background-color: rgba(255, 255, 255, .9);
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .2);
        word-wrap: break-word;
    }

    #second-main-text-primary {
        color: #76c893;
    }

    #third-main-subtext {
        font-size: 14px;
    }
</style>
