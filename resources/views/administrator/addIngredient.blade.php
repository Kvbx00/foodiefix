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
</body>

</html>
<script>
    $(document).ready(function() {
        $('#ingredient_category_name').select2();
    });
</script>
