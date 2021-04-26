<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li>
                <a class="nav-item nav-link" href="/">Home</a>
            </li>

            @include('partials.nav')
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