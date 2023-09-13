<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
{{ ('Panel uzytkownika') }}

<h1>Dodaj pomiary</h1>
<!-- Formularz do wprowadzenia pomiarów -->
<form method="POST" action="{{ route('measurements.store') }}">
    @csrf

    <div class="form-group">
        <label for="weight">Waga</label>
        <select name="weight" id="weight" class="form-control">
            @for ($i = 30; $i <= 200; $i++)
                <option value="{{ $i }}" {{ old('weight', $lastValues['weight']) == $i ? 'selected' : '' }}>{{ $i }}
                    kg
                </option>
            @endfor
        </select>
    </div>

    <div class="form-group">
        <label for="diastolicBloodPressure">Rozkurczowe ciśnienie krwi</label>
        <select name="diastolicBloodPressure" id="diastolicBloodPressure" class="form-control">
            @for ($i = 70; $i <= 160; $i++)
                <option
                    value="{{ $i }}" {{ old('diastolicBloodPressure', $lastValues['diastolicBloodPressure']) == $i ? 'selected' : '' }}>{{ $i }}
                    mmHG
                </option>
            @endfor
        </select>
    </div>

    <div class="form-group">
        <label for="systolicBloodPressure">Skurczowe ciśnienie krwi</label>
        <select name="systolicBloodPressure" id="systolicBloodPressure" class="form-control">
            @for ($i = 50; $i <= 110; $i++)
                <option
                    value="{{ $i }}" {{ old('systolicBloodPressure', $lastValues['systolicBloodPressure']) == $i ? 'selected' : '' }}>{{ $i }}
                    mmHG
                </option>
            @endfor
        </select>
    </div>

    <div class="form-group">
        <label for="pulse">Puls</label>
        <select name="pulse" id="pulse" class="form-control">
            @for ($i = 40; $i <= 100; $i++)
                <option
                    value="{{ $i }}" {{ old('pulse', $lastValues['pulse']) == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Zapisz</button>
</form>

@if ($availableDiseases->count() > 0)
    <h2>Wybierz Chorobę</h2>
    <form method="post" action="{{ route('diseases.store') }}">
        @csrf
        <select name="diseases_id">
            @foreach($availableDiseases as $disease)
                <option value="{{ $disease->id }}">{{ $disease->name }}</option>
            @endforeach
        </select>
        <button type="submit">Dodaj</button>
    </form>
@else
    <p>Wszystkie dostępne choroby zostały już dodane.</p>
@endif

<h1>Twoje Choroby</h1>
<ul>
    @if(auth()->check() && auth()->user()->diseases->count() > 0)
        @foreach(auth()->user()->diseases as $userDisease)
            <li>
                {{ $userDisease->name }}
                <form action="{{ route('diseases.destroy', $userDisease->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Usuń</button>
                </form>
            </li>
        @endforeach
    @else
        <li>Brak przypisanych chorób.</li>
    @endif
</ul>

@if (auth()->user()->ingredientPreferences->count() < 5)
    <h2>Wybierz Składniki</h2>
    <form method="post" action="{{ route('ingredients.store') }}">
        @csrf
        <select name="ingredient_id">
            @foreach($availableIngredients as $ingredient)
                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
            @endforeach
        </select>
        <button type="submit">Dodaj</button>
    </form>
@else
    <p>Osiągnąłeś limit wybranych składników (maksymalnie 5).</p>
@endif

<h1>Twoje preferencje składników</h1>
<ul>
    @if(auth()->check() && auth()->user()->ingredientPreferences->count() > 0)
        @foreach(auth()->user()->ingredientPreferences as $userIngredient)
            <li>
                {{ $userIngredient->name }}
                <form action="{{ route('ingredients.destroy', $userIngredient->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Usuń</button>
                </form>
            </li>
        @endforeach
    @else
        <li>Brak przypisanych składników.</li>
    @endif
</ul>
</body>
</html>

