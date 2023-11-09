<!doctype html>
<html lang="pl">

@include('includes.head')

<link rel="stylesheet" href="{{ asset('owlcarousel/owl.carousel.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('owlcarousel/owl.theme.default.min.css') }}">

<body class="pt-5">

@include('includes.header')

@if($menuCheck)

    <div class="container my-5">
        <div class="col-12 d-flex flex-row justify-content-end">
            <div class="d-flex timer align-items-center">
                <i class="bi bi-stopwatch"></i>
                <span class="mx-2" id="countdown"></span>
                <span>
            <form action="{{ route('menu.create') }}" method="post">
                @csrf
                <button type="submit" id="menuButton" disabled>Nowe menu</button>
            </form>
        </span>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center mb-2">
                <p class="fw-normal text-center" style="font-size:40px; letter-spacing: 1px">Menu</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="owl" class="owl-carousel owl-theme text-center">
            @foreach($daysOfWeek as $index => $day)
                <div class="item day-buttons fw-semibold">
                    <button id="dayOfTheWeek-{{ $index }}" class="day-button"
                            data-day="{{ $index }}">
                        {{ $day }}<br>{{ $menuDates[$index]->format('d-m-Y') }}
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container-fluid">

        @foreach($daysOfWeek as $index => $day)
            <div class="row menu-day mt-5 mb-3 justify-content-center" id="day-{{ $index }}">
                @foreach($groupedMenuMeals[$day] as $menuMeal)
                    @if(isset($menuMeal->meal))
                        <div
                            class="card col-xl-3 col-lg-4 col-md-6 mx-4 my-4 justify-content-between {{ $menuMeal->meal->mealCategory_name }}">
                            <div class="d-flex p-4 justify-content-between">
                            <span
                                class="rounded-category text-uppercase">{{ $menuMeal->meal->mealCategory_name }}</span>
                                <span class="rounded-name">{{ $day }}</span>
                            </div>
                            <div class="d-flex justify-content-center text-center">
                            <span class="meal-name">
                                <a href="{{ route('meal.show', ['id' => $menuMeal->meal->id]) }}">{{ $menuMeal->meal->name }}</a>
                            </span>
                            </div>
                            <div class="p-4">
                                <a data-bs-toggle="collapse" href="#{{ $menuMeal->meal->id }}" role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    <img src="{{ asset('images/info.svg') }}" alt="info" width="20px">
                                </a>
                                <div class="collapse" id="{{ $menuMeal->meal->id }}">
                                    <ol>
                                        <li>Kalorie: {{ $menuMeal->meal->nutritionalvalues->calories }} kcal</li>
                                        <li>Białko: {{ $menuMeal->meal->nutritionalvalues->protein }} g</li>
                                        <li>Tłuszcz: {{ $menuMeal->meal->nutritionalvalues->fats }} g</li>
                                        <li>Węglowodany: {{ $menuMeal->meal->nutritionalvalues->carbohydrates }} g</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

@else
    <div class="container h-100 mt-5">
        <div class="mb-2">
            <p class="fw-normal text-center" style="font-size:40px; letter-spacing: 1px">Menu</p>
        </div>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="card col-8 d-flex flex-column justify-content-center align-items-center noMenu">
                <h1 class="mb-5">Nie masz jeszcze menu?</h1>
                <form action="{{ route('menu.create') }}" method="post">
                    @csrf
                    <button type="submit" class="p-3" id="menuButton">Utwórz już teraz!</button>
                </form>
            </div>
        </div>
    </div>
@endif


@include('includes.footer')

<script src="{{ asset('owlcarousel/owl.carousel.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
<script>
    $(document).ready(function () {
        var today = new Date().getDay();

        today = (today - 1 + 7) % 7;

        $('#date-' + today).addClass('active-day');
        $('#dayOfTheWeek-' + today).addClass('active-day');

        $('.menu-day').addClass('hidden');
        $('#day-' + today).removeClass('hidden');

        $('.day-button').click(function () {
            var day = $(this).data('day');
            $('.menu-day').addClass('hidden');
            $('#day-' + day).removeClass('hidden');

            $('.day-button').removeClass('active-day');
            $('#dayOfTheWeek-' + day).addClass('active-day');

            $('.date').removeClass('active-day');
            $('#date-' + day).addClass('active-day');
        });
    });

    $("#owl").owlCarousel({
        nav: true,
        navText: ["<i class='bi bi-caret-left'></i>", "<i class='bi bi-caret-right'></i>"],
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            },
            1200: {
                items: 7
            }
        }
    })
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var countdownRunning = true;

        function updateCountdown() {
            var now = new Date();
            var monday = new Date();
            monday.setHours(0, 0, 0, 0);
            var daysUntilMonday = (1 + 7 - monday.getDay()) % 7;
            monday.setDate(monday.getDate() + daysUntilMonday);

            var timeRemaining = monday.getTime() - now.getTime();
            var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML = days + ":" + hours + ":" + minutes + ":" + seconds;

            if (timeRemaining <= 0) {
                countdownRunning = false;
            }
        }

        setInterval(function () {
            updateCountdown();
            if (!countdownRunning) {
                document.getElementById("menuButton").removeAttribute("disabled");
            }
        }, 1000);
    });
