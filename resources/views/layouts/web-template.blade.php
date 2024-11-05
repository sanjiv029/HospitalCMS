<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Appointment System')</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        /* Banner section styling */
        .banner-section {
            background-image: url('/Images/banner_new.jpg');
            background-size: cover;
            background-position: center;
            color: #fff;
        }

        .banner-heading {
            font-size: 2rem;
            font-weight: bold;
            line-height: 1.2;
        }

        /* Button styling */
        .btn-outline-light {
            color: #00ffc8;
            background-color: transparent;
            border-color: #d80000;
            padding: 0.75rem 1.5rem;
            border-radius: 0;
        }

        /* Card hover effect */
        .card {
            transition: transform 0.3s;
            height: 90px;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card-title {
            font-size: 1.25rem;
        }

        .card-text {
            font-size: 1rem;
        }

        /* Fade-in animation */
        .fade-in {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Layout adjustments */
        .steps-section {
            padding: 0 10%;
        }

        .doctor-container,
        .department-container {
            padding: 20px;
            overflow-x: auto;
        }

        .doctor-container .row,
        .department-container .row {
            display: flex;
            flex-wrap: nowrap;
        }

        .profile-image img {
            border: 2px solid #007bff;
            transition: transform 0.2s;
        }

        .profile-image img:hover {
            transform: scale(1.1);
        }

        .left-arrow,
        .right-arrow {
            top: 50%;
            transform: translateY(-50%);
            z-index: 1;
        }

        .left-arrow {
            left: 10px;
        }

        .right-arrow {
            right: 10px;
        }

        .stats-section {
            margin-left: 400px;
        }
    </style>
    @yield('custom-css')
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    @include('web-components.nav-bar')

    <!-- Main Content -->
    <div class="flex-grow-1">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        @include('web-components.footer')
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('custom-scripts')
    @include('components.back-to-top')
    @include('components.scroll')
    @include('components.view')
</body>
</html>
