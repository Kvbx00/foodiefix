<form action="{{ route('administrator.saveUserMenu') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="date">Data</label>
        <input type="date" id="date" name="date" required>
    </div>

    <div class="form-group">
        <label for="dayOfTheWeek">Dzień tygodnia</label>
        <select name="dayOfTheWeek" id="dayOfTheWeek">
            <option value="Poniedziałek">Poniedziałek</option>
            <option value="Wtorek">Wtorek</option>
            <option value="Środa">Środa</option>
            <option value="Czwartek">Czwartek</option>
            <option value="Piątek">Piątek</option>
            <option value="Sobota">Sobota</option>
            <option value="Niedziela">Niedziela</option>
        </select>
    </div>

    <div class="form-group">
        <label for="user_id">Wybierz użytkownika:</label>
        <select name="user_id" id="user_id">
            @foreach($users as $user)
                <option value="{{ $user->id }}">id:{{ $user->id }} {{ $user->name }} {{ $user->lastName }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Dodaj Kategorię</button>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</form>
