<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/recipes.css') }}">
<link rel="stylesheet" href="{{ asset('owlcarousel/owl.carousel.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('owlcarousel/owl.theme.default.min.css') }}">

<body class="pt-5">

@include('includes.header')

<div class="container mt-5">

    <form action="{{ route('recipes') }}" method="GET">
        <div class="col-12 d-flex flex-row justify-content-end">
            <input class="search" type="text" name="search" placeholder="Szukaj" value="{{ request('search') }}">
        </div>
    </form>

    <div class="container my-5">
        <div id="owl" class="owl-carousel owl-theme text-center">
            @foreach($categories as $category)
                <div class="item fw-semibold">
                    <a class="categories @if($selectedCategory == $category->id) active-category @endif"
                       href="{{ route('recipes', ['category' => $category->id, 'search' => $search]) }}">{{ $category->name }}</a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row align-items-md-stretch">

        @foreach($meal as $meals)
            <div class="col-md-4 mb-4">
                <div class="card h-100 p-5 align-items-center justify-content-center text-center">
                    <a href="{{ route('recipes.meal', ['id' => $meals->id]) }}" style="text-decoration: none">
                        <h3>{{ $meals->name }}</h3></a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination d-flex justify-content-center mt-3">
        @if ($meal->onFirstPage())
            <span>&laquo;</span>
            <span>&lsaquo;</span>
        @else
            <a href="{{ $meal->url(1) }}&search={{ $search }}&category={{ $selectedCategory }}">&laquo;</a>
            <a href="{{ $meal->previousPageUrl() }}&search={{ $search }}&category={{ $selectedCategory }}" rel="prev">&lsaquo;</a>
        @endif

        <span
            class="pagination-middle">{{ $meal->currentPage() }} z {{ $meal->lastPage() }}</span>

        @if ($meal->hasMorePages())
            <a href="{{ $meal->nextPageUrl() }}&search={{ $search }}&category={{ $selectedCategory }}" rel="next">&rsaquo;</a>
            <a href="{{ $meal->url($meal->lastPage()) }}&search={{ $search }}&category={{ $selectedCategory }}">&raquo;</a>
        @else
            <span>&rsaquo;</span>
            <span>&raquo;</span>
        @endif
    </div>

</div>

@include('includes.footer')

<script src="{{ asset('owlcarousel/owl.carousel.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var selectedCategory = "{{ $selectedCategory }}";
        if (selectedCategory) {
            $(".categories").removeClass("active-category");
            $(".categories[href*='category=" + selectedCategory + "']").addClass("active-category");
        }

        var owl = $("#owl");
        owl.owlCarousel({
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
                    items: 5
                }
            }
        });

        var activeCategoryIndex = $(".categories").index($(".active-category"));
        var visibleItems = owl.data('owl.carousel').options.items;
        var centerIndex = Math.floor(visibleItems / 2);
        var scrollToIndex = activeCategoryIndex - centerIndex;
        owl.trigger('to.owl.carousel', [scrollToIndex, 0, true]);
    });
</script>
