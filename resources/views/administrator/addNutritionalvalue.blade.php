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
<form action="{{ route('administrator.saveNutritionalvalue') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="calories">Kalorie</label>
        <input type="number" id="calories" name="calories" required>
    </div>

    <div class="form-group">
        <label for="protein">Białko</label>
        <input type="text" id="protein" name="protein" required>
    </div>

    <div class="form-group">
        <label for="fats">Tłuszcze</label>
        <input type="text" id="fats" name="fats" required>
    </div>

    <div class="form-group">
        <label for="carbohydrates">Węglowodany</label>
        <input type="text" id="carbohydrates" name="carbohydrates" required>
    </div>

    <label for="meal_name">Wybierz danie:</label>
    <select name="meal_name" id="meal_name">
        @foreach($meal as $meals)
            <option value="{{ $meals->name }}">{{ $meals->name }}</option>
        @endforeach
    </select>

    <button type="submit">Dodaj wartości odżywcze</button>

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
        $('#meal_name').select2();
    });
</script>
