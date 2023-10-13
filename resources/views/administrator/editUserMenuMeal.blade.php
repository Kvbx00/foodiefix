<div class="container">
    <h1>EDYTUJ DANIA W MENU</h1>
    <form method="POST" action="{{ route('administrator.updateUserMenuMeal', $menuMeal->id) }}">
        @csrf
        @method('PUT')

        <label for="meal_name">Wybierz danie:</label>
        <select name="meal_name" id="meal_name">
            @foreach($meal as $meals)
                <option value="{{ $meals->name }}" @if($meals->id == $menuMeal->meal_id) selected @endif>id:{{$meals->id}} | {{ $meals->name }} | {{ $meals->meal_category_name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
    </form>
</div>

