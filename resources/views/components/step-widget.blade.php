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

    function validateField(fieldElement, validateFunc, errorMessage) {
        if (!fieldElement) {
            console.error(`Field element not found: ${fieldElement.id}`);
            return false; // Skip validation if the field does not exist
        }
        const isValid = validateFunc(fieldElement.value);
        if (!isValid) {
            fieldElement.classList.add('is-invalid');
            showError(fieldElement, errorMessage);
        } else {
            clearError(fieldElement);
        }
        return isValid;
    }

    function clearError(fieldElement) {
        if (fieldElement && fieldElement.parentElement) {
            const errorDiv = fieldElement.parentElement.querySelector('.invalid-feedback');
            if (errorDiv) {
                errorDiv.textContent = ''; // Clear the error message
                errorDiv.style.display = 'none'; // Hide the error message
            }
            fieldElement.classList.remove('is-invalid'); // Remove invalid class
        } else {
            console.error(`Cannot clear error: Field element is null or has no parentElement`);
        }
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
        { field: 'date_of_birth_ad', msg: 'Date of Birth (BS) is required.', func: (value) => value !== '' && new Date(value) < new Date() },
        { field: 'date_of_birth_bs', msg: 'Date of Birth (BS) is required.', func: (value) => value !== '' },
        { field: 'gender', msg: 'Gender is required.', func: (value) => value !== '' },
        { field: 'marital_status', msg: 'Marital status is required.', func: (value) => value !== '' }
    ];
    return validateFields(validations);
    }


    function validateAddressInformation() {
        const validations = [
            { field: 'province_id', msg: 'Province is required.', func: (value) => value !== '' },
            { field: 'district_id', msg: 'District is required.', func: (value) => value !== '' },
            { field: 'muni_type_id', msg: 'Municipality type is required.', func: (value) => value !== '' },
            { field: 'municipality_id', msg: 'Municipality is required.', func: (value) => value !== '' },
            // Temporary Address Fields
            { field: 'temporary_province_id', msg: 'Temporary province is required.', func: (value) => value !== '' },
            { field: 'temporary_district_id', msg: 'Temporary district is required.', func: (value) => value !== '' },
            { field: 'temporary_municipality_type_id', msg: 'Temporary municipality type is required.', func: (value) => value !== '' },
            { field: 'temporary_municipality_id', msg: 'Temporary municipality is required.', func: (value) => value !== '' }
        ];
        return validateFields(validations);
    }

    function validateEducationInformation() {
        const validations = [];
        const educationCount = document.querySelectorAll('[name="degree[]"]').length;

        for (let i = 0; i < educationCount; i++) {
            validations.push(
                { field:`degree_${i}`, msg: 'Degree field is required.', func: (value) => value !== '' },
                { field: `institution_${i}`, msg: 'Institution field is required.', func: (value) => value !== '' },
                { field: `address_${i}`, msg: 'Address is required.', func: (value) => value !== '' },
                { field: `field_of_study_${i}`, msg: 'Field of study is required.', func: (value) => value !== '' },
                { field: `start_year_bs_${i}`, msg: 'Start year (BS) is required.', func: (value) => value !== '' },
                { field: `start_year_ad_${i}`, msg: 'Start year (AD) is required.', func: (value) => value !== '' },
                { field: `end_year_bs_${i}`, msg: 'End year (BS) must be after start year (BS).', func: (value) => validateEndDateOrYear(`end_year_bs_${i}`, `start_year_bs_${i}`) },
                { field: `end_year_ad_${i}`, msg: 'End year must be after start year.', func: (value) => validateEndDateOrYear(`end_year_ad_${i}`, `start_year_ad_${i}`) },
                { field: `edu_certificates_${i}`, msg: 'Invalid education certificate.', func: validateFile },
                { field: `additional_information_${i}`, msg: 'Additional details must not exceed 255 characters.', func: (value) => value.length <= 255 }
            );
        }

        return validateFields(validations);
    }

    function validateExperienceInformation() {
        const validations = [];
        const experienceCount = document.querySelectorAll('[name="job_title[]"]').length;

        for (let i = 0; i < experienceCount; i++) {
            validations.push(
                { field: `job_title_${i}`, msg: 'Job title is required.', func: (value) => value !== '' },
                { field: `healthcare_facilities_${i}`, msg: 'Healthcare facility field is required.', func: (value) => value !== '' },
                { field: `location_${i}`, msg: 'Location is required.', func: (value) => value !== '' },
                { field: `type_of_employment_${i}`, msg: 'Employment type is required.', func: (value) => value !== '' },
                { field: `start_date_bs_${i}`, msg: 'Start date (BS) is required.', func: (value) => value !== '' },
                { field: `end_date_bs_${i}`, msg: 'End date (BS) must be after start date (BS).', func: (value) => validateEndDateOrYear(`end_date_bs_${i}`, `start_date_bs_${i}`) },
                { field: `start_date_ad_${i}`, msg: 'Start date (AD) is required.', func: (value) => value !== '' },
                { field: `end_date_ad_${i}`, msg: 'End date (AD) must be after start date (AD) .', func: (value) => validateEndDateOrYear(`end_date_ad_${i}`, `start_date_ad_${i}`) },
                { field: `exp_certificates_${i}`, msg: 'Invalid experience certificate.', func: validateFile },
                { field: `additional_details_${i}`, msg: 'Job description is required.', func: (value) => value !== '' }
            );
        }

        return validateFields(validations);
    }

    function validateFields(validations) {
        return validations.every(({ field, msg, func }) => {
            const fieldElement = document.getElementById(field);
            console.log(`Validating field: ${field}`); // Log the field being validated

            if (!fieldElement) {
                console.error(`Field element not found: ${field}`);
                return false; // Skip validation if the field does not exist
            }

            const validationFunc = func || ((value) => value !== '');
            if (!validateField(fieldElement, validationFunc, msg)) {
                console.error(`Validation failed for field: ${field}, message: ${msg}`);
                return false;
            }
            return true;
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
        const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png','image/jpg'];
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
