    // Password Visibility Toggle Script for single field
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

    // Password Visibility Toggle Script for 2 fields
        function togglePasswords() {
          const passwordField = document.getElementById('password');
          const confirmPasswordField = document.getElementById('confirm_password');
          const toggleIcons = document.querySelectorAll('.password-toggle i');

          if (passwordField.type === 'password') {
            passwordField.type = 'text';
            confirmPasswordField.type = 'text';
            toggleIcons.forEach(icon => icon.classList.replace('fa-eye', 'fa-eye-slash'));
          } else {
            passwordField.type = 'password';
            confirmPasswordField.type = 'password';
            toggleIcons.forEach(icon => icon.classList.replace('fa-eye-slash', 'fa-eye'));
          }
        }
