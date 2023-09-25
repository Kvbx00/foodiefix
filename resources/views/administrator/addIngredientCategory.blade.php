<form action="{{ route('administrator.saveIngredientCategory') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nazwa kategorii</label>
        <input type="text" id="name" name="name" required>
    </div>

    <button type="submit">Dodaj Kategorię</button>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</form>
