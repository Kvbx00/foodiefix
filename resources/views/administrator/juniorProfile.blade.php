<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
<h1>TWÓJ PROFIL</h1>

<div class="container">
    <h2>Profil użytkownika</h2>
    <form method="post" action="{{ route('administrator.updateJuniorProfile', ['id' => $administrator->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $administrator->email }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Zapisz</button>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
    </form>
</div>


