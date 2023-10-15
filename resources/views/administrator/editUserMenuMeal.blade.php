<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
<div class="container">
    <h1>EDYTUJ DANIA W MENU</h1>
    <form method="POST" action="{{ route('administrator.updateUserMenuMeal', $menuMeal->id) }}">
        @csrf
        @method('PUT')

        <label for="meal_name">Wybierz danie:</label>
        <select name="meal_name" id="meal_name">
            @foreach($meal as $meals)
                <option value="{{ $meals->name }}" @if($meals->id == $menuMeal->meal_id) selected @endif>
                    id:{{$meals->id}} | {{ $meals->name }} | {{ $meals->meal_category_name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
    </form>
</div>
</body>

</html>
<script>
    $(document).ready(function () {
        $('#meal_name').select2();
    });
</script>
