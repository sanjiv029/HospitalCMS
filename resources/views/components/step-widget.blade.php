<script type="text/javascript">
   let currentStep = 1;

function showStep(step) {
    // Hide all steps
    const steps = document.querySelectorAll('.step');
    steps.forEach((el) => el.style.display = 'none');

    // Show the current step
    document.getElementById(`step${step}`).style.display = 'block';
}

function nextStep(step) {
    if (validateStep(step)) {
        document.getElementById('step' + step).style.display = 'none';
        currentStep = step + 1;
        document.getElementById('step' + currentStep).style.display = 'block';
    }
}

function prevStep(step) {
    document.getElementById('step' + step).style.display = 'none';
    currentStep = step - 1;
    document.getElementById('step' + currentStep).style.display = 'block';
}

function validateStep(step) {
    let isValid = true;

    // Clear previous errors
    let errorElements = document.querySelectorAll('.invalid-feedback');
    errorElements.forEach((element) => element.remove());

    // Validate fields in the current step
    switch (step) {
        case 1: // Basic Information
            isValid = validateBasicInformation();
            break;
        case 2: // Address Information
            isValid = validateAddressInformation();
            break;
        case 5: // Login Credentials
            isValid = validateCredentials();
            break;
        default:
            isValid = true; // Other steps can be left out for now
    }

    return isValid;
}

function validateBasicInformation() {
    let isValid = true;
    const name = document.getElementById('name');
    const phone = document.getElementById('phone');
    const department = document.getElementById('department_id');

    if (name.value.trim() === '') {
        showError(name, 'Name is required.');
        isValid = false;
    }

    if (phone.value.trim() === '') {
        showError(phone, 'Phone is required.');
        isValid = false;
    } else if (!/^\d{10}$/.test(phone.value.trim())) {
        showError(phone, 'Phone number must be 10 digits.');
        isValid = false;
    }

    if (department.value.trim() === '') {
        showError(department, 'Department is required.');
        isValid = false;
    }

    return isValid;
}

function validateAddressInformation() {
    let isValid = true;
    const province = document.getElementById('province_id');
    const district = document.getElementById('district_id');
    const muniType = document.getElementById('muni_type_id');
    const municipality = document.getElementById('municipality_id');

    if (province.value.trim() === '') {
        showError(province, 'Province is required.');
        isValid = false;
    }

    if (district.value.trim() === '') {
        showError(district, 'District is required.');
        isValid = false;
    }

    if (muniType.value.trim() === '') {
        showError(muniType, 'Municipality type is required.');
        isValid = false;
    }

    if (municipality.value.trim() === '') {
        showError(municipality, 'Municipality is required.');
        isValid = false;
    }

    return isValid;
}

function validateCredentials() {
    let isValid = true;
    const email = document.getElementById('email');
    const password = document.getElementById('passwordInput');
    const confirmPassword = document.getElementById('confirmPasswordInput');

    if (email.value.trim() === '') {
        showError(email, 'Email is required.');
        isValid = false;
    } else if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email.value.trim())) {
        showError(email, 'Please enter a valid email.');
        isValid = false;
    }

    if (password && password.value.trim() === '') {
        showError(password, 'Password is required.');
        isValid = false;
    }

    if (password && confirmPassword.value.trim() !== password.value.trim()) {
        showError(confirmPassword, 'Passwords do not match.');
        isValid = false;
    }

    return isValid;
}

function showError(element, message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    errorDiv.innerText = message;
    element.parentElement.appendChild(errorDiv);
    element.classList.add('is-invalid');
}
// Initialize the form to show the first step
showStep(currentStep);

</script>
