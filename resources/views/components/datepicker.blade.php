<script type="text/javascript">
    window.onload = function() {
        // Ensure NepaliFunctions is loaded
        if (typeof NepaliFunctions !== "undefined") {
            console.log("NepaliFunctions loaded successfully.");
        } else {
            console.error("NepaliFunctions not available.");
            return;
        }

        // Datepicker configurations
        const datePickerConfig = (bsInput, adInput) => ({
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 20,
            dateFormat: "YYYY-MM-DD",
            disableAfter: "2081-12-30",
            onChange: function() {
                convertBSToAD(bsInput, adInput);  // Pass the current BS input element and its corresponding AD input element
            }
        });

        // Array of date fields that need the datepicker and BS to AD conversion
        const dateMappings = [
            { bsInputId: 'nepali-datepicker', adInputId: 'date_of_birth_ad' },
            { bsInputId: 'nepali-datepicker-start', adInputId: 'start_year' },
            { bsInputId: 'nepali-datepicker-end', adInputId: 'end_year' },
            { bsInputId: 'nepali-datepicker-start-exp', adInputId: 'start_date' },
            { bsInputId: 'nepali-datepicker-end-exp', adInputId: 'end_date' }
        ];

        // Initialize the Nepali Datepicker for each field and add conversion logic
        dateMappings.forEach(mapping => {
            const bsInput = document.getElementById(mapping.bsInputId);
            const adInput = document.getElementById(mapping.adInputId);

            if (bsInput && adInput) {
                // Initialize Nepali Datepicker
                bsInput.nepaliDatePicker(datePickerConfig(bsInput, adInput));

                // Add event listener for manual input (when typing BS date manually)
                bsInput.addEventListener('input', function() {
                    convertBSToAD(bsInput, adInput);  // Convert BS to AD for the corresponding fields
                });

                // Trigger conversion on page load if there's a pre-filled BS date
                convertBSToAD(bsInput, adInput);
            } else {
                console.error(`Invalid element ids: ${mapping.bsInputId} or ${mapping.adInputId}`);
            }
        });

        // Function to handle BS to AD conversion
        function convertBSToAD(bsInput, adInput) {
            const bsDate = bsInput.value;  // Get the BS date from the input
            if (bsDate) {
                // Convert the BS date to AD using NepaliFunctions
                const adDate = NepaliFunctions.BS2AD(bsDate, "YYYY-MM-DD", "YYYY-MM-DD");
                adInput.value = adDate;  // Set the AD date in the hidden field
                console.log(`Converted ${bsInput.id} to AD:`, adDate);
            } else {
                console.error("Invalid BS date or conversion failed.");
            }
        }
    };
</script>
