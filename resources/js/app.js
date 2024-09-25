import './bootstrap';
import 'laravel-datatables-vite';


$(document).ready(function() {
    $('#department_id').select2({
        placeholder: 'Select a Department',
        allowClear: true
    });
});

// Hide the success message after 3 seconds
setTimeout(function() {
    var message = document.getElementById('success-message');
    if (message) {
        message.style.display = 'none';
    }
}, 5000);
// Fetch doctors for a department when the doctor count link is clicked
$(document).on('click', '.doctor-count', function () {
    var departmentId = $(this).data('id');

    // Fetch the doctors for the department
    $.ajax({
        url: '/admin/departments/' + departmentId + '/admin/doctors',
        type: 'GET',
        success: function (data) {
            // You can now display the doctors in a modal, separate DataTable, or any other UI component
            console.log(data); // Handle displaying the data as needed
        },
        error: function () {
            alert('Error retrieving doctors.');
        }
    });
});
