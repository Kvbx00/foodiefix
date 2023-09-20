<form action="{{ route('administrator.saveUserIngredientPreference') }}" method="POST">
    @csrf
    <label for="user_id">Wybierz użytkownika:</label>
    <select name="user_id" id="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lastName }}</option>
        @endforeach
    </select>

    <label for="ingredient_name">Wybierz składnik:</label>
    <select name="ingredient_name" id="ingredient_name">
        @foreach($ingredients as $ingredient)
            <option value="{{ $ingredient->name }}">{{ $ingredient->name }}</option>
        @endforeach
    </select>

    <button type="submit">Dodaj preferencję</button>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</form>
