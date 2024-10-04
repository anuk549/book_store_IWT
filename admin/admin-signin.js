document.addEventListener('DOMContentLoaded', () => {
    const signinForm = document.getElementById('signinForm');
    const errorMessage = document.getElementById('errorMessage');

    signinForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        if (username.trim() === '' || password.trim() === '') {
            errorMessage.textContent = 'Please enter both username and password.';
            return;
        }

        // If validation passes, submit the form
        signinForm.submit();
    });
});