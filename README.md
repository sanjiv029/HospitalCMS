<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



<!-- update doesnot work , edit mah doesnot show of experience and education


 <!-- Step 3: Education Details -->
        <div class="step" id="step3" style="display:none;">
            <h5 class="text-primary"><i class="fas fa-graduation-cap"></i> Education Details</h5>
            <div class="row" id="education-fields">
                @foreach ($educations as $education)
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="degree_{{ $loop->index }}" class="text-secondary">Degree</label>
                            <select name="degree[]" id="degree_{{ $loop->index }}" class="form-control @error('degree.' . $loop->index) is-invalid @enderror" required>
                                <option value="" disabled selected>Select Degree</option>
                                <option value="MBBS" {{ old('degree.' . $loop->index, $education->degree ?? '') == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                                <option value="MD" {{ old('degree.' . $loop->index, $education->degree ?? '') == 'MD' ? 'selected' : '' }}>MD</option>
                                <option value="MS" {{ old('degree.' . $loop->index, $education->degree ?? '') == 'MS' ? 'selected' : '' }}>MS</option>
                                <option value="BDS" {{ old('degree.' . $loop->index, $education->degree ?? '') == 'BDS' ? 'selected' : '' }}>BDS</option>
                                <option value="MDS" {{ old('degree.' . $loop->index, $education->degree ?? '') == 'MDS' ? 'selected' : '' }}>MDS</option>
                                <option value="PhD" {{ old('degree.' . $loop->index, $education->degree ?? '') == 'PhD' ? 'selected' : '' }}>PhD</option>
                            </select>
                            @error('degree.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="institution_{{ $loop->index }}" class="text-secondary">Institution</label>
                            <input type="text" name="institution[]" id="institution_{{ $loop->index }}" class="form-control @error('institution.' . $loop->index) is-invalid @enderror" value="{{ old('institution.' . $loop->index, $education->institution ?? '') }}" required>
                            @error('institution.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address_{{ $loop->index }}" class="text-secondary">Address</label>
                            <input type="text" name="address[]" id="address_{{ $loop->index }}" class="form-control @error('address.' . $loop->index) is-invalid @enderror" value="{{ old('address.' . $loop->index, $education->address ?? '') }}" required>
                            @error('address.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field_of_study_{{ $loop->index }}" class="text-secondary">Field of Study</label>
                            <input type="text" name="field_of_study[]" id="field_of_study_{{ $loop->index }}" class="form-control @error('field_of_study.' . $loop->index) is-invalid @enderror" value="{{ old('field_of_study.' . $loop->index, $education->field_of_study ?? '') }}" required>
                            @error('field_of_study.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_year_{{ $loop->index }}" class="text-secondary">Start Year</label>
                            <input type="text" name="start_year[]" id="nepali-datepicker" class="form-control @error('start_year.' . $loop->index) is-invalid @enderror" value="{{ old('start_year.' . $loop->index, $education->start_year ?? '') }}" required>
                            @error('start_year.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_year_{{ $loop->index }}" class="text-secondary">End Year</label>
                            <input type="text" name="end_year[]" id="nepali-datepicker" class="form-control @error('end_year.' . $loop->index) is-invalid @enderror" value="{{ old('end_year.' . $loop->index, $education->end_year ?? '') }}">
                            @error('end_year.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edu_certificates_{{ $loop->index }}" class="text-secondary">Certification <i class="fas fa-file-upload"></i></label>
                            <input type="file" name="edu_certificates[]" id="edu_certificates_{{ $loop->index }}" class="form-control @error('edu_certificates.' . $loop->index) is-invalid @enderror" value="{{ old('edu_certificates.' . $loop->index, $education->edu_certificates ?? '') }}">
                            @error('edu_certificates.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="additional_information_{{ $loop->index }}" class="text-secondary">Additional Details</label>
                            <textarea name="additional_information[]" id="additional_information_{{ $loop->index }}" cols="5" rows="3" class="form-control @error('additional_information.' . $loop->index) is-invalid @enderror">{{ old('additional_information.' . $loop->index, $education->additional_information ?? '') }}</textarea>
                            @error('additional_information.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>
        {{--     <button type="button" class="btn btn-secondary mt-2" id="add-education">Add More Education</button> --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="javascript:void(0)" class="btn btn-outline-secondary" onclick="prevStep(3)"><i class="bi bi-arrow-left"></i> Back</a>
                <button type="button" class="btn btn-primary" onclick="nextStep(3)"><i class="bi bi-arrow-right"></i> Next</button>
            </div>
        </div>
        <!-- Step 4: Experience Details -->
        <div class="step" id="step4" style="display:none;">
            <h5 class="text-primary"><i class="fas fa-briefcase"></i> Experience Details</h5>
            <div class="row" id="experience-fields">
                @foreach ($experiences as $experience)
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type_of_employment_{{ $loop->index }}" class="text-secondary">Type of Employment</label>
                        <select name="type_of_employment[]" id="type_of_employment_{{ $loop->index }}" class="form-control @error('type_of_employment.' . $loop->index) is-invalid @enderror" required>
                            <option value="" disabled selected>Select Employment Type</option>
                            <option value="Full-time" {{ old('type_of_employment.' . $loop->index, $experience->type_of_employment ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('type_of_employment.' . $loop->index, $experience->type_of_employment ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ old('type_of_employment.' . $loop->index, $experience->type_of_employment ?? '') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Internship" {{ old('type_of_employment.' . $loop->index, $experience->type_of_employment ?? '') == 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('type_of_employment.' . $loop->index)
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="job_title_{{ $loop->index }}" class="text-secondary">Job Title</label>
                            <input type="text" name="job_title[]" id="job_title_{{ $loop->index }}" class="form-control @error('job_title.' . $loop->index) is-invalid @enderror" value="{{ old('job_title.' . $loop->index, $experience->job_title ?? '') }}" required>
                            @error('job_title.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="healthcare_facilities_{{ $loop->index }}" class="text-secondary">Healthcare Facilities</label>
                            <input type="text" name="healthcare_facilities[]" id="healthcare_facilities_{{ $loop->index }}" class="form-control @error('healthcare_facilities.' . $loop->index) is-invalid @enderror" value="{{ old('healthcare_facilities.' . $loop->index, $experience->healthcare_facilities ?? '') }}" required>
                            @error('healthcare_facilities.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location_{{ $loop->index }}" class="text-secondary">Location</label>
                            <input type="text" name="location[]" id="location_{{ $loop->index }}" class="form-control @error('location.' . $loop->index) is-invalid @enderror" value="{{ old('location.' . $loop->index, $experience->location ?? '') }}" required>
                            @error('location.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date_{{ $loop->index }}" class="text-secondary">Start Date</label>
                            <input type="date" name="start_date[]" id="start_date_{{ $loop->index }}" class="form-control @error('start_date.' . $loop->index) is-invalid @enderror" value="{{ old('start_date.' . $loop->index, $experience->start_date ?? '') }}" required>
                            @error('start_date.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date_{{ $loop->index }}" class="text-secondary">End Date</label>
                            <input type="date" name="end_date[]" id="end_date_{{ $loop->index }}" class="form-control @error('end_date.' . $loop->index) is-invalid @enderror" value="{{ old('end_date.' . $loop->index, $experience->end_date ?? '') }}">
                            @error('end_date.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exp_certificates_{{ $loop->index }}" class="text-secondary">Experience Certificates <i class="fas fa-file-upload"></i></label>
                            <input type="file" name="exp_certificates[]" id="exp_certificates_{{ $loop->index }}" class="form-control @error('exp_certificates.' . $loop->index) is-invalid @enderror" value="{{ old('exp_certificates.' . $loop->index, $experience->exp_certificates ?? '') }}">
                            @error('exp_certificates.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="additional_details_{{ $loop->index }}" class="text-secondary">Additional Details</label>
                            <textarea name="additional_details[]" id="additional_details_{{ $loop->index }}" cols="5" rows="3" class="form-control @error('additional_details.' . $loop->index) is-invalid @enderror">{{ old('additional_details.' . $loop->index, $experience->additional_details ?? '') }}</textarea>
                            @error('additional_details.' . $loop->index)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>
