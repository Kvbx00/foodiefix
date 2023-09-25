<div class="container">
    <h1>Edytuj danie</h1>
    <form method="POST" action="{{ route('administrator.updateNutritionalvalue', $nutritionalvalue->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="calories">Kalorie</label>
            <input type="number" id="calories" name="calories" value="{{$nutritionalvalue->calories}}" required>
        </div>

        <div class="form-group">
            <label for="protein">Białko</label>
            <input type="text" id="protein" name="protein" value="{{$nutritionalvalue->protein}}" required>
        </div>

        <div class="form-group">
            <label for="fats">Tłuszcze</label>
            <input type="text" id="fats" name="fats" value="{{$nutritionalvalue->fats}}" required>
        </div>

        <div class="form-group">
            <label for="carbohydrates">Węglowodany</label>
            <input type="text" id="carbohydrates" name="carbohydrates" value="{{$nutritionalvalue->carbohydrates}}" required>
        </div>

        <div class="form-group">
            <label for="meal_name">Danie</label>
            <input type="text" id="meal_name" name="meal_name" value="{{$nutritionalvalue->meal_name}}" disabled>
        </div>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
    </form>
</div>
