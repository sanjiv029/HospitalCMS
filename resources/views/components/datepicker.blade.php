<script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.4.min.js" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function() {
        var nepaliInput = document.getElementById("nepali-datepicker");
        var adInput = document.getElementById("date_of_birth_ad");

        // Ensure NepaliFunctions is loaded
        if (typeof NepaliFunctions !== "undefined") {
            console.log("NepaliFunctions loaded successfully.");
        } else {
            console.error("NepaliFunctions not available.");
        }

        // Initialize the Nepali Datepicker
        nepaliInput.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 20,
            dateFormat: "YYYY-MM-DD",
            disableAfter: "2081-01-01",
            onChange: function() {
                convertBSToAD();  // Convert immediately when the datepicker changes
            }
        });

        // Function to handle BS to AD conversion
        function convertBSToAD() {
            var bsDate = nepaliInput.value;  // Get the selected or entered BS date
            if (bsDate) {
                // Convert the BS date to AD using the BS2AD function
                var adDate = NepaliFunctions.BS2AD(bsDate, "YYYY-MM-DD", "YYYY-MM-DD");
                adInput.value = adDate;  // Set the AD date in the corresponding input field
                console.log("Converted AD Date:", adDate);  // Output the converted date to the console
            } else {
                console.error("Invalid BS date or conversion failed.");
            }
        }

        // Add event listener for manual input (for typing the BS date manually)
        nepaliInput.addEventListener('input', function() {
            convertBSToAD();  // Convert when the user manually changes the BS date
        });

        // Trigger the conversion on page load to handle any pre-filled BS date
        convertBSToAD();
    };
</script>
