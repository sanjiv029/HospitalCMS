  <!-- Alert for appointment confirmation -->
  @if(session('success'))
  <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
  </div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> <!-- Make sure you're using the correct Bootstrap version -->

<script>
    $(document).ready(function() {
        console.log('Document is ready');

        // Auto-dismiss alert after 5 seconds
        setTimeout(function() {
            var alert = new bootstrap.Alert(document.getElementById('successAlert'));
            alert.close();
        }, 10000);
    });
</script>
