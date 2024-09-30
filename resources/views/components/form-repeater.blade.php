<script>
document.addEventListener('DOMContentLoaded', function () {
    let educationCount = 1;
    let experienceCount = 1;

    document.getElementById('add-education').addEventListener('click', function () {
        const educationFields = document.getElementById('education-fields');
        const newEducationItem = document.createElement('div');
        newEducationItem.classList.add('col-md-12', 'education-item');
        newEducationItem.innerHTML = `
        <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="degree" class="text-secondary">Degree</label>
                            <select name="degree[]" id="degree" class="form-control @error('degree') is-invalid @enderror" required>
                            <option value="" disabled selected>Select Degree</option>
                            <option value="MBBS" {{ old('degree.0', $doctor->education[0]->degree ?? '') == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                            <option value="MD" {{ old('degree.0', $doctor->education[0]->degree ?? '') == 'MD' ? 'selected' : '' }}>MD</option>
                            <option value="MS" {{ old('degree.0', $doctor->education[0]->degree ?? '') == 'MS' ? 'selected' : '' }}>MS</option>
                            <option value="BDS" {{ old('degree.0', $doctor->education[0]->degree ?? '') == 'BDS' ? 'selected' : '' }}>BDS</option>
                            <option value="MDS" {{ old('degree.0', $doctor->education[0]->degree ?? '') == 'MDS' ? 'selected' : '' }}>MDS</option>
                            <option value="PhD" {{ old('degree.0', $doctor->education[0]->degree ?? '') == 'PhD' ? 'selected' : '' }}>PhD</option>
                            </select>
                            @error('degree.0')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="institution" class="text-secondary">Institution</label>
                            <input type="text" name="institution[]" id="institution" class="form-control @error('institution') is-invalid @enderror" value="{{ old('institution.0', $doctor->education[0]->institution ?? '') }}" required>
                            @error('institution.0')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                     <div class="col-md-6">
                         <div class="form-group">
                            <label for="address" class="text-secondary">Address</label>
                            <input type="text" name="address[]" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address.0', $doctor->education[0]->address ?? '') }}" required>
                            @error('address.0')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                     </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field_of_study" class="text-secondary">Field of Study</label>
                            <input type="text" name="field_of_study[]" id="field_of_study" class="form-control @error('field_of_study') is-invalid @enderror" value="{{ old('field_of_study.0', $doctor->education[0]->field_of_study ?? '') }}" required>
                            @error('field_of_study.0')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_year_bs" class="text-secondary">Start Date (BS)</label>
                            <input type="text" name="start_year_bs[]" id="start_year_bs"  class="form-control nepali-datepicker @error('start_year_bs') is-invalid @enderror" value="{{ old('start_year_bs.0', $doctor->education[0]->start_year_bs ?? '') }}" placeholder="YYYY-MM-DD">
                            <input type="hidden" name="start_year[]" id="start_year" class="form-control ad-date" value="{{ old('start_year.0', $doctor->education[0]->start_year ?? '') }}" required>
                            @error('start_year_bs.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                            @error('start_year.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_year_bs" class="text-secondary">End Date (BS)</label>
                            <input type="text" name="end_year_bs[]" id="end_year_bs"  class="form-control nepali-datepicker @error('end_year_bs') is-invalid @enderror" value="{{ old('end_year_bs.0', $doctor->education[0]->end_year_bs ?? '') }}" placeholder="YYYY-MM-DD">
                            <input type="hidden" name="end_year[]" id="end_year" class="form-control ad-date" value="{{ old('end_year.0', $doctor->education[0]->end_year ?? '') }}">
                            @error('end_year_bs.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                            @error('end_year.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edu_certificates" class="text-secondary">Certification <i class="fas fa-file-upload"></i></label>
                            <input type="file" name="edu_certificates[]" id="edu_certificates" class="form-control @error('edu_certificates') is-invalid @enderror" value="{{ old('edu_certificates.0', $doctor->education[0]->edu_certificates ?? '') }}">
                            @error('edu_certificates.0')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="additional_information" class="text-secondary">Additional Details</label>
                            <textarea name="additional_information[]" id="additional_information" cols="5" rows="3" class="form-control @error('additional_information') is-invalid @enderror">{{ old('additional_information.0', $doctor->education[0]->additional_information ?? '') }}</textarea>
                            @error('additional_information.0')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 text-end">
                         <button type="button" class="btn btn-danger remove-education">Remove</button>
                    </div>
             </div>
        `;
        educationFields.appendChild(newEducationItem);
        educationCount++;
    });

    document.getElementById('education-fields').addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-education')) {
            event.target.closest('.education-item').remove();
        }
    });

    document.getElementById('add-experience').addEventListener('click', function () {
        const experienceFields = document.getElementById('experience-fields');
        const newExperienceItem = document.createElement('div');
        newExperienceItem.classList.add('col-md-12', 'experience-item');
        newExperienceItem.innerHTML = `
           <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type_of_employment" class="text-secondary">Type of Employment</label>
                        <select name="type_of_employment[]" id="type_of_employment" class="form-control @error('type_of_employment') is-invalid @enderror" required>
                        <option value="" disabled selected>Select Employment Type</option>
                        <option value="Full-time" {{ old('type_of_employment.0', $doctor->experience[0]->type_of_employment ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ old('type_of_employment.0', $doctor->experience[0]->type_of_employment ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Contract" {{ old('type_of_employment.0', $doctor->experience[0]->type_of_employment ?? '') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Internship" {{ old('type_of_employment.0', $doctor->experience[0]->type_of_employment ?? '') == 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('type_of_employment.0')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="job_title" class="text-secondary">Job Title</label>
                        <input type="text" name="job_title[]" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title.0', $doctor->experience[0]->job_title ?? '') }}" required>
                        @error('job_title.0')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="healthcare_facilities" class="text-secondary">Healthcare Facility</label>
                        <input type="text" name="healthcare_facilities[]" id="healthcare_facilities" class="form-control @error('healthcare_facilities') is-invalid @enderror" value="{{ old('healthcare_facilities.0', $doctor->experience[0]->healthcare_facilities ?? '') }}" required>
                        @error('healthcare_facilities.0')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="location" class="text-secondary">Location</label>
                        <input type="text" name="location[]" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location.0', $doctor->experience[0]->location ?? '') }}" required>
                        @error('location.0')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_date_bs" class="text-secondary">Start Date (BS)</label>
                        <input type="text" name="start_date_bs[]" id="start_date_bs" class="form-control nepali-datepicker @error('start_date_bs') is-invalid @enderror" value="{{ old('start_date_bs.0', $doctor->experience[0]->start_date_bs ?? '') }}" placeholder="YYYY-MM-DD">
                        <input type="hidden" name="start_date[]" id="start_date" class="form-control ad-date" value="{{ old('start_date.0', $doctor->experience[0]->start_date ?? '') }}" required>
                        @error('start_date_bs.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                        @error('start_date.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="end_date_bs" class="text-secondary">End Date (BS)</label>
                        <input type="text" name="end_date_bs[]" id="end_date_bs"  class="form-control nepali-datepicker @error('end_date_bs') is-invalid @enderror" value="{{ old('end_date_bs.0', $doctor->experience[0]->end_date_bs ?? '') }}" placeholder="YYYY-MM-DD">
                        <input type="hidden" name="end_date[]" id="end_date" class="form-control ad-date" value="{{ old('end_date.0', $doctor->experience[0]->end_date ?? '') }}">
                        @error('end_date_bs.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                        @error('end_date.0') <span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exp_certificates" class="text-secondary">Certification <i class="fas fa-file-upload"></i></label>
                        <input type="file" name="exp_certificates[]" id="exp_certificates" class="form-control @error('exp_certificates') is-invalid @enderror" value="{{ old('exp_certificates.0', $doctor->experience[0]->exp_certificates ?? '') }}">
                        @error('exp_certificates.0')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="additional_details" class="text-secondary">Additional Details</label>
                        <textarea name="additional_details[]" id="additional_details" cols="5" rows="3" class="form-control @error('additional_details') is-invalid @enderror">{{ old('additional_details.0', $doctor->experience[0]->additional_details ?? '') }}</textarea>
                        @error('additional_details.0')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 text-end">
                    <button type="button" class="btn btn-danger remove-experience">Remove</button>
                 </div>
        </div>
         `;
        experienceFields.appendChild(newExperienceItem);
        experienceCount++;
    });

    document.getElementById('experience-fields').addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-experience')) {
            event.target.closest('.experience-item').remove();
        }
    });
});
</script>

