@push('js')
<script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.4.min.js"
type="text/javascript"></script>
@endpush
@push('css')
<link
href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.4.min.css"
rel="stylesheet" type="text/css"/>
@endpush


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
            disableAfter: "2081-01-01"
        });

        // Function to handle BS to AD conversion and console output
        function convertBSToAD() {
            var bsDate = nepaliInput.value;  // Get the entered or selected BS date
            if (bsDate) {
                // Convert the BS date to AD using the BS2AD function
                var adDate = NepaliFunctions.BS2AD(bsDate, "YYYY-MM-DD", "YYYY-MM-DD");
                adInput.value = adDate;  // Set the AD date in the corresponding hidden input
                console.log("Converted AD Date:", adDate);  // Output to the console
            } else {
                console.error("Invalid BS date or conversion failed.");
            }
        }

        // Add event listener for datepicker change (for date selection via datepicker)
        nepaliInput.addEventListener('change', convertBSToAD);

        // Add event listener for manual input (for typing the BS date manually)
        nepaliInput.addEventListener('input', function() {
            setTimeout(convertBSToAD, 500);  // Small delay to allow manual typing
        });
    };
</script>

