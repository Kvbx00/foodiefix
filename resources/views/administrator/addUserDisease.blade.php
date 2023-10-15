<form action="{{ route('administrator.saveUserDisease') }}" method="POST">
    @csrf
    <label for="user_id">Wybierz użytkownika:</label>
    <select name="user_id" id="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}">id:{{ $user->id }} | {{ $user->name }} {{ $user->lastName }}</option>
        @endforeach
    </select>

    <label for="disease_name">Wybierz chorobę:</label>
    <select name="disease_name" id="disease_name">
        @foreach($diseases as $disease)
            <option value="{{ $disease->name }}">{{ $disease->name }}</option>
        @endforeach
    </select>

    <button type="submit">Dodaj Chorobę</button>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</form>
