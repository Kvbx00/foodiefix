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
</body>

</html>
<script>
    $(document).ready(function() {
        $('#ingredient_category_name').select2();
    });
</script>
