<div class="container">
    <h1>Edytuj kategorię</h1>
    <form method="POST" action="{{ route('administrator.updateMealCategory', $mealCategory->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nazwa kategorii</label>
            <input type="text" id="name" name="name" value="{{$mealCategory->name}}" required>
        </div>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
    </form>
</div>
