<form method="POST" action="{{ route('administrator.updateMealIngredient', $mealIngredient->id) }}">
    @csrf
    @method('PUT')

    <label for="ingredient_name">Wybierz składnik:</label>
    <select name="ingredient_name" id="ingredient_name">
        @foreach($ingredient as $ingredients)
            <option value="{{ $ingredients->name }}" @if($ingredients->id == $mealIngredient->ingredient_id) selected @endif>{{ $ingredients->name }}</option>
        @endforeach
    </select>

    <div class="form-group">
        <label for="quantity">Ilość</label>
        <input type="text" id="quantity" name="quantity" value="{{$mealIngredient->quantity}}" required>
    </div>

    <label for="unit">Wybierz jednostkę:</label>
    <select name="unit" id="unit">
        <option value="g">g</option>
        <option value="szt.">szt.</option>
        <option value="ml">ml</option>
    </select>

    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</form>
