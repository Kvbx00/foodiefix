<div class="container">
    <h1>Edytuj danie</h1>
    <form method="POST" action="{{ route('administrator.updateMeal', $meal->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nazwa dania</label>
            <input type="text" id="name" name="name" value="{{$meal->name}}" required>
        </div>

        <div class="form-group">
            <label for="recipe">przepis</label>
            <input type="text" id="recipe" name="recipe" value="{{$meal->recipe}}" required>
        </div>

        <label for="meal_category_name">Wybierz kategorię:</label>
        <select name="meal_category_name" id="meal_category_name">
            @foreach($mealCategory as $mealCategories)
                <option value="{{ $mealCategories->name }}" @if($mealCategories->id == $meal->meal_category_id) selected @endif>{{ $mealCategories->name }}</option>
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
