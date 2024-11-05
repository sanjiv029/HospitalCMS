<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="/Images/logo_hospital.jpg" alt="Logo" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleContent" aria-controls="navbarToggleContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggleContent">
            <div class="menu-container">
                {!! \App\Helpers\MenuHelper::renderMenu($menus) !!}
            </div>
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase btn btn-link underline-effect" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase btn btn-link underline-effect" href="{{ route('register') }}">Sign Up</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark text-uppercase btn btn-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item underline-effect" href="{{ url('admin/dashboard') }}">Dashboard</a>
                            </li>
                            <li>
                                <a class="dropdown-item underline-effect" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-logo {
        width: 50px;
    }

    .menu-container {
        position: absolute;
        top: 40%;
        left: 40%;
        transform: translate(-40%, -40%);
        max-width: 100%;
        padding: 15px;
        border-radius: .35rem;
    }

    .nav-item {
        padding-left: 20px;
        padding-right: 20px;
    }

    /* Underline effect for nav links */
    .underline-effect {
        text-decoration: none;
        position: relative;
    }

    .underline-effect::after {
        content: "";
        display: block;
        width: 100%;
        height: 2px;
        background: blue;
        position: absolute;
        left: 0;
        bottom: 0;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .underline-effect:hover::after {
        transform: scaleX(1);
    }

    .dropdown-menu {
        display: none; /* Hide by default */
        opacity: 0;
        transition: opacity 0.2s ease;
        position: absolute; /* Positioning for dropdown */
        z-index: 1000; /* Ensure dropdown appears above other content */
        background-color: white; /* Background color for dropdown */
        border: 1px solid #dee2e6; /* Border around dropdown */
        border-radius: .35rem; /* Rounded corners */
        margin-top: 0; /* Adjust spacing */
        padding: 0; /* Reset padding */
        min-width: 150px; /* Minimum width for dropdowns */
    }

    /* Show dropdown on hover or when active */
    .nav-item.dropdown:hover > .dropdown-menu,
    .nav-item.dropdown .dropdown-menu.show {
        display: block; /* Display dropdown */
        opacity: 1; /* Fully visible */
        transition-delay: 0s; /* No delay when showing */
    }

    /* Adjust dropdown items */
    .dropdown-item {
        padding: 10px 15px; /* Consistent padding */
        white-space: nowrap; /* Prevents text from wrapping */
    }

    /* Hover effect for dropdown items */
    .dropdown-item:hover {
        background-color: #f8f9fa; /* Light background on hover */
        color: #000; /* Change text color on hover */
    }

    /* Additional navbar link styling */
    .nav-link {
        font-size: 1.2em;
    }


</style>
