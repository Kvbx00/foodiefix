<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif

        <button type="submit">
            {{ ('Zaloguj') }}
        </button>

    </form>
</body>

</html>
