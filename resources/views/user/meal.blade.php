<!doctype html>
<html lang="pl">

@include('includes.head')

<body class="pt-5">

@include('includes.header')

<div class="container mt-5 mb-3">
    <div class="col-12 d-flex flex-row justify-content-start">
        <div class="d-flex menu align-items-center">
            <i class="bi bi-caret-left"></i>
            <form action="{{ url()->previous() }}">
                @csrf
                <button type="submit">Powrót</button>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="d-flex justify-content-center">
            <p class="fw-normal text-center"
               style="font-size:40px; letter-spacing: 1px">{{ $meal->meal_category->name }}</p>
        </div>
    </div>
</div>

<div class="container">

    <div class="card p-5 mb-4">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold mb-5">{{ $meal->name }}</h1>
            <ol>
                @foreach(preg_split("/\d+\./", $meal->recipe, -1, PREG_SPLIT_NO_EMPTY) as $instruction)
                    @if(trim($instruction) !== '')
                        <li>{{ trim($instruction) }}</li>
                    @endif
                @endforeach
            </ol>
        </div>
    </div>

    <div class="row align-items-md-stretch">

        <div class="col-md-6 mb-4 mb-md-0">
            <div class="card h-100 p-5" style="background-color: #ffee99">
                <h2>Wartości odżywcze</h2>
                <ul>
                    <li>Kalorie: {{ $meal->nutritionalvalues->calories }}</li>
                    <li>Białko: {{ $meal->nutritionalvalues->protein }}</li>
                    <li>Tłuszcze: {{ $meal->nutritionalvalues->fats }}</li>
                    <li>Węglowodany: {{ $meal->nutritionalvalues->carbohydrates }}</li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 p-5" style="background-color: #ecf39e">
                <h2>Składniki</h2>
                <ul>
                    @foreach($meal->ingredients as $ingredient)
                        <li>{{ $ingredient->name }}
                            - {{ $ingredient->pivot->quantity }} {{ $ingredient->pivot->unit }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

</div>

@include('includes.footer')

<script src="{{ asset('owlcarousel/owl.carousel.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
<style>
    .menu {
        border: 1px solid gold;
        border-left: 6px solid gold;
        background-color: #FFFFFF;
        padding: 5px;
    }

    .menu button {
        border: none;
        background-color: transparent;
    }

    .card {
        border: none;
        box-shadow: 0 3px 6px 0 rgba(0, 0, 0, .2);
    }

    ol {
        counter-reset: section;
        list-style: none;
    }

    ol li:before {
        content: counter(section);
        counter-increment: section;
        display: inline-block;
        background-color: #ffea00;
        border-radius: 100%;
        width: 30px;
        height: 30px;
        text-align: center;
        margin: 0 20px 0 0;
        font-weight: 500;
    }

    ol li {
        display: list-item;
        position: relative;
        padding: .1em .4em 0 0;
        line-height: 30px;
        margin: .5em 0;
        background: #FFFFFF;
        border-radius: 20px;
        transition: .3s ease-out;
    }

    ol li:hover {
        background: #fefae0;
    }
</style>
