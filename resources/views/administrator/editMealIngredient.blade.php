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
<form method="POST" action="{{ route('administrator.updateMealIngredient', $mealIngredient->id) }}">
    @csrf
    @method('PUT')

    <label for="ingredient_name">Wybierz składnik:</label>
    <select name="ingredient_name" id="ingredient_name">
        @foreach($ingredient as $ingredients)
            <option value="{{ $ingredients->name }}" @if($ingredients->id == $mealIngredient->ingredient_id) selected @endif>{{ $ingredients->name }}</option>
        @endforeach
    </select>

    <div class="form-group">
        <label for="quantity">Ilość</label>
        <input type="text" id="quantity" name="quantity" value="{{$mealIngredient->quantity}}" required>
    </div>

    <label for="unit">Wybierz jednostkę:</label>
    <select name="unit" id="unit">
        <option value="g">g</option>
        <option value="szt.">szt.</option>
        <option value="ml">ml</option>
    </select>

    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>

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
        $('#ingredient_name').select2();
    });
</script>
