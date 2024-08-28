<nav class="navbar navbar-expand-lg navbar- bg- fixed-top">
    <div class="container-fluid">
        <span class="toggle-sidebar text-white">&#9776;</span>
        <a class="navbar-brand ms-3" href="#">HomePLex Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <form class="d-flex ms-auto">
                        <div class="input-group">
                            <input class="form-control search-input" type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </li>
                @auth

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="productsDropdown">
                      
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    .search-input {
        width: 0;
        opacity: 0;
        transition: width 0.3s ease, opacity 0.3s ease;
    }

    .navbar-nav .nav-item:hover .search-input,
    .navbar-nav .nav-item:focus-within .search-input {
        width: 200px;
        /* Adjust as needed */
        opacity: 1;
        background-color: #fff;
        /* Optional: adjust background color */
    }
</style>
