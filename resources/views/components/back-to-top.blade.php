<!-- Back to Top JavaScript -->
<script>
    // Show the back to top button only when scrolled down
    window.onscroll = function() {
        const backToTopBtn = document.getElementById('backToTop');
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            backToTopBtn.style.display = "block";
        } else {
            backToTopBtn.style.display = "none";
        }
    };

    // Scroll to the top when the button is clicked
    document.getElementById('backToTop').onclick = function() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    };
</script>
