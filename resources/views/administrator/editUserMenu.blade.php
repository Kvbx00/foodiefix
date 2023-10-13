<div class="container">
    <h1>EDYTUJ MENU UŻYTKOWNIKA</h1>
    <form method="POST" action="{{ route('administrator.updateUserMenu', $menu->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="date">Data</label>
            <input type="date" id="date" name="date" value="{{ \Carbon\Carbon::parse($menu->date)->format('Y-m-d') }}">
        </div>

        <div class="form-group">
            <label for="dayOfTheWeek">Dzień tygodnia</label>
            <select name="dayOfTheWeek" id="dayOfTheWeek" class="form-control">
                <option value="Poniedziałek" @if($menu->dayOfTheWeek === "Poniedziałek") selected @endif>Poniedziałek
                </option>
                <option value="Wtorek" @if($menu->dayOfTheWeek === "Wtorek") selected @endif>Wtorek</option>
                <option value="Środa" @if($menu->dayOfTheWeek === "Środa") selected @endif>Środa</option>
                <option value="Czwartek" @if($menu->dayOfTheWeek === "Czwartek") selected @endif>Czwartek</option>
                <option value="Piątek" @if($menu->dayOfTheWeek === "Piątek") selected @endif>Piątek</option>
                <option value="Sobota" @if($menu->dayOfTheWeek === "Sobota") selected @endif>Sobota</option>
                <option value="Niedziela" @if($menu->dayOfTheWeek === "Niedziela") selected @endif>Niedziela</option>
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">Wybierz użytkownika:</label>
            <select name="user_id" id="user_id" disabled>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">id:{{ $user->id }} {{ $user->name }} {{ $user->lastName }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
    </form>
</div>

