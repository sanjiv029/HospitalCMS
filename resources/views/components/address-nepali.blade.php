<script>
    // Filter districts based on selected province
    document.getElementById('province_id').addEventListener('change', function() {
        let provinceId = this.value;

        // Show or hide districts based on selected province
        let districtOptions = document.querySelectorAll('.district-option');
        districtOptions.forEach(option => {
            option.style.display = option.dataset.province == provinceId ? 'block' : 'none';
        });

        // Reset district and municipality selections
        document.getElementById('district_id').value = '';
        document.getElementById('municipality_id').value = '';
        document.getElementById('muni_type_id').value = '';

        // Hide all municipalities initially
        filterMunicipalities('', '');
    });

    // Filter municipalities based on selected district
    document.getElementById('district_id').addEventListener('change', function() {
        let districtId = this.value;
        let muniTypeId = document.getElementById('muni_type_id').value;

        // Show or hide municipalities based on selected district
        filterMunicipalities(districtId, muniTypeId);
    });

    // Filter municipalities based on selected municipality type
    document.getElementById('muni_type_id').addEventListener('change', function() {
        let muniTypeId = this.value;
        let districtId = document.getElementById('district_id').value;

        // Show or hide municipalities based on selected district and municipality type
        filterMunicipalities(districtId, muniTypeId);
    });

    // Function to filter municipalities
    function filterMunicipalities(districtId, muniTypeId) {
        let municipalityOptions = document.querySelectorAll('.muni-option');
        municipalityOptions.forEach(option => {
            let matchesDistrict = option.dataset.district == districtId;
            let matchesMuniType = muniTypeId === '' || option.dataset.muniType == muniTypeId;

            // Show municipality if it matches both district and (optionally) muniType
            option.style.display = (matchesDistrict && matchesMuniType) ? 'block' : 'none';
        });

        // Reset municipality selection
        document.getElementById('municipality_id').value = '';
    }

    // Copy permanent address to temporary address
    function copyAddress() {
        const isChecked = document.getElementById('same_as_permanent').checked;
        if (isChecked) {
            // Copy values from permanent to temporary address fields
            document.getElementById('temporary_province_id').value = document.getElementById('province_id').value;
            document.getElementById('temporary_district_id').value = document.getElementById('district_id').value;
            document.getElementById('temporary_municipality_type_id').value = document.getElementById('muni_type_id').value;
            document.getElementById('temporary_municipality_id').value = document.getElementById('municipality_id').value;
        } else {
            // Reset the temporary address fields if unchecked
            document.getElementById('temporary_province_id').value = '';
            document.getElementById('temporary_district_id').value = '';
            document.getElementById('temporary_municipality_type_id').value = '';
            document.getElementById('temporary_municipality_id').value = '';
        }
    }

    // Ensure municipality is hidden when the district or municipality type changes
    document.addEventListener('DOMContentLoaded', function() {
        filterMunicipalities(document.getElementById('district_id').value, document.getElementById('muni_type_id').value);
    });
</script>
