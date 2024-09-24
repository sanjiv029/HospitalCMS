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
            if (matchesDistrict && matchesMuniType) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });

        // Reset municipality selection
        document.getElementById('municipality_id').value = '';
    }
</script>
