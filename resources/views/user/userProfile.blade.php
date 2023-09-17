<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
{{ ('Twój profil') }}

<div class="container">
    <h2>Profil użytkownika</h2>
    <form method="post" action="{{ route('user.update', ['id' => $user->id]) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                   @unless($editing) readonly @endunless>
            @unless($editing)
                <button type="button" onclick="toggleEditing('name')">edytuj</button>
            @endunless
            <br>
            <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $user->lastName }}"
                   @unless($editing) readonly @endunless>
            @unless($editing)
                <button type="button" onclick="toggleEditing('lastName')">edytuj</button>
            @endunless
            <br>
            <select class="form-control" id="gender" name="gender" @unless($editing) disabled @endunless>
                <option value="Mężczyzna" {{ $user->gender === 'Mężczyzna' ? 'selected' : '' }}>Mężczyzna</option>
                <option value="Kobieta" {{ $user->gender === 'Kobieta' ? 'selected' : '' }}>Kobieta</option>
            </select>
            <button type="button" onclick="toggleSelectEditing('gender')">Edytuj</button>
            <br>
            <select class="form-control" id="height" name="height" @unless($editing) disabled @endunless>
                @for ($i = 100; $i <= 220; $i++)
                    <option value="{{ $i }}" {{ $user->height == $i ? 'selected' : '' }}>{{ $i }} cm</option>
                @endfor
            </select>
            <button type="button" onclick="toggleSelectEditing('height')">Edytuj</button>
            <br>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                   @unless($editing) readonly @endunless>
            @unless($editing)
                <button type="button" onclick="toggleEditing('email')">edytuj</button>
            @endunless
            <br>
            <select class="form-control" id="age" name="age" @unless($editing) disabled @endunless>
                @for ($i = 13; $i <= 99; $i++)
                    <option value="{{ $i }}" {{ $user->age == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <button type="button" onclick="toggleSelectEditing('age')">Edytuj</button>
            <br>
            <select class="form-control" id="physicalActivity" name="physicalActivity" @unless($editing) disabled @endunless>
                <option value="Brak treningów" {{ $user->physicalActivity === 'Brak treningów' ? 'selected' : '' }}>Brak treningów</option>
                <option value="Niska aktywność" {{ $user->physicalActivity === 'Niska aktywność' ? 'selected' : '' }}>Niska aktywność</option>
                <option value="Średnia aktywność" {{ $user->physicalActivity === 'Średnia aktywność' ? 'selected' : '' }}>Średnia aktywność</option>
                <option value="Wysoka aktywność" {{ $user->physicalActivity === 'Wysoka aktywność' ? 'selected' : '' }}>Wysoka aktywność</option>
                <option value="Bardzo wysoka aktywność" {{ $user->physicalActivity === 'Bardzo wysoka aktywność' ? 'selected' : '' }}>Bardzo wysoka aktywność</option>
            </select>
            <button type="button" onclick="toggleSelectEditing('physicalActivity')">Edytuj</button>
            <br>
            <select class="form-control" id="goal" name="goal" @unless($editing) disabled @endunless>
                <option value="Chcę schudnąć" {{ $user->goal === 'Chcę schudnąć' ? 'selected' : '' }}>Chcę schudnąć</option>
                <option value="Chcę utrzymać wagę" {{ $user->goal === 'Chcę utrzymać wagę' ? 'selected' : '' }}>Chcę utrzymać wagę</option>
                <option value="Chcę przytyć" {{ $user->goal === 'Chcę przytyć' ? 'selected' : '' }}>Chcę przytyć</option>
            </select>
            <button type="button" onclick="toggleSelectEditing('goal')">Edytuj</button>
            <br>
            <input type="password" class="form-control" id="password" name="password"
                   @unless($editing) readonly @endunless>
            <br>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                   @unless($editing) readonly @endunless>
            @unless($editing)
                <button type="button" onclick="toggleEditing(['password', 'password_confirmation'])">Edytuj</button>
            @endunless

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Zapisz</button>
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
        </div>
    </form>
</div>

<style>
    input {
        border: 0;
        pointer-events: none;
    }

    select:disabled {
        border: 0;
        appearance: none;
        color: #000000;
        opacity: 1;
    }

</style>
<script src="{{ asset('js/userProfile.js') }}"></script>
</body>
</html>

