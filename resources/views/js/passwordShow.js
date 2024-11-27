function togglePassword(field = 'password', icon = 'password-toggle') {
    const passwordInput = document.getElementById(field);
    const toggleIcon = document.querySelector('.' + icon +  ' i');

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