@extends('layouts.web-template')

@section('content')
<div class="container my-5 py-5 bg-light">
    <!-- Heading Section -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">About Us</h2>
        <p class="text-muted">Dedicated to providing quality healthcare services, we believe in the power of accessible medical assistance for everyone.</p>
    </div>

    <!-- Our Mission, Vision, and Values -->
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="icon mb-3">
                <i class="fas fa-heartbeat fa-3x text-danger"></i>
            </div>
            <h4 class="fw-semibold">Our Mission</h4>
            <p class="text-secondary">To provide accessible, affordable, and quality healthcare, empowering individuals to live healthier, happier lives.</p>
        </div>
        <div class="col-md-4 mb-4">
            <div class="icon mb-3">
                <i class="fas fa-eye fa-3x text-info"></i>
            </div>
            <h4 class="fw-semibold">Our Vision</h4>
            <p class="text-secondary">We envision a world where quality healthcare is a right for all, enhancing the well-being of communities globally.</p>
        </div>
        <div class="col-md-4 mb-4">
            <div class="icon mb-3">
                <i class="fas fa-hand-holding-heart fa-3x text-success"></i>
            </div>
            <h4 class="fw-semibold">Our Values</h4>
            <p class="text-secondary">Compassion, integrity, and excellence drive our commitment to care for every individual with respect and empathy.</p>
        </div>
    </div>

    <!-- Team Section -->
    <div class="text-center mt-5 mb-4">
        <h3 class="fw-bold text-primary">Meet Our Team</h3>
        <p class="text-muted">A dedicated team of professionals passionate about healthcare and service.</p>
    </div>
    <div class="row">
        <!-- Dummy Team Member 1 -->
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="text-center p-4">
                    <img src="https://via.placeholder.com/120" alt="Dr. Alice Johnson" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="card-title fw-semibold">Dr. Alice Johnson</h5>
                    <p class="card-text text-muted">Chief Medical Officer</p>
                </div>
                <div class="card-footer bg-transparent border-0 text-center">
                    <a href="#" class="text-secondary me-2"><i class="fab fa-linkedin fa-lg"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-twitter fa-lg"></i></a>
                </div>
            </div>
        </div>

        <!-- Dummy Team Member 2 -->
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="text-center p-4">
                    <img src="https://via.placeholder.com/120" alt="Dr. Michael Lee" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="card-title fw-semibold">Dr. Michael Lee</h5>
                    <p class="card-text text-muted">Senior Cardiologist</p>
                </div>
                <div class="card-footer bg-transparent border-0 text-center">
                    <a href="#" class="text-secondary me-2"><i class="fab fa-linkedin fa-lg"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-twitter fa-lg"></i></a>
                </div>
            </div>
        </div>

        <!-- Dummy Team Member 3 -->
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="text-center p-4">
                    <img src="https://via.placeholder.com/120" alt="Dr. Sarah Kim" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="card-title fw-semibold">Dr. Sarah Kim</h5>
                    <p class="card-text text-muted">Pediatric Specialist</p>
                </div>
                <div class="card-footer bg-transparent border-0 text-center">
                    <a href="#" class="text-secondary me-2"><i class="fab fa-linkedin fa-lg"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-twitter fa-lg"></i></a>
                </div>
            </div>
        </div>

        <!-- Dummy Team Member 4 -->
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="text-center p-4">
                    <img src="https://via.placeholder.com/120" alt="Dr. John Smith" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="card-title fw-semibold">Dr. John Smith</h5>
                    <p class="card-text text-muted">Orthopedic Surgeon</p>
                </div>
                <div class="card-footer bg-transparent border-0 text-center">
                    <a href="#" class="text-secondary me-2"><i class="fab fa-linkedin fa-lg"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-twitter fa-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
