<form action="{{ route('administrator.saveMealIngredient') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="meal_name">Wybierz danie:</label>
        <select name="meal_name" id="meal_name">
            @foreach($meal as $meals)
                <option value="{{ $meals->name }}">{{ $meals->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="ingredient_name">Wybierz składnik:</label>
        <select name="ingredient_name" id="ingredient_name">
            @foreach($ingredient as $ingredients)
                <option value="{{ $ingredients->name }}">{{ $ingredients->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="quantity">Ilość</label>
        <input type="text" id="quantity" name="quantity" required>
    </div>

    <div class="form-group">
        <label for="unit">Wybierz jednostkę:</label>
        <select name="unit" id="unit">
            <option value="g">g</option>
            <option value="szt.">szt.</option>
            <option value="ml">ml</option>
        </select>
    </div>

    <button type="submit">Dodaj składnik do dania</button>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</form>
