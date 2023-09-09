<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Imię</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="lastName">Nazwisko</label>
            <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required>
        </div>

        <div class="form-group">
            <label for="gender">Płeć</label>
            <select name="gender" id="gender">
                <option value="Mężczyzna" {{ old('gender') == 'Mężczyzna' ? 'selected' : '' }}>Mężczyzna</option>
                <option value="Kobieta" {{ old('gender') == 'Kobieta' ? 'selected' : '' }}>Kobieta</option>
            </select>
        </div>

        <div class="form-group">
            <label for="height">Wzrost</label>
            <select name="height" id="height" class="form-control">
                @for ($i = 100; $i <= 220; $i++)
                    <option value="{{ $i }}" {{ old('height') == $i ? 'selected' : '' }}>{{ $i }} cm</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="weight">Waga</label>
            <select name="weight" id="weight" class="form-control">
                @for ($i = 30; $i <= 200; $i++)
                    <option value="{{ $i }}" {{ old('weight') == $i ? 'selected' : '' }}>{{ $i }} kg</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="age">Wiek</label>
            <select name="age" id="age" class="form-control">
                @for ($i = 13; $i <= 99; $i++)
                    <option value="{{ $i }}" {{ old('age') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="physicalActivity">Poziom aktywności</label>
            <select name="physicalActivity" id="physicalActivity">
                <option {{ old('physicalActivity') == 'Brak treningów' ? 'selected' : '' }}>Brak treningów</option>
                <option {{ old('physicalActivity') == 'Niska aktywność' ? 'selected' : '' }}>Niska aktywność</option>
                <option {{ old('physicalActivity') == 'Średnia aktywność' ? 'selected' : '' }}>Średnia aktywność</option>
                <option {{ old('physicalActivity') == 'Wysoka aktywność' ? 'selected' : '' }}>Wysoka aktywność</option>
                <option {{ old('physicalActivity') == 'Bardzo wysoka aktywność' ? 'selected' : '' }}>Bardzo wysoka aktywność</option>
            </select>
        </div>

        <div class="form-group">
            <label for="goal">Cel diety</label>
            <select name="goal" id="goal">
                <option {{ old('goal') == 'Chcę schudnąć' ? 'selected' : '' }}>Chcę schudnąć</option>
                <option {{ old('goal') == 'Chcę utrzymać wagę' ? 'selected' : '' }}>Chcę utrzymać wagę</option>
                <option {{ old('goal') == 'Chcę przytyć' ? 'selected' : '' }}>Chcę przytyć</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif

        <button type="submit">Register</button>
    </form>

</body>

</html>
