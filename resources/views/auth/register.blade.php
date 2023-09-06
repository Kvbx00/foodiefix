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
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="lastname">lastname</label>
            <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
        </div>

        <div class="form-group">
            <label for="gender">gender</label>
            <select name="gender" id="gender">
                <option>Mężczyzna</option>
                <option>Kobieta</option>
            </select>
        </div>

        <div class="form-group">
            <label for="height">Wzrost</label>
            <select name="height" id="height" class="form-control">
                @for ($i = 100; $i <= 220; $i++)
                    <option value="{{ $i }}">{{ $i }} cm</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="weight">Waga</label>
            <select name="weight" id="weight" class="form-control">
                @for ($i = 30; $i <= 200; $i++)
                    <option value="{{ $i }}">{{ $i }} kg</option>
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
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="physicalactivity">physicalactivity</label>
            <input type="text" id="physicalactivity" name="physicalactivity" value="{{ old('physicalactivity') }}"
                required>
        </div>

        <div class="form-group">
            <label for="goal">goal</label>
            <input type="text" id="goal" name="goal" value="{{ old('goal') }}" required>
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
