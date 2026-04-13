document.addEventListener('DOMContentLoaded', function () {  
    const errorMessage = document.getElementById('error-message');  
    errorMessage.style.display = 'none'; 

    console.log('Login page loaded, event listeners attached.');
});

function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = event.currentTarget.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}
