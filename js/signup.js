

const signUpForm = document.getElementById('sign-up-form');



signUpForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Get the values from the form
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const loginName = document.getElementById('loginName');
    const password = document.getElementById('password');
    const confPassword = document.getElementById('conf-password');

    let outputErrorSignUpFormUsername = document.getElementById("output-errors-signup-form-username");

    let outputErrorSignUpFormEmail = document.getElementById("output-errors-signup-form-email");

    let outputErrorSignUpFormLoginName = document.getElementById("output-errors-signup-form-loginName");

    let outputErrorSignUpFormPassword = document.getElementById("output-errors-signup-form-password");

    let outputErrorSignUpFormConfPassword = document.getElementById("output-errors-signup-form-conf-password");



    let isValid = true;

    document.getElementById("output-errors-signup-form-username").textContent = "";

    document.getElementById("output-errors-signup-form-email").textContent = "";

    document.getElementById("output-errors-signup-form-loginName").textContent = "";

    document.getElementById("output-errors-signup-form-password").textContent = "";

    document.getElementById("output-errors-signup-form-conf-password").textContent = "";



    if (username.value.trim() == "") {
        outputErrorSignUpFormUsername.textContent = "for you need to enter username"
        isValid = false;
    }


    if (email.value.trim() == "") {
        outputErrorSignUpFormEmail.textContent = "for you need to enter email"
        isValid = false;
    }


    if (loginName.value.trim() == "") {
        outputErrorSignUpFormLoginName.textContent = "for you need to enter login name"
        isValid = false;
    }

    if (password.value.trim() == "") {
        outputErrorSignUpFormPassword.textContent = "for you need to enter password"
        isValid = false;
    }


    if (confPassword.value.trim() == "") {
        outputErrorSignUpFormConfPassword.textContent = "for you need to enter confirm password"
        isValid = false;
    }


    if (password.value != confPassword.value) {
        outputErrorSignUpFormPassword.textContent = "passwords must be the same!"
        isValid = false;

    }

    if (username.value.length > 50 || email.value.length > 50 || loginName.value.length > 50 || password.value.length > 50) {
        outputErrorSignUpFormUsername.textContent = "max length is 50!"
        isValid = false;
    }

    if (password.value.length < 8) {
        outputErrorSignUpFormConfPassword.textContent = "password minimum length is 8"
        isValid = false;
    }

    if (isValid) {
        console.log("Form submitted successfully!");
        signUpForm.submit();

    }

});









