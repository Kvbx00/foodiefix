<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
<body>

@include('includes.header')

<div class="container-fluid">

    <div class="row min-vh-100 align-items-center" id="first-main">
        <div class="col-6 d-flex flex-column" id="first-sub-main">
            <p class="fs-2 fw-bold" id="first-sub-main-text-secondary">Zdrowie</p>
            <p class="fs-1 fw-bold" id="first-sub-main-text-primary">to nasza pasja</p>
            <p class="fs-4" id="first-sub-main-text-primary">Nasze przepisy są starannie dobierane przez naszych
                wyspecjalizowanych dietetyków w oparciu o najlepsze produkty.</p>
            <form action="{{ route('menu.show') }}" class="align-self-center">
                <button class="mt-3 fw-bold" id="first-sub-main-button">Sprawdź teraz</button>
            </form>
        </div>
    </div>

    <div class="mt-5">

        <div class="row mb-5 mt-5 pe-5 ps-5">
            <div class="col-md-7 d-flex flex-column justify-content-center align-items-center text-center">
                <p class="fw-normal" style="font-size:50px; letter-spacing: 1px">Składniki. <span
                        class="text-body-secondary">Wszystko tak jak lubisz.</span></p>
                <p class="lead">Dostosujemy jadłospis
                    do twoich potrzeb! Możesz wybrać jakich składników nie lubisz, a my wykluczymy je z twoich
                    dań!</p>
            </div>
            <div class="col-md-5 d-flex justify-content-center">
                <img class="img-fluid mx-auto" src="{{ asset('images/grid1.svg') }}" alt="grid1" width="500"
                     height="500">
            </div>
        </div>

        <div class="row mb-5 mt-5 pe-5 ps-5">
            <div class="col-md-7 order-md-2 d-flex flex-column justify-content-center align-items-center text-center">
                <p class="fw-normal" style="font-size:50px; letter-spacing: 1px">Kalorie. <span
                        class="text-body-secondary">Od czegoś trzeba zacząć.</span></p>
                <p class="lead">Obliczymy dla Ciebie
                    zapotrzebowanie kaloryczne według Twoich potrzeb, niezależnie czy uprawiasz bardzo dużo sportu, czy
                    prowadzisz biurowy styl życia.</p>
            </div>
            <div class="col-md-5 d-flex justify-content-center">
                <img class="img-fluid mx-auto" src="{{ asset('images/grid2.svg') }}" alt="grid2" width="500"
                     height="500">
            </div>
        </div>


        <div class="row mb-5 mt-5 pe-5 ps-5">
            <div class="col-md-7 d-flex flex-column justify-content-center align-items-center text-center">
                <p class="fw-normal" style="font-size:50px; letter-spacing: 1px">Zdrowie. <span
                        class="text-body-secondary">Czyli to co najważniejsze.</span></p>
                <p class="lead">Będziemy monitorować
                    twoje dane, dzięki którym będziesz mieć wgląd do swojej historii zdrowia.</p>
            </div>
            <div class="col-md-5 d-flex justify-content-center">
                <img class="img-fluid mx-auto" src="{{ asset('images/grid3.svg') }}" alt="grid3" width="500"
                     height="500">
            </div>
        </div>

        <div id="myCarousel" class="carousel slide carousel-fade mb-5 mt-5" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                        aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"
                        class=""></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"
                        class="" aria-current="true"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="col-md-12" id="carousel1">
                    </div>
                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>Twoje
                                zdrowie, nasza pasja: indywidualne przepisy, profesjonalne doradztwo!</h1>
                            <p class="opacity-75"> Oferujemy nie
                                tylko smaczne dania, ale także specjalnie układane przepisy
                                przez doświadczonych dietetyków. Odkryj smak zdrowego życia z naszymi unikalnymi
                                recepturami, dostosowanymi do Twoich potrzeb – z nami dieta może być zarówno smaczna,
                                jak i zdrowa.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-12" id="carousel2">
                    </div>
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Odkryj swoją najlepszą wersję z nami!</h1>
                            <p>Foodie fix nie tylko pomaga Ci osiągnąć
                                swoje cele wagowe, ale także utrzymać zdrową wagę przez długi czas. Dzięki naszemu
                                doświadczeniu i pasji pomożemy Ci zrzucić zbędne kilogramy lub osiągnąć wymarzoną
                                sylwetkę. Zaufaj nam na swojej drodze do lepszej wersji siebie!</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="col-md-12" id="carousel3">
                    </div>
                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>Osiągnij swoje cele dzięki precyzyjnemu podejściu!</h1>
                            <p>Oferujemy nie tylko
                                wyliczanie kalorii, ale również kompleksowe wsparcie w Twojej drodze do zdrowia. Dzięki
                                dokładnemu monitorowaniu kaloryczności posiłków, możemy dostosować Twoją dietę do Twoich
                                indywidualnych potrzeb. Odpowiednio obliczone kalorie - to klucz do osiągnięcia
                                wymarzonej sylwetki i pełnego energii życia!</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>

</div>

@include('includes.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
