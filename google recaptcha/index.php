<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.google.com/recaptcha/api.js?render=6LdIqu0mAAAAAHKhiSg-EnuA7O3-9EuayBVbUxMv"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
</head>

<body>
    <form id="myForm">
        <!-- Your form fields go here -->

        <!-- Hidden field for reCAPTCHA response -->
        <input type="hidden" id="recaptchaResponse" name="recaptchaResponse" />

        <!-- Submit button -->
        <button type="submit">Submit</button>
    </form>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myForm').submit(function(event) {
                event.preventDefault(); // Prevent form submission

                grecaptcha.ready(function() {
                    grecaptcha.execute('6LdIqu0mAAAAAHKhiSg-EnuA7O3-9EuayBVbUxMv', {
                        action: 'submit'
                    }).then(function(token) {
                        $('#recaptchaResponse').val(token); // Set the token in the hidden field

                        // Perform AJAX request to submit the form data
                        $.ajax({
                            url: 'process.php', // Replace with your server-side script URL
                            method: 'POST',
                            data: $('#myForm').serialize(), // Include form data
                            success: function(response) {
                                console.log(response);
                            },
                            error: function() {
                                // Handle error
                            }
                        });
                    });
                });
            });
        });
    </script>

</body>

</html>