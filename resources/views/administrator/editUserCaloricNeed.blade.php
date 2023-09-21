<div class="container">
    <h1>Edytuj zapotrzebowanie kaloryczne użytkownika</h1>
    <form method="POST" action="{{ route('administrator.updateUserCaloricNeed', $caloricNeed->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="caloricNeeds">Kalorie</label>
                <input type="number" id="caloricNeeds" name="caloricNeeds" value="{{$caloricNeed->caloricNeeds}}" required>
        </div>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
    </form>
</div>
