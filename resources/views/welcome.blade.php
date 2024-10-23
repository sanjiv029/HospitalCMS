<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Appointment Booking</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
            .main-nav {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .nav-item {
                padding-right: 40px
            }

            /* Underline effect for nav links */
            .underline-effect {
                text-decoration: none; /* Remove default underline */
                position: relative; /* Position relative to enable the pseudo-element */
            }

            .underline-effect::after {
                content: ""; /* Create a pseudo-element */
                display: block;
                width: 100%; /* Full width */
                height: 2px; /* Thickness of the underline */
                background:blue; /* Color of the underline */
                position: absolute; /* Position it absolutely */
                left: 0; /* Align it to the left */
                bottom: -5px; /* Position below the text */
                transform: scaleX(0); /* Start scaled down */
                transition: transform 0.3s ease; /* Smooth transition */
            }

            /* Scale the underline on hover */
            .underline-effect:hover::after {
                transform: scaleX(1); /* Scale it to full width on hover */
            }


        .navbar-brand img {
            width: 50px;
        }
        .nav-link {
            font-size: 1.2em;
        }

        .banner-section {
            background-image: url('/Images/hospital-bg.jpg'); /* Optional background image */
            background-size:cover;
            background-position: center;
            color: #fff; /* Ensures text is white for contrast */
        }

        .banner-heading {
            font-size: 2rem; /* Adjust font size */
            font-weight: bold; /* Make it bold for emphasis */
            line-height: 1.2; /* Improve line height for better readability */
        }

        .btn-outline-light {
            color: #00ffc8; /* Text color for the button */
            background-color: transparent; /* Transparent background */
            border-color: #d80000; /* White border */
            padding: 0.75rem 1.5rem; /* Button padding */
            border-radius: 0; /* Box button with sharp edges */
        }

        .card {
            transition: transform 0.3s; /* Add a scaling effect on hover */
            height: 90px; /* Set a fixed height for the cards */
        }

        .card:hover {
            transform: scale(1.03); /* Slight scale effect on hover */
        }

        .card-title {
            font-size: 1.25rem; /* Adjust title font size */
        }

        .card-text {
            font-size: 1rem; /* Adjust number font size */
        }

        .fade-in {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Make the section wider */
        .steps-section {
            padding-left: 10%;
            padding-right: 10%;
        }
        .doctor-container  .department-container {
            padding: 20px;
            overflow-x: auto; /* Enables horizontal scrolling */
        }

        .doctor-container .row {
            display: flex; /* Flexbox for horizontal layout */
            flex-wrap: nowrap; /* Prevent wrapping of cards */
        }
        .department-container .row {
            display: flex; /* Flexbox for horizontal layout */
            flex-wrap: nowrap; /* Prevent wrapping of cards */
        }

        .card {
            transition: transform 0.2s; /* Smooth transition for hover effect */
        }

        .card:hover {
            transform: scale(1.05); /* Slightly increase size on hover */
        }

        .profile-image img {
            border: 2px solid #007bff; /* Optional: add border to profile images */
            transition: transform 0.2s; /* Smooth transition for hover effect */
        }

        .profile-image img:hover {
            transform: scale(1.1); /* Enlarge the image slightly on hover */
        }

        /* Positioning for the scroll arrows */
        .left-arrow {
            left: 10px; /* Position the left arrow */
            top: 50%; /* Center vertically */
            transform: translateY(-50%); /* Adjust vertical alignment */
            z-index: 1; /* Ensure it's above other elements */
        }

        .right-arrow {
            right: 10px; /* Position the right arrow */
            top: 50%; /* Center vertically */
            transform: translateY(-50%); /* Adjust vertical alignment */
            z-index: 1; /* Ensure it's above other elements */
        }
        .stats-section{
        margin-left: 400px
        }



    </style>
</head>
<body id="home">

<!-- Navbar -->
@include('web-components.nav-bar')
@include('web-components.banner')
@include('web-components.steps')
@include('web-components.departments')
@include('web-components.doctors')

    <!-- Footer -->
    <footer class="text-center mt-5">
        <p>&copy; 2024 Hospital Appointment System. All rights reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @include('components.scroll')
    @include('components.view')
</body>
</html>
