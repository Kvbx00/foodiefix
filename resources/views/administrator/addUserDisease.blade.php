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
<form action="{{ route('administrator.saveUserDisease') }}" method="POST">
    @csrf
    <label for="user_id">Wybierz użytkownika:</label>
    <select name="user_id" id="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}">id:{{ $user->id }} | {{ $user->name }} {{ $user->lastName }}</option>
        @endforeach
    </select>

    <label for="disease_name">Wybierz chorobę:</label>
    <select name="disease_name" id="disease_name">
        @foreach($diseases as $disease)
            <option value="{{ $disease->name }}">{{ $disease->name }}</option>
        @endforeach
    </select>

    <button type="submit">Dodaj Chorobę</button>

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
        $('#user_id').select2();
        $('#disease_name').select2();
    });
</script>
