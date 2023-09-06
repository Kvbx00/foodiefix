<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="lastname">lastname</label>
            <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="gender">gender</label>
            <input type="text" id="gender" name="gender" value="{{ old('gender') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="height">height</label>
            <input type="text" id="height" name="height" value="{{ old('height') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="age">age</label>
            <input type="text" id="age" name="age" value="{{ old('age') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="physicalactivity">physicalactivity</label>
            <input type="text" id="physicalactivity" name="physicalactivity" value="{{ old('physicalactivity') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="goal">goal</label>
            <input type="text" id="goal" name="goal" value="{{ old('goal') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">Register</button>
    </form>

</body>

</html>
