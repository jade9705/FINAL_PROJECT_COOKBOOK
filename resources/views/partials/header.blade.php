

<header class="header">
    <div class="header__logoContainer">
        <img class="header__logo" src="./images/logo.svg" />
    </div>
    <nav class="header__nav">
        @guest
        <a class="header__link" href={{route('login')}} >LOGIN</a>
        <a class="header__link" href={{route('register')}} >REGISTER</a>
        @endguest

        @auth
        <a class="header__link" href="" >HOME</a>
        <a class="header__link" href="" >FEED</a>
        <a class="header__link" href="" >PROFILE</a>
        <a class="header__link" href="" >SEARCH</a>
        <a
            class="header__link"
            href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('LOGOUT') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        @endauth
    </nav>
</header>