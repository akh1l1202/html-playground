$(document).ready(function() {
    $('#registrationForm').on('submit', function(e) {
        e.preventDefault();

        $('.error-text').text('');
        $('#responseMessage').hide().removeClass('success-box error-box');
        
        let isValid = true;
        const username = $('#username').val().trim();
        const email = $('#email').val().trim();
        const password = $('#password').val().trim();

        if (username.length < 3) {
            $('#usernameError').text('Username must be at least 3 characters.');
            isValid = false;
        }

    
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            $('#emailError').text('Please enter a valid email address.');
            isValid = false;
        }
        if (password.length < 6) {
            $('#passwordError').text('Password must be at least 6 characters.');
            isValid = false;
        }

        if (isValid) {
            // Disable button to prevent double-submissions
            const submitBtn = $('#submitBtn');
            submitBtn.text('Registering...').prop('disabled', true);

            $.ajax({
                url: 'register.php', 
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json', 
                success: function(response) {
                    if (response.status === 'success') {
                        $('#responseMessage')
                            .addClass('success-box')
                            .html('<strong>Success!</strong> ' + response.message)
                            .fadeIn();
                        
                      
                        $('#registrationForm')[0].reset();
                    } else {
                        $('#responseMessage')
                            .addClass('error-box')
                            .html('<strong>Error:</strong> ' + response.message)
                            .fadeIn();
                    }
                },
                error: function(xhr, status, error) {
                    $('#responseMessage')
                        .addClass('error-box')
                        .html('<strong>Server Error:</strong> Could not connect to registration script.')
                        .fadeIn();
                    console.error("AJAX Error: ", status, error);
                },
                complete: function() {
                    submitBtn.text('Register').prop('disabled', false);
                }
            });
        }
    });
});