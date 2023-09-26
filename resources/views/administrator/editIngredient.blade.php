<div class="container">
    <h1>Edytuj składnik</h1>
    <form method="POST" action="{{ route('administrator.updateIngredient', $ingredient->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nazwa składnika</label>
            <input type="text" id="name" name="name" value="{{$ingredient->name}}" required>
        </div>

        <label for="ingredient_category_name">Wybierz kategorię:</label>
        <select name="ingredient_category_name" id="ingredient_category_name">
            @foreach($ingredientCategory as $ingredientCategories)
                <option value="{{ $ingredientCategories->name }}" @if($ingredientCategories->id == $ingredient->category_id) selected @endif>{{ $ingredientCategories->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
    </form>
</div>
