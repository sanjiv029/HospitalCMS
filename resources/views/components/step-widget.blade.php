<script type="text/javascript">
    let currentStep = 1;

    function showStep(step) {
        document.querySelectorAll('.step').forEach((el) => el.style.display = 'none');
        document.getElementById(`step${step}`).style.display = 'block';
    }

    function nextStep(step) {
        if (validateStep(step)) {
            document.getElementById('step' + step).style.display = 'none';
            showStep(step + 1);
        }
    }

    function prevStep(step) {
        showStep(step - 1);
    }

    function validateStep(step) {
        const validators = [
            validateBasicInformation,
            validateAddressInformation,
            validateEducationInformation,
            validateExperienceInformation,
            validateCredentials
        ];
        return validators[step - 1]();
    }

    function validateField(field, validationFunc, errorMsg) {
        clearError(field); // Clear previous errors
        if (!validationFunc(field.value.trim())) {
            showError(field, errorMsg);
            return false;
        }
        return true;
    }

    function clearError(element) {
        const errorDiv = element.parentElement.querySelector('.invalid-feedback');
        if (errorDiv) {
            errorDiv.remove();
        }
        element.classList.remove('is-invalid');
    }

    function showError(element, message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.innerText = message;
        element.parentElement.appendChild(errorDiv);
        element.classList.add('is-invalid');
    }

    function validateBasicInformation() {
        const validations = [
            { field: 'name', msg: 'Name is required.', func: (value) => value !== '' },
            { field: 'phone', msg: 'A valid phone number is required.', func: (value) => /^(98|97|96)\d{8}$|^(01)\d{6,8}$/.test(value) },
            { field: 'department_id', msg: 'Department is required.', func: (value) => value !== '' },
            { field: 'date_of_birth_ad', msg: 'Date of Birth is required.', func: (value) => value !== '' && new Date(value) < new Date() }
        ];
        return validateFields(validations);
    }

    function validateAddressInformation() {
        const validations = [
            { field: 'province_id', msg: 'Province is required.' },
            { field: 'district_id', msg: 'District is required.' },
            { field: 'muni_type_id', msg: 'Municipality type is required.' },
            { field: 'municipality_id', msg: 'Municipality is required.' },

             // Temporary Address Fields
        { field: 'temporary_province_id', msg: 'Temporary province is required.' },
        { field: 'temporary_district_id', msg: 'Temporary district is required.' },
        { field: 'temporary_municipality_type_id', msg: 'Temporary municipality type is required.' },
        { field: 'temporary_municipality_id', msg: 'Temporary municipality is required.' }
         ];
    return validations.every(({ field, msg }) => validateField(document.getElementById(field), (value) => value !== '', msg));

    }

    function validateEducationInformation() {
        const validations = [
            { field: 'degree', msg: 'Degree field is required.', func: (value) => value !== '' && value.length <= 255 },
            { field: 'institution', msg: 'Institution field is required.', func: (value) => value !== '' && value.length <= 255 },
            { field: 'address', msg: 'Address is required.', func: (value) => value !== '' && value.length <= 255 },
            { field: 'field_of_study', msg: 'Field of study is required.', func: (value) => value !== '' && value.length <= 255 },
            { field: 'start_year', msg: 'Start year is required.', func: (value) => value !== '' },
            { field: 'end_year', msg: 'End year must be after start year.', func: (value) => validateEndDateOrYear('end_year', 'start_year') },
            { field: 'edu_certificates', msg: 'Invalid education certificate.', func: validateFile },
            { field: 'additional_information', msg: 'Additional details must not exceed 255 characters.', func: (value) => value.length <= 255 }
        ];
        return validateFields(validations);
    }

    function validateExperienceInformation() {
        const validations = [
            { field: 'job_title', msg: 'Job title is required.', func: (value) => value !== '' && value.length <= 255 },
            { field: 'healthcare_facilities', msg: 'Healthcare facility field is required.', func: (value) => value !== '' && value.length <= 255 },
            { field: 'location', msg: 'Location is required.', func: (value) => value !== '' && value.length <= 255 },
            { field: 'type_of_employment', msg: 'Employment type is required.', func: (value) => value !== '' },
            { field: 'start_date', msg: 'Start date is required.', func: (value) => value !== '' },
            { field: 'end_date', msg: 'End date must be after start date.', func: (value) => validateEndDateOrYear('end_date', 'start_date') },
            { field: 'exp_certificates', msg: 'Invalid experience certificate.', func: validateFile },
            { field: 'additional_details', msg: 'Additional details must not exceed 255 characters.', func: (value) => value.length <= 255 }
        ];
        return validateFields(validations);
    }

    function validateFields(validations) {
        return validations.every(({ field, msg, func }) => {
            const fieldElement = document.getElementById(field);
            const validationFunc = func || ((value) => value !== '');
            return validateField(fieldElement, validationFunc, msg);
        });
    }


    function validateEndDateOrYear(endInputId, startInputId) {
    const endElement = document.getElementById(endInputId);
    const startElement = document.getElementById(startInputId);

    console.log(`Start Element ID: ${startInputId}, Start Element:`, startElement);
    console.log(`End Element ID: ${endInputId}, End Element:`, endElement);

    if (!startElement) {
        console.error(`Element with ID '${startInputId}' not found.`);
        return false;
    }
    if (!endElement) {
        console.error(`Element with ID '${endInputId}' not found.`);
        return false;
    }
    const endValue = endElement.value.trim();
    const startValue = startElement.value.trim();
    return endValue === '' || (new Date(endValue) >= new Date(startValue));
    }

    function validateFile(fileInput) {

    if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
        return true;
    }
    const file = fileInput.files[0];
    const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    return allowedTypes.includes(file.type) && file.size <= 2048000;
    }
    function validateCredentials() {
        const email = document.getElementById('email');
        const password = document.getElementById('passwordInput');
        const confirmPassword = document.getElementById('confirmPasswordInput');

        const validations = [
            { field: email, msg: 'Email is required.', func: (value) => value !== '' },
            { field: password, msg: 'Password is required.', func: (value) => value.length >= 8 },
            { field: confirmPassword, msg: 'Passwords do not match.', func: (value) => value === password.value }
        ];
        return validateFields(validations);
    }

    showStep(currentStep);
</script>
