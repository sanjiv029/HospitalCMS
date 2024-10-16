<script>
document.addEventListener('DOMContentLoaded', function () {
    let educationCount = 0;
    let experienceCount = 0;

    // Function to configure the datepicker
    function datePickerConfig(bsInput, adInput) {
        return {
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 20,
            dateFormat: "YYYY-MM-DD",
            disableAfter: "2081-12-30",
            onChange: function () {
                const bsDate = bsInput.value;
                if (bsDate) {
                    const adDate = NepaliFunctions.BS2AD(bsDate, "YYYY-MM-DD", "YYYY-MM-DD");
                    adInput.value = adDate;
                    console.log(`Converted ${bsInput.id} (BS) to AD: ${adDate}`);
                } else {
                    adInput.value = '';
                }
            }
        };
    }

    // Initialize the Nepali datepicker for an input element
    function initializeDatePickers() {
        document.querySelectorAll('.nepali-datepicker-start').forEach(function (bsInput) {
            const adInput = bsInput.closest('.form-group').querySelector('.ad-date-start');
            if (bsInput && adInput && !bsInput.classList.contains('nepali-datepicker-initialized-for-start')) {
                $(bsInput).nepaliDatePicker(datePickerConfig(bsInput, adInput));
                bsInput.classList.add('nepali-datepicker-initialized-for-start');
            }
        });

        document.querySelectorAll('.nepali-datepicker-end').forEach(function (bsInput) {
            const adInput = bsInput.closest('.form-group').querySelector('.ad-date-end');
            if (bsInput && adInput && !bsInput.classList.contains('nepali-datepicker-initialized-for-end')) {
                $(bsInput).nepaliDatePicker(datePickerConfig(bsInput, adInput));
                bsInput.classList.add('nepali-datepicker-initialized-for-end');
            }
        });
    }

    // Add a new education or experience item
    function addItem(type, bsDate = '', adDate = '') {
        const count = type === 'education' ? ++educationCount : ++experienceCount;
        const itemClass = type === 'education' ? '.education-item' : '.experience-item';
        const fieldsId = type === 'education' ? 'education-fields' : 'experience-fields';

        let newItem = document.querySelector(itemClass).cloneNode(true);
        newItem.setAttribute('data-id', count); // Assign a unique ID to each item

        newItem.querySelectorAll('input, select, textarea').forEach(input => {
            const label = newItem.querySelector(`label[for='${input.id}']`);
            const newId = input.id.replace(/\d+/, count); // Generate a new ID based on the count
            input.id = newId;
            if (input.classList.contains('nepali-datepicker-start')) {
                input.value = bsDate;
                $(input).nepaliDatePicker(datePickerConfig(input, newItem.querySelector('.ad-date-start')));
                input.classList.add('nepali-datepicker-initialized-for-start');
            } else if (input.classList.contains('ad-date-start')) {
                input.value = adDate;
            } else {
                input.value = ''; // Clear other inputs
            }
            if (input.classList.contains('nepali-datepicker-end')) {
                input.value = bsDate;
                $(input).nepaliDatePicker(datePickerConfig(input, newItem.querySelector('.ad-date-end')));
                input.classList.add('nepali-datepicker-initialized-for-end');
            } else if (input.classList.contains('ad-date-end')) {
                input.value = adDate;
            } else {
                input.value = ''; // Clear other inputs
            }

            // Update the corresponding label's 'for' attribute
            if (label) {
                label.setAttribute('for', newId);
            }
        });

        // Ensure the remove button is displayed for new items
        newItem.querySelector(`.remove-${type}`).style.display = 'inline-block';
        document.getElementById(fieldsId).appendChild(newItem);
    }

    // Event listeners for adding new education and experience items
    document.getElementById('add-education').addEventListener('click', () => addItem('education'));
    document.getElementById('add-experience').addEventListener('click', () => addItem('experience'));

    // Remove item event listener for both education and experience
    ['education', 'experience'].forEach(type => {
        document.getElementById(`${type}-fields`).addEventListener('click', function (event) {
            if (event.target.classList.contains(`remove-${type}`)) {
                const parent = event.target.closest(`.${type}-item`);
                const itemId = parent.getAttribute('data-id');

                // Decrease the counter when an item is removed
                if (type === 'education') {
                    educationCount--;
                } else {
                    experienceCount--;
                }

                parent.remove(); // Remove the item
                console.log(`${type} item with ID ${itemId} removed`);
            }
        });
    });

    // Initialize the datepickers after the DOM has fully loaded
    initializeDatePickers();
});

</script>
