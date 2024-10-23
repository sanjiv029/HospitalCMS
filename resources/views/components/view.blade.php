<script>
document.addEventListener("DOMContentLoaded", function() {
    const viewAllBtn = document.getElementById('viewAllBtn');
    const backBtn = document.getElementById('backBtn');
    const doctorCarousel = document.getElementById('doctorCarousel');
    const expandedDoctorList = document.getElementById('expandedDoctorList');

    // Show all doctors when 'View All' is clicked
    viewAllBtn.addEventListener('click', function() {
        doctorCarousel.classList.add('d-none'); // Hide carousel
        expandedDoctorList.classList.remove('d-none'); // Show expanded list
        viewAllBtn.classList.add('d-none'); // Hide 'View All' button
        backBtn.classList.remove('d-none'); // Show 'Back' button
    });

    // Go back to carousel view when 'Back' is clicked
    backBtn.addEventListener('click', function() {
        doctorCarousel.classList.remove('d-none'); // Show carousel
        expandedDoctorList.classList.add('d-none'); // Hide expanded list
        viewAllBtn.classList.remove('d-none'); // Show 'View All' button
        backBtn.classList.add('d-none'); // Hide 'Back' button
    });
});
</script>
