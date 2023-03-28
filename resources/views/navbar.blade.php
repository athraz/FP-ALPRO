<nav class="navbar navbar-expand-lg px-5 bg-black fixed-top">
    <a class="navbar-brand" href="/book"><img src="{{ url('img/logo.png') }}" alt="Logo" height="30" class="align-text-top px-5"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu" style="color: white"></i>
    </button>
    <div class="collapse navbar-collapse px-5" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto fs-6">
            @if(auth()->user()->role === 'admin')
            <a class="nav-link text-white mx-1" aria-current="page" href="/hidden">User</a>
            @endif
            <a class="nav-link text-white mx-1" aria-current="page" href="/book">Book</a>
            <li class="nav-item dropdown mx-1">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Genre
                </a>
                <ul class="dropdown-menu">
                    @foreach ($genres->take(5) as $item)
                    <li><a class="dropdown-item" href="/genre/{{$item->id}}">{{$item->name}}</a></li>
                    @endforeach
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/genre">Genre List</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown mx-1 me-5">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Author
                </a>
                <ul class="dropdown-menu">
                    @foreach ($authors->take(5) as $item)
                    <li><a class="dropdown-item" href="/author/{{$item->id}}">{{$item->name}}</a></li>
                    @endforeach
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/author">Author List</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown mx-1">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Hi, {{Auth::user()->name}}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/review">Your Review</a></li>
                    <li><a class="dropdown-item" href="/sesi/logout">Log Out</a></li>
                </ul>
            </li>
        </div>
    </div>
</nav>