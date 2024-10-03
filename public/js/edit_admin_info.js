$(document).ready(function () {
    $('#edit_name').click(function (e) {
        e.preventDefault();
        let icon = $('#edit_name').find('i');
        if (icon.hasClass('fa-solid fa-pen')) {
            $('#inputName').removeAttr('disabled');
            icon.removeClass('fa-solid fa-pen').addClass('fa-solid fa-check text-success fa-2xl');
        } else {
            $('#inputName').attr('disabled', 'disabled');
            icon.removeClass('fa-solid fa-check text-success fa-2xl').addClass('fa-solid fa-pen');
            $.ajax({
                type: "POST",
                url: "/updateAdminName",
                data: {
                    name: $('#inputName').val(),
                },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                dataType: "json",
                success: function (response) {
                    $("#mess").append(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Update name successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    setTimeout(() => {
                        $('#mess').remove();
                    }, 3000);
                }
            });
        }

    });

    $('#edit_email').click(function (e) {
        e.preventDefault();
        let icon = $('#edit_email').find('i');
        if (icon.hasClass('fa-solid fa-pen')) {
            $('#inputEmail').removeAttr('disabled');
            icon.removeClass('fa-solid fa-pen').addClass('fa-solid fa-check text-success fa-2xl');
        } else {
            $('#inputEmail').attr('disabled', 'disabled');
            icon.removeClass('fa-solid fa-check text-success fa-2xl').addClass('fa-solid fa-pen');
            $.ajax({
                type: "POST",
                url: "/updateAdminEmail",
                data: {
                    email: $('#inputEmail').val(),
                },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                dataType: "json",
                success: function (response) {
                    $("#mess").append(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Update email successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    setTimeout(() => {
                        $('#mess').remove();
                    }, 3000);
                }
            });
        }

    });

    function handleImportCsvFile(buttonId, inputId, url, successMessage) {

        $(buttonId).click(function (e) {
            e.preventDefault();
            document.getElementById(inputId).click();
            // Store the URL and success message in the button's data attributes
            $(this).data('url', url);
            $(this).data('successMessage', successMessage);
        });

        document.getElementById(inputId).addEventListener("change", function () {
            const file = this.files[0];
            const fileName = file ? file.name : "No file chosen";

            document.getElementById('fileName').textContent = fileName;
            document.getElementById('removeFile').style.display = file ? 'inline' : 'none';
            document.getElementById('chooseFile').style.display = file ? 'inline' : 'none';

            // Get the button that triggered the file input
            const button = $(buttonId);
            const url = button.data('url');
            const successMessage = button.data('successMessage');

            document.getElementById('removeFile').onclick = function () {
                document.getElementById(inputId).value = '';
                document.getElementById('fileName').textContent = '';
                document.getElementById('removeFile').style.display = 'none';
                document.getElementById('chooseFile').style.display = 'none';
            }

            document.getElementById('chooseFile').onclick = function () {
                const formData = new FormData();
                formData.append('file', file); // Append the file to the FormData object

                // Clear the file input and reset display
                document.getElementById(inputId).value = '';
                document.getElementById('fileName').textContent = '';
                document.getElementById('removeFile').style.display = 'none';
                this.style.display = 'none'; // Hide the X icon

                $.ajax({
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    url: url, // Use the url passed to the function
                    data: formData, // Send the FormData object
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from setting the content type
                    success: function (response) {
                        alert(successMessage); // Use the success message passed to the function
                        location.reload();
                    }
                });
            };
        });
    }

    // Initialize the function for both buttons
    handleImportCsvFile("#importMovieCsvButton", "csvFileInput", "/import_movie_data", "Import movies successfully");
    handleImportCsvFile("#importSeatCsvButton", "csvFileInput", "/import_seat_data", "Import seats successfully");
});