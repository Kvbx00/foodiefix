<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/user/menu.css') }}">
<link rel="stylesheet" href="{{ asset('owlcarousel/owl.carousel.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('owlcarousel/owl.theme.default.min.css') }}">

<body class="pt-5">

@include('includes.header')
@include('includes.error')
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
        mouseDrag: false,
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
