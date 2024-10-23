
   <!-- Banner Section -->
   <section class="banner-section bg-info text-light">
    <div class="container text-center d-flex flex-column justify-content-between h-100 py-5">
        <h3 class="banner-heading">
            Keep yourself and your family healthy
        </h3>
        <h3 class="banner-heading mt-3">
            Find the right specialist
        </h3>
        <div class="mt-4">
            <a href="#" class="btn btn-primary btn-lg">Consult Now <em class="bi bi-chevron-right"></em></a>
        </div>
    </div>
    <section class="stats-section py-5">
        <div class="container">
            <div class="row text-center">
                <!-- Doctors Card -->
                <div class="col-sm-6 col-md-4 mb-4">
                    <div class="card bg-white shadow border-0 rounded">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary">Number of Doctors</h5>
                            <h2 class="card-text text-dark ">{{ $numberOfDoctors }}</h2> <!-- Replace with dynamic value -->
                        </div>
                    </div>
                </div>
                <!-- Departments Card -->
                <div class="col-sm-6 col-md-4 mb-4">
                    <div class="card bg-white shadow border-0 rounded">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary">Number of Departments</h5>
                            <h2 class="card-text text-dark">{{ $numberOfDepartments }}</h2> <!-- Replace with dynamic value -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
