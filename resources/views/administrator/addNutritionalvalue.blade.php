<form action="{{ route('administrator.saveNutritionalvalue') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="calories">Kalorie</label>
        <input type="number" id="calories" name="calories" required>
    </div>

    <div class="form-group">
        <label for="protein">Białko</label>
        <input type="text" id="protein" name="protein" required>
    </div>

    <div class="form-group">
        <label for="fats">Tłuszcze</label>
        <input type="text" id="fats" name="fats" required>
    </div>

    <div class="form-group">
        <label for="carbohydrates">Węglowodany</label>
        <input type="text" id="carbohydrates" name="carbohydrates" required>
    </div>

    <label for="meal_name">Wybierz danie:</label>
    <select name="meal_name" id="meal_name">
        @foreach($meal as $meals)
            <option value="{{ $meals->name }}">{{ $meals->name }}</option>
        @endforeach
    </select>

    <button type="submit">Dodaj wartości odżywcze</button>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</form>
