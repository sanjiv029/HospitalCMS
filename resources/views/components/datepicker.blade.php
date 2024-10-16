 <script type="text/javascript">
    window.onload = function() {
        // Ensure NepaliFunctions is loaded
        if (typeof NepaliFunctions !== "undefined") {
            console.log("NepaliFunctions loaded successfully.");
        } else {
            console.error("NepaliFunctions not available.");
            return;
        }

        // Datepicker configurations for an input element
        const datePickerConfig = (bsInput, adInput) => ({
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 20,
            dateFormat: "YYYY-MM-DD",
            disableAfter: "2081-12-30",
            onChange: function() {
                convertBSToAD(bsInput, adInput);
            }
        });

          // Function to handle BS to AD conversion
        function convertBSToAD(bsInput, adInput) {
            const bsDate = bsInput.value;
            if (bsDate) {
                const adDate = NepaliFunctions.BS2AD(bsDate, "YYYY-MM-DD", "YYYY-MM-DD");
                adInput.value = adDate;
                console.log(`Converted ${bsInput.id} (BS) to AD: ${adDate}`);
            } else {
                adInput.value = ''; // Clear AD input if BS input is empty
            }
        }

        // Initialize the Nepali Datepicker for all fields with the class 'nepali-datepicker'
        function initializeDatePicker() {
            document.querySelectorAll('.nepali-datepicker').forEach(function(bsInput) {
                const adInput = bsInput.closest('.form-group').querySelector('.ad-date');

                if (bsInput && adInput) {
                    if (!bsInput.classList.contains('nepali-datepicker-initialized')) {
                        $(bsInput).nepaliDatePicker(datePickerConfig(bsInput, adInput));
                        bsInput.classList.add('nepali-datepicker-initialized');
                        bsInput.addEventListener('input', function() {
                                convertBSToAD(bsInput, adInput);
                        });
                        convertBSToAD(bsInput, adInput);
                    }
                } else {
                    console.error("Invalid BS or AD input element in repeater.");
                }
            });
        }

        /* // Re-run initialization after a new repeater row is added
        document.addEventListener('click', function(event) {
            if (event.target && event.target.matches('.add-repeater-row')) {
                setTimeout(() => {
                    console.log("Re-initializing date pickers after adding repeater row.");
                    initializeDatePicker();
                }, 100);
            }
        });
 */

        initializeDatePicker();
    };
</script>
