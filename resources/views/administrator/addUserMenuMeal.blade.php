<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
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
</body>

</html>
<script>
    $(document).ready(function() {
        $('#menu_id').select2();
        $('#meal_name').select2();
    });
</script>
