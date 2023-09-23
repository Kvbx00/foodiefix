<form action="{{ route('administrator.saveMeal') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nazwa dania</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="recipe">Przepis</label>
        <input type="text" id="recipe" name="recipe" required>
    </div>

    <label for="meal_category_name">Wybierz kategorię dania:</label>
    <select name="meal_category_name" id="meal_category_name">
        @foreach($mealCategory as $mealCategories)
            <option value="{{ $mealCategories->name }}">{{ $mealCategories->name }}</option>
        @endforeach
    </select>

    <button type="submit">Dodaj danie</button>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</form>
