<script>
    document.addEventListener('DOMContentLoaded', function () {
        let educationCount = document.querySelectorAll('.education-item').length;
        let experienceCount = document.querySelectorAll('.experience-item').length;

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
        function addItem(type) {
            const count = type === 'education' ? educationCount: experienceCount;
            const itemClass = type === 'education' ? '.education-item' : '.experience-item';
            const fieldsId = type === 'education' ? 'education-fields' : 'experience-fields';

            let newItem = document.querySelector(itemClass).cloneNode(true);
            newItem.setAttribute('data-id', count); // Assign a unique ID to each item

            newItem.querySelectorAll('input, select, textarea').forEach(input => {
                const label = newItem.querySelector(`label[for='${input.id}']`);
                const newId = input.id.replace(/\d+/, count); // Generate a new ID based on the count
                input.id = newId;
                input.value = ''; // Clear other inputs by default

                // Initialize the datepickers if the input is a date field
                if (input.classList.contains('nepali-datepicker-start') || input.classList.contains('nepali-datepicker-end')) {
                    $(input).nepaliDatePicker(datePickerConfig(input, newItem.querySelector(`.ad-date-${input.classList.contains('nepali-datepicker-start') ? 'start' : 'end'}`)));
                    input.classList.add(input.classList.contains('nepali-datepicker-start') ? 'nepali-datepicker-initialized-for-start' : 'nepali-datepicker-initialized-for-end');
                }

                // Update the corresponding label's 'for' attribute
                if (label) {
                    label.setAttribute('for', newId);
                }
            });

            // Ensure the remove button visibility
            const removeButton = newItem.querySelector(`.remove-${type}`);
            removeButton.style.display = count === 0 ? 'none' : 'inline-block';

            document.getElementById(fieldsId).appendChild(newItem);

            // Update the counters
            if (type === 'education') {
                educationCount++;
            } else {
                experienceCount++;
            }

            checkRemoveButtonVisibility(type); // Call this function to ensure remove button visibility
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

                    parent.remove(); // Remove the item
                    console.log(`${type} item with ID ${itemId} removed`);

                    // Re-index the remaining items
                    reindexItems(type);

                    // Decrease the counter
                    if (type === 'education') {
                        educationCount--;
                    } else {
                        experienceCount--;
                    }

                    // Check the visibility of remove buttons
                    checkRemoveButtonVisibility(type);
                }
            });
        });

        // Function to re-index items after one is removed
        function reindexItems(type) {
            const items = document.querySelectorAll(`.${type}-item`);
            items.forEach((item, index) => {
                // Update data-id
                item.setAttribute('data-id', index);

                // Update input names and IDs
                item.querySelectorAll('input, select, textarea, name').forEach(input => {
                    const nameParts = input.name.split('[');
                    if (nameParts.length > 1) {
                        nameParts[1] = `${index}]`; // Set the correct index
                        input.name = nameParts.join('[');
                    }
                    input.id = input.id.replace(/\d+/, index); // Update ID
                });
            });
        }

        // Check and update remove button visibility
        function checkRemoveButtonVisibility(type) {
            const remainingItems = document.querySelectorAll(`.${type}-item`);
            if (remainingItems.length > 0) {
                // Hide remove button for the first item
                remainingItems[0].querySelector(`.remove-${type}`).style.display = 'none';
            }
            // Show remove buttons for subsequent items
            remainingItems.forEach((item, index) => {
                if (index > 0) {
                    item.querySelector(`.remove-${type}`).style.display = 'inline-block';
                }
            });
        }

        // Call to check remove button visibility on page load
        checkRemoveButtonVisibility('education');
        checkRemoveButtonVisibility('experience');

        // Initialize the datepickers after the DOM has fully loaded
        initializeDatePickers();
    });
</script>
