<script>
    function toggleTimeInputs(dayId) {
        const timeInputs = document.getElementById('time_inputs_' + dayId);
        const checkbox = document.getElementById('day_' + dayId);
        console.log('Checkbox clicked for day ID:', dayId); // Debugging log
        console.log('Checkbox checked status:', checkbox.checked); // Debugging log

        if (checkbox.checked) {
            timeInputs.style.display = 'flex'; // Show time inputs when checkbox is checked
        } else {
            timeInputs.style.display = 'none';  // Hide time inputs when checkbox is unchecked
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        @foreach ($days as $day)
            if (document.getElementById('day_{{ $day->id }}').checked) {
                toggleTimeInputs({{ $day->id }}); // Pre-check and show the time inputs if checkbox is selected
            }
        @endforeach
    });
</script>

