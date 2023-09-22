<form action="{{ route('administrator.saveDisease') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nazwa choroby</label>
        <input type="text" id="name" name="name" required>
    </div>

    <button type="submit">Dodaj Chorobę</button>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</form>
