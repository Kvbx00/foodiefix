<div class="sidebar col-md-3 col-lg-2 p-0">
    <div class="offcanvas-md offcanvas-end" tabindex="-1" id="sidebarMenu"
         aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">
                <img src="{{ asset('images/logo-admin-sidebar.png') }}" alt="logo" width="30" height="24">
                Foodie fix
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                    aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                @if( auth()->guard('admin')->user()->role === 'admin')
                    <li class="nav-item mb-1">
                        <button
                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fw-semibold"
                            data-bs-toggle="collapse" data-bs-target="#worker-collapse" aria-expanded="{{ Request::is('adminRegister') || Str::contains(Request::url(), 'admin/dashboard/adminProfile') ? 'true' : 'false' }}">
                            <i class="bi bi-person-fill-exclamation me-2"></i>
                            Pracownicy
                        </button>
                        <div
                            class="collapse {{ Str::contains(Request::url(), ['adminRegister', 'admin/dashboard/adminProfile']) ? 'show' : '' }}"
                            id="worker-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-3">
                                <li>
                                    <a href="{{ url('adminRegister') }}"
                                       class="nav-link link-dark d-flex align-items-center gap-2 {{ Request::is('adminRegister') ? 'active' : '' }}">Rejestracja
                                        pracownika</a>
                                </li>
                                <li><a href="{{ url('admin/dashboard/adminProfile') }}"
                                       class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/adminProfile') ? 'active' : '' }}">Zarządzanie
                                        pracownikami</a></li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if( auth()->guard('admin')->user()->role !== 'admin')
                    <li class="nav-item mb-1">
                        <button
                            class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fw-semibold"
                            data-bs-toggle="collapse" data-bs-target="#profile-collapse" aria-expanded="{{ Request::is('admin/dashboard/juniorProfile') ? 'true' : 'false' }}">
                            <i class="bi bi-person-circle me-2"></i>
                            Twój profil
                        </button>
                        <div
                            class="collapse {{ Request::is('admin/dashboard/juniorProfile') ? 'show' : '' }}"
                            id="profile-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-3">
                                <li><a href="{{ url('admin/dashboard/juniorProfile') }}"
                                       class="nav-link link-dark d-flex align-items-center gap-2 {{ Request::is('admin/dashboard/juniorProfile') ? 'active' : '' }}">Twój
                                        profil</a></li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="nav-item mb-1">
                    <button
                        class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fw-semibold"
                        data-bs-toggle="collapse" data-bs-target="#users-collapse" aria-expanded="{{Str::contains(Request::url(), ['admin/dashboard/userProfile', 'admin/dashboard/userDisease', 'admin/dashboard/userHealthData', 'admin/dashboard/userIngredientPreference', 'admin/dashboard/userCaloricNeed']) ? 'true' : 'false' }}">
                        <i class="bi bi-people-fill me-2"></i>
                        Użytkownicy
                    </button>
                    <div
                        class="collapse {{ Str::contains(Request::url(), ['admin/dashboard/userProfile', 'admin/dashboard/userDisease', 'admin/dashboard/userHealthData', 'admin/dashboard/userIngredientPreference', 'admin/dashboard/userCaloricNeed']) ? 'show' : '' }}"
                        id="users-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-3">
                            <li><a href="{{ url('admin/dashboard/userProfile') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/userProfile') ? 'active' : '' }}">Dane
                                    użytkowników</a></li>
                            <li><a href="{{ url('admin/dashboard/userDisease') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/userDisease') ? 'active' : '' }}">Choroby</a></li>
                            <li><a href="{{ url('admin/dashboard/userHealthData') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/userHealthData') ? 'active' : '' }}">Dane zdrowotne</a>
                            </li>
                            <li><a href="{{ url('admin/dashboard/userIngredientPreference') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/userIngredientPreference') ? 'active' : '' }}">Preferencje
                                    składników</a></li>
                            <li><a href="{{ url('admin/dashboard/userCaloricNeed') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/userCaloricNeed') ? 'active' : '' }}">Zapotrzebowania
                                    kaloryczne</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mb-1">
                    <button
                        class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fw-semibold"
                        data-bs-toggle="collapse" data-bs-target="#diseases-collapse" aria-expanded="{{Str::contains(Request::url(), ['admin/dashboard/disease']) ? 'true' : 'false' }}">
                        <i class="bi bi-heart-pulse-fill me-2"></i>
                        Choroby
                    </button>
                    <div class="collapse {{ Str::contains(Request::url(), ['admin/dashboard/disease']) ? 'show' : '' }}" id="diseases-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-3">
                            <li><a href="{{ url('admin/dashboard/disease') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/disease') ? 'active' : '' }}">Lista chorób</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mb-1">
                    <button
                        class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fw-semibold"
                        data-bs-toggle="collapse" data-bs-target="#meal-collapse" aria-expanded="{{Str::contains(Request::url(), ['admin/dashboard/meal', 'admin/dashboard/mealCategory', 'admin/dashboard/nutritionalvalue', 'admin/dashboard/mealIngredient']) ? 'true' : 'false' }}">
                        <i class="bi bi-egg-fried me-2"></i>
                        Dania
                    </button>
                    <div class="collapse {{ Str::contains(Request::url(), ['admin/dashboard/meal', 'admin/dashboard/mealCategory', 'admin/dashboard/nutritionalvalue', 'admin/dashboard/mealIngredient']) ? 'show' : '' }}" id="meal-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-3">
                            <li><a href="{{ url('admin/dashboard/meal') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Request::is('admin/dashboard/meal') || Request::is('admin/dashboard/meal/addMeal') || Request::is('admin/dashboard/meal/*/edit')  ? 'active' : '' }}">Lista dań</a>
                            </li>
                            <li><a href="{{ url('admin/dashboard/mealCategory') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/mealCategory') ? 'active' : '' }}">Kategorie</a>
                            </li>
                            <li><a href="{{ url('admin/dashboard/nutritionalvalue') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/nutritionalvalue') ? 'active' : '' }}">Wartości
                                    odżywcze</a>
                            </li>
                            <li><a href="{{ url('admin/dashboard/mealIngredient') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/mealIngredient') ? 'active' : '' }}">Składniki w
                                    daniach</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mb-1">
                    <button
                        class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fw-semibold"
                        data-bs-toggle="collapse" data-bs-target="#ingredients-collapse" aria-expanded="{{Str::contains(Request::url(), ['admin/dashboard/ingredient', 'admin/dashboard/ingredientCategory']) ? 'true' : 'false' }}">
                        <i class="bi bi-egg-fill me-2"></i>
                        Składniki
                    </button>
                    <div class="collapse {{ Str::contains(Request::url(), ['admin/dashboard/ingredient', 'admin/dashboard/ingredientCategory']) ? 'show' : '' }}" id="ingredients-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-3">
                            <li><a href="{{ url('admin/dashboard/ingredient') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Request::is('admin/dashboard/ingredient') || Request::is('admin/dashboard/ingredient/addIngredient') || Request::is('admin/dashboard/ingredient/*/edit')  ? 'active' : '' }}">Lista
                                    składników</a>
                            </li>
                            <li><a href="{{ url('admin/dashboard/ingredientCategory') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/ingredientCategory') ? 'active' : '' }}">Kategorie</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <button
                        class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fw-semibold"
                        data-bs-toggle="collapse" data-bs-target="#menu-collapse" aria-expanded="{{Str::contains(Request::url(), ['admin/dashboard/userMenu', 'admin/dashboard/userMenuMeal']) ? 'true' : 'false' }}">
                        <i class="bi bi-bag-fill me-2"></i>
                        Menu
                    </button>
                    <div class="collapse {{ Str::contains(Request::url(), ['admin/dashboard/userMenu', 'admin/dashboard/userMenuMeal']) ? 'show' : '' }}" id="menu-collapse" style="">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ms-3">
                            <li><a href="{{ url('admin/dashboard/userMenu') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Request::is('admin/dashboard/userMenu') || Request::is('admin/dashboard/userMenu/addUserMenu') || Request::is('admin/dashboard/userMenu/*/edit')  ? 'active' : '' }}">Lista menu</a>
                            </li>
                            <li><a href="{{ url('admin/dashboard/userMenuMeal') }}"
                                   class="nav-link link-dark d-flex align-items-center gap-2 {{ Str::contains(Request::url(), 'admin/dashboard/userMenuMeal') ? 'active' : '' }}">Dania w menu</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <div class="nav-link d-flex align-items-center gap-2">
                        <form method="GET" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="logout">Wyloguj się</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
    .btn-toggle[aria-expanded="true"]::before {
        transform: rotate(90deg);
    }

    .btn-toggle::before {
        width: 1.25em;
        line-height: 0;
        content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e ");
        transition: transform .35s ease;
        transform-origin: 0.5em 50%;
    }

    .logout {
        background: none !important;
        border: none;
        padding: 0 !important;
        color: #069;
        cursor: pointer;
    }

    .active {
        color: gold !important;
        font-weight: 500;
    }

    .active:hover {
        color: gold !important;
        font-weight: 500;
    }
</style>
