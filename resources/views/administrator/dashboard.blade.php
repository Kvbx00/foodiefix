<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>FoodieFix</title>
</head>

<body>
{{ ('admin dashboard') }}
<br>
@if( auth()->guard('admin')->user()->role === 'admin')
    <a href="{{ url('adminRegister') }}">Rejestracja pracownika</a>
    <a href="{{ url('admin/dashboard/adminProfile') }}">Zarządzanie pracownikami</a>
@endif
@if( auth()->guard('admin')->user()->role !== 'admin')
    <a href="{{ url('admin/dashboard/juniorProfile') }}">Twój profil</a>
@endif
<br>
<a href="{{ url('admin/dashboard/userProfile') }}">Profil użytkownika</a>
<br>
<a href="{{ url('admin/dashboard/userDisease') }}">Choroby użytkownika</a>
<br>
<a href="{{ url('admin/dashboard/userHealthData') }}">Dane zdrowotne użytkownika</a>
<br>
<a href="{{ url('admin/dashboard/userIngredientPreference') }}">Preferencje składników użytkownika</a>
<br>
<a href="{{ url('admin/dashboard/userCaloricNeed') }}">Zapotrzebowanie kaloryczne użytkownika</a>
<br>
<a href="{{ url('admin/dashboard/disease') }}">Choroby</a>
<br>
<a href="{{ url('admin/dashboard/mealCategory') }}">Kategorie dań</a>
<br>
<a href="{{ url('admin/dashboard/meal') }}">Dania</a>
<br>
<a href="{{ url('admin/dashboard/mealIngredient') }}">Składniki w daniach</a>
<br>
<a href="{{ url('admin/dashboard/nutritionalvalue') }}">Wartości odżywcze w daniach</a>
<br>
<a href="{{ url('admin/dashboard/ingredientCategory') }}">Kategorie składników</a>
<br>
<a href="{{ url('admin/dashboard/ingredient') }}">Składniki</a>
<br>
<a href="{{ url('admin/dashboard/userMenu') }}">Menu</a>
<br>
<a href="{{ url('admin/dashboard/userMenuMeal') }}">Dania w Menu</a>

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit">Wyloguj się</button>
</form>
</body>

</html>
