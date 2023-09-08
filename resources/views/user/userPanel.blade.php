<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
    <script src="{{ asset('js/userPanel.js') }}"></script>
</head>

<body>
    {{ ('Panel uzytkownika') }}

    <h1>Dodaj pomiary</h1>
    <!-- Formularz do wprowadzenia pomiarów -->
    <form method="POST" action="{{ route('store.measurements') }}">
        @csrf

        <div class="form-group">
            <label for="weight">Waga</label>
            <select name="weight" id="weight" class="form-control">
                @for ($i = 30; $i <= 200; $i++)
                    <option value="{{ $i }}" {{ old('weight', $lastWeight) == $i ? 'selected' : '' }}>{{ $i }} kg</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="diastolicbloodpressure">Rozkurczowe ciśnienie krwi</label>
            <select name="diastolicbloodpressure" id="diastolicbloodpressure" class="form-control">
                @for ($i = 70; $i <= 160; $i++)
                    <option value="{{ $i }}" {{ old('diastolicbloodpressure') == $i ? 'selected' : '' }}>{{ $i }} mmHG</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="systolicbloodpressure">Skurczowe ciśnienie krwi</label>
            <select name="systolicbloodpressure" id="systolicbloodpressure" class="form-control">
                @for ($i = 50; $i <= 110; $i++)
                    <option value="{{ $i }}" {{ old('systolicbloodpressure') == $i ? 'selected' : '' }}>{{ $i }} mmHG</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="pulse">Puls</label>
            <select name="pulse" id="pulse" class="form-control">
                @for ($i = 40; $i <= 100; $i++)
                    <option value="{{ $i }}" {{ old('pulse') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Zapisz</button>
    </form>
</body>

</html>
