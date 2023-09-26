<form action="{{ route('administrator.saveIngredient') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nazwa składnika</label>
        <input type="text" id="name" name="name" required>
    </div>

    <label for="ingredient_category_name">Wybierz kategorię składnika:</label>
    <select name="ingredient_category_name" id="ingredient_category_name">
        @foreach($ingredientCategory as $ingredientCategories)
            <option value="{{ $ingredientCategories->name }}">{{ $ingredientCategories->name }}</option>
        @endforeach
    </select>

    <button type="submit">Dodaj składnik</button>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</form>
