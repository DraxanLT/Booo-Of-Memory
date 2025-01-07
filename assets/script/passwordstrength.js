document.addEventListener('DOMContentLoaded', function() {
    var passwordInput = document.getElementById('password_input');
    var strengthBar = document.getElementById('bar_pwd_strength');
    var strengthText = document.getElementById('text_strength');

    passwordInput.addEventListener('input', function() {
        var password = passwordInput.value;
        updateStrengthDisplay(password);
    });

    function updateStrengthDisplay(password) {
        let width = 0;
        let strengthLabel = ' ';
        
        if (password.length >= 8) {
            width = 33;
            strengthLabel = 'Faible';

            if (/[A-Z]/.test(password)) {
                width = 66;
                strengthLabel = 'Moyen';

                if (/[0-9]/.test(password) && /[\W_]/.test(password)) {
                    width = 100;
                    strengthLabel = 'Fort';
                }
            }
        } else if (password.length > 0) {
            width = 33;
            strengthLabel = 'Faible';
        }

        strengthBar.style.width = width + '%';
        strengthText.textContent = strengthLabel;

        strengthBar.classList.remove('weak', 'medium', 'strong');
        if (width === 33) {
            strengthBar.classList.add('weak');
        } else if (width === 66) {
            strengthBar.classList.add('medium');
        } else if (width === 100) {
            strengthBar.classList.add('strong');
        }
    }
});