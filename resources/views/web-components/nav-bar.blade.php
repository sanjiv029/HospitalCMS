<nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="/Images/logo_hospital.jpg" alt="Logo"> <!-- Replace with your logo -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleContent" aria-controls="navbarToggleContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggleContent">
            <ul class="navbar-nav main-nav">
                <li class="nav-item">
                    <a class="nav-link text-dark underline-effect" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark underline-effect" href="#doctors">Doctors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark underline-effect" href="#departments">Departments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark underline-effect" href="#appointments">Appointment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark underline-effect" href="#about-us">About Us</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark text-uppercase btn btn-link" href="{{route('login')}}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark text-uppercase btn btn-link" href="{{route('register')}}">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
