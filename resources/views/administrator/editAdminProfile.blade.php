<div class="container">
    <h1>Edytuj profil pracownika</h1>
    <form method="POST" action="{{ route('administrator.updateAdminProfile', $administrator->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="role">Rola</label>
            <select name="role" id="role">
                <option value="admin">Administrator</option>
                <option value="dietician">Dietetyk</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
    </form>
</div>
