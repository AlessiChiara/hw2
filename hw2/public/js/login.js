document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        let isValid = true;

        console.log("Form submitted"); 
        
        const email = document.querySelector('input[name="email"]');
        const pass = document.querySelector('input[name="pass"]');


        document.querySelectorAll('.error').forEach(e => e.remove());


        if (email.value.trim() === '') {
            isValid = false;
            showError(email, "Campo obbligatorio");
        }

        if (pass.value.trim() === '') {
            isValid = false;
            showError(pass, "Campo obbligatorio");
        }

        
        if (isValid) {
            form.submit();
        } else {
            console.log("Form is invalid"); 
        }
    });

    function showError(element, message) {
        const error = document.createElement('div');
        error.className = 'error';
        error.style.color = 'black';
        error.textContent = message;
        element.parentNode.insertBefore(error, element.nextSibling);
    }
});
