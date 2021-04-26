<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            {{-- <li>
                <a class="nav-item nav-link" href="/">Home</a>
            </li> --}}

            @if (Auth::user())
            @can('manage-users', User::class)
            <li>
                <a class="nav-item nav-link" href="{{route('dashboard')}}">Users</a>
            </li>
            @endcan
            @can('manage-pages', User::class)
            <li>
                <a class="nav-item nav-link" href="{{route('pages.index')}}">Pages</a>
            </li>
            @endcan
            @can('manage-roles', User::class)
            <li>
                <a class="nav-item nav-link" href="{{route('roles.index')}}">Roles</a>
            </li>
            @endcan

            @can('manage-recipes', User::class)
            <li>
                <a class="nav-item nav-link" href="{{route('recipes.index')}}">Recipes</a>
            </li>
            @endcan
            @endif
        </ul>

        <ul class="navbar-nav">
            @if (Auth::user())
            <li>
                <a class="nav-item nav-link" href="{{route('logout')}}">Logout</a>
            </li>
            @else
            <li>
                <a class="nav-item nav-link" href="{{route('login')}}">Login</a>
            </li>
            <li>
                <a class="nav-item nav-link" href="{{route('register')}}">Register</a>
            </li>
            @endif
        </ul>
    </div>
</nav>