</script>
<style>
    .timer {
        border: 1px solid gold;
        border-left: 6px solid gold;
        background-color: #FFFFFF;
        padding: 5px;
    }

    .timer button {
        border: none;
        background-color: transparent;
    }

    .card.noMenu {
        height: 450px;
        border: none;
        box-shadow: 0 3px 6px 0 rgba(0, 0, 0, .2);
    }

    .card.noMenu:hover {
        transform: none;
    }

    .noMenu button{
        border: none;
        border-radius: 10px;
        background-color: #7FC954;
        color: #FFFFFF;
        letter-spacing: 1px;
        font-size: 20px;
        font-weight: 700;
        transition: transform .7s;
    }

    .noMenu button:hover {
        transform: scale(1.1);
    }

    .card {
        height: 450px;
        border: none;
        box-shadow: 0 3px 6px 0 rgba(0, 0, 0, .2);
        transition: transform 1s;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .Śniadanie {
        background-image: linear-gradient(rgba(0, 0, 0, 0.20), rgba(0, 0, 0, 0.20)), url("{{ asset('images/breakfast.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
    }

    .śniadanie {
        background-image: linear-gradient(rgba(0, 0, 0, 0.20), rgba(0, 0, 0, 0.20)), url("{{ asset('images/2breakfast.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
    }

    .Obiad {
        background-image: linear-gradient(rgba(0, 0, 0, 0.20), rgba(0, 0, 0, 0.20)), url("{{ asset('images/dinner.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
    }

    .Podwieczorek {
        background-image: linear-gradient(rgba(0, 0, 0, 0.20), rgba(0, 0, 0, 0.20)), url("{{ asset('images/tea.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
    }

    .Kolacja {
        background-image: linear-gradient(rgba(0, 0, 0, 0.20), rgba(0, 0, 0, 0.20)), url("{{ asset('images/supper.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
    }

    .rounded-category {
        text-align: center;
        font-weight: 600;
        font-size: 13px;
        padding: 4px 7px 4px 7px;
        border-radius: 30px;
        background-color: #000000;
        color: #FFFFFF;
    }

    .rounded-name {
        text-align: center;
        font-weight: 600;
        font-size: 12px;
        padding: 4px 7px 4px 7px;
        border-radius: 30px;
        background-color: rgba(0, 0, 0, 0.3);
        color: #FFFFFF;
    }

    .meal-name a {
        font-size: 40px;
        font-weight: 700;
        letter-spacing: 1px;
        text-decoration: none;
        color: #FFFFFF;
    }

    ol {
        padding: 0;
    }

    ol li {
        position: relative;
        display: block;
        padding: .1em .4em 0 1.5em;
        margin: .5em 0;
        background: #FFFFFF;
        text-decoration: none;
        border-radius: 20px;
        transition: .3s ease-out;
        box-shadow: 0 3px 6px 0 rgba(0, 0, 0, .2);
    }

    ol li:hover {
        background: #E9E4E0;
    }

    .hidden {
        display: none;
    }

    .day-button {
        background: none;
        color: inherit;
        border: none;
        font: inherit;
        outline: inherit;
        letter-spacing: 1px;
    }

    .date {
        letter-spacing: 1px;
    }

    .active-day {
        color: #fdc056 !important;
        border-bottom: 2px solid #fdc056;
    }

    @media (max-width: 767px) {
        .row {
            width: 70% !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }
    }

    .owl-prev, .owl-next {
        position: absolute;
        bottom: -18%;
        background-color: transparent !important;
        color: #000000 !important;
    }

    .owl-prev {
        left: 0;
    }

    .owl-next {
        right: 0;
    }

    .owl-next.disabled, .owl-prev.disabled {
        cursor: not-allowed !important;
    }
</style>
