{{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">VesitForum</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

  <ul class="navbar-nav ml-auto">
    <!-- <% if(!currentUser){ %> -->
      <li class="nav-item">
        <a  href="/login" class="nav-link">Login</a>
      </li>
    <!-- <% } else { %> -->

      <li class="nav-item">
        <a class="nav-link" href="/logout">Logout</a>
      </li>
    <!-- <% } %> -->

    </ul>
  </div>
</nav> --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'VesitForum') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto" id="myDIV">
              <li class="nav-item active">
                <a class="nav-link" href="{{URL::to('discussions')}}">Discussions<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{URL::to('discussions/create')}}">Start Discussion</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{URL::to('groups')}}">Your Groups</a>
              </li>
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Category
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a href="discussions/topic/sports" class="dropdown-item">Sports</a>
                  <a href="discussions/topic/technology" class="dropdown-item">Technology</a>
                  <a href="discussions/topic/science" class="dropdown-item">Science</a>
                  <a href="discussions/topic/politics" class="dropdown-item">Politics</a>
                  <a href="discussions/topic/education" class="dropdown-item">Education</a>
              </div>
            </li>
          </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link btn  btn-danger btn-sm"
                         style="marginRight : 5px; color : white; borderRadius: 10px;"
                         href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link btn btn-danger btn-sm"
                             style="marginRight : 5px; color : white; borderRadius: 10px;"
                            href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="home">Dashboard</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
