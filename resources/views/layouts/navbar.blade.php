<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
 <div class="container">
 <a class="navbar-brand" href="{{ url('/') }}"> START </a>
 <a class="navbar-brand" href="{{ route('comments') }}"> FORUM </a>
 <button class="navbar-toggler" type="button" data-toggle="collapse"
 data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
 aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
 <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarSupportedContent">
 <!-- Left Side Of Navbar -->
 <ul class="navbar-nav mr-auto"> </ul>
 <!-- Right Side Of Navbar -->
 <ul class="navbar-nav ml-auto">
 <!-- Authentication Links -->
 @guest
 <li class="nav-item">
 <a class="nav-link" href="{{ route('login') }}">{{ __('Zaloguj') }}</a>
 </li>
 @if (Route::has('register'))
 <li class="nav-item">
 <a class="nav-link" href="{{ route('register') }}">{{ __('Zarejestruj') }}</a>
 </li>
 @endif
 @else
 <li class="nav-item dropdown">
</a>
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ Auth::user()->name }}
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" >Profil</a>
        <a class="dropdown-item" 
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Wyloguj') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </div>
</li> 
 @endguest
 </ul>
 </div>
 </div>
</nav>
