<div class="container">
    <h1>Edytuj profil użytkownika</h1>
    <form method="POST" action="{{ route('administrator.updateUserProfile', $user->id) }}">
        @csrf
        @method('PUT')

        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        <br>
        <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $user->lastName }}">
        <br>
        <select class="form-control" id="gender" name="gender">
            <option value="Mężczyzna" {{ $user->gender === 'Mężczyzna' ? 'selected' : '' }}>Mężczyzna</option>
            <option value="Kobieta" {{ $user->gender === 'Kobieta' ? 'selected' : '' }}>Kobieta</option>
        </select>
        <br>
        <select class="form-control" id="height" name="height">
            @for ($i = 100; $i <= 220; $i++)
                <option value="{{ $i }}" {{ $user->height == $i ? 'selected' : '' }}>{{ $i }} cm</option>
            @endfor
        </select>
        <br>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        <br>
        <select class="form-control" id="age" name="age">
            @for ($i = 13; $i <= 99; $i++)
                <option value="{{ $i }}" {{ $user->age == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        <br>
        <select class="form-control" id="physicalActivity" name="physicalActivity">
            <option value="Brak treningów" {{ $user->physicalActivity === 'Brak treningów' ? 'selected' : '' }}>Brak treningów</option>
            <option value="Niska aktywność" {{ $user->physicalActivity === 'Niska aktywność' ? 'selected' : '' }}>Niska aktywność</option>
            <option value="Średnia aktywność" {{ $user->physicalActivity === 'Średnia aktywność' ? 'selected' : '' }}>Średnia aktywność</option>
            <option value="Wysoka aktywność" {{ $user->physicalActivity === 'Wysoka aktywność' ? 'selected' : '' }}>Wysoka aktywność</option>
            <option value="Bardzo wysoka aktywność" {{ $user->physicalActivity === 'Bardzo wysoka aktywność' ? 'selected' : '' }}>Bardzo wysoka aktywność</option>
        </select>
        <br>
        <select class="form-control" id="goal" name="goal">
            <option value="Chcę schudnąć" {{ $user->goal === 'Chcę schudnąć' ? 'selected' : '' }}>Chcę schudnąć</option>
            <option value="Chcę utrzymać wagę" {{ $user->goal === 'Chcę utrzymać wagę' ? 'selected' : '' }}>Chcę utrzymać wagę</option>
            <option value="Chcę przytyć" {{ $user->goal === 'Chcę przytyć' ? 'selected' : '' }}>Chcę przytyć</option>
        </select>
        <br>
        <input type="password" class="form-control" id="password" name="password">
        <br>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
    </form>
</div>
