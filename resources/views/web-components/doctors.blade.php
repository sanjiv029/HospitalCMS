<div class="doctor-container position-relative" id="doctors" style="bottom: 0; left: 0; right: 0; background-color: #f8f9fa; border-top: 2px solid #dcdcdc; padding: 20px;">
    <div class="title mt-5 mb-5 text-center">
        <h2>Book Appointments with Top Doctors</h2>
        <p>200+ experienced medical practitioners available for video consultation and appointment</p>
        <a href="{{route('doctor')}}" class="btn btn-primary position-absolute" style="top: 100px; right: 100px; transform: translate(50%, -50%);">View All</a>
    </div>
    <button class="btn btn-secondary position-absolute left-arrow" id="scrollLeft">&lt;</button>
    <div class="row overflow-auto bg-light mt-4 ml-5 mr-5">
        @foreach($doctors as $doctor)
            <div class="col-6 col-md-4 col-lg-3 mb-4 mt-4">
                <div class="card h-100 shadow border-0">
                    <div class="profile-image mb-2 mt-4 text-center">
                        <img src="{{ $doctor->profile_image }}" alt="{{ $doctor->name }}'s Profile Image" class="img-fluid border" style="max-width: 150px;">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Dr. {{ $doctor->name }}</h5>
                        <p class="card-text">Department: {{ $doctor->department->name }}</p>
                        <!-- Use a form to pass both doctor_id and department_id -->
                        <form action="{{ route('appointments.time.slots.select') }}" method="POST">
                            @csrf
                            <input type="hidden" name="department_id" value="{{ $doctor->department->id }}">
                            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                            <button type="submit" class="btn btn-primary">Book Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button class="btn btn-secondary position-absolute right-arrow" id="scrollRight">&gt;</button>
</div>
