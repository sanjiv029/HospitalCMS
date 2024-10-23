
<div class="department-container position-relative" id="departments">
    <div class="title mt-5 mb-5 text-center">
        <h3 class="title mb-4">Departments</h3>
        <h4 class="title text-secondary mb-4">Our Medical Services</h4>
        <a href="" class="btn btn-primary position-absolute" style="top: 100px; right: 100px; transform: translate(50%, -50%);">View All</a>
    <div class="row overflow-auto bg-light mt-4 ml-5 mr-5">
        @foreach ($departments as $department)
        <div class="col-6 col-md-4 col-lg-3 mb-4 mt-4">
            <div class="card h-100 shadow border-0">
                <div class="card-body p-0 mt-4 mb-4">
                    <a href="departments.html" class="title text-dark h5">{{$department->name}}</a>
                    <p class="text-muted mt-3">There is an abundance of readable dummy texts required purely to fill space.</p>
                    <p class="text-dark">Number of Doctors: {{ $department->doctor()->count() }}</p>
                    <a href="departments.html" class="link">Read More <i class="ri-arrow-right-line align-middle"></i></a>
                </div>
            </div>
        </div>
        @endforeach
</div>

