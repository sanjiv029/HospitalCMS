<script>
    document.getElementById('department_id').addEventListener('change', function() {
        let departmentId = this.value;
        let doctorSelect = document.querySelectorAll('#doctor_id option');

        doctorSelect.forEach(option => {
            option.style.display = option.dataset.department == departmentId ? 'block' : 'none';
        });
        document.getElementById('doctor_id').value = '';
    });
</script>

