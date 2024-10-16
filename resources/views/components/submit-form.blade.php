{{-- <script>
 // Example function to gather data and submit form
function submitForm() {
    const educationData = []; // Array to hold education data
    const experienceData = []; // Array to hold experience data

    // Collect data from education repeaters
    document.querySelectorAll('.education-item').forEach(item => {
        const endYear = item.querySelector('.end-year').value; // Replace with your actual selector
        const endDate = item.querySelector('.end-date').value; // Replace with your actual selector

        // Ensure you also collect other necessary fields
        const data = {
            endYear: endYear,
            endDate: endDate,
            // Add other fields as necessary
        };
        educationData.push(data);
    });

    // Collect data from experience repeaters
    document.querySelectorAll('.experience-item').forEach(item => {
        const endYear = item.querySelector('.end-year').value; // Replace with your actual selector
        const endDate = item.querySelector('.end-date').value; // Replace with your actual selector

        // Ensure you also collect other necessary fields
        const data = {
            endYear: endYear,
            endDate: endDate,
            // Add other fields as necessary
        };
        experienceData.push(data);
    });

    // Prepare data to send to the server
    const payload = {
        education: educationData,
        experience: experienceData,
    };

    // Send the data to the server (example using fetch)
    fetch('admin/doctor', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

// Attach submitForm to your form submission event
document.getElementById('doctorForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    submitForm(); // Call your custom submit function
});

</script>
 --}}
