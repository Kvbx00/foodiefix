<form action="{{ route('administrator.saveUserMenuMeal') }}" method="POST">
    @csrf

    <label for="menu_id">Wybierz menu:</label>
    <select name="menu_id" id="menu_id">
        @foreach($menu as $menus)
            <option value="{{ $menus->id }}">id:{{ $menus->id }} | {{ $menus->dayOfTheWeek }}</option>
        @endforeach
    </select>
    <br>
    <label for="meal_name">Wybierz danie:</label>
    <select name="meal_name" id="meal_name">
        @foreach($meal as $meals)
            <option value="{{ $meals->name }}">id:{{$meals->id}} | {{ $meals->name }} | {{ $meals->meal_category_name }}</option>
        @endforeach
    </select>

    <button type="submit">Dodaj danie</button>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</form>
