<script>
document.getElementById('scrollLeft').addEventListener('click', function() {
    const container = document.querySelector('.doctor-container .row');
    container.scrollBy({ left: -200, behavior: 'smooth' }); // Adjust the scroll amount as needed
});

document.getElementById('scrollRight').addEventListener('click', function() {
    const container = document.querySelector('.doctor-container .row');
    container.scrollBy({ left: 200, behavior: 'smooth' }); // Adjust the scroll amount as needed
});



</script>
