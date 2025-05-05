

const loginForm = document.getElementById('login-form');

loginForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const loginName = document.getElementById('loginName');
    const password = document.getElementById('password');


    let outputErrorLoginFormLoginName = document.getElementById("output-error-login-form-loginName");

    let outputErrorLoginFormPassword = document.getElementById("output-error-login-form-password");

    let isValid = true;



    document.getElementById("output-error-login-form-loginName").textContent = "";
    document.getElementById("output-error-login-form-password").textContent = "";


    if (loginName.value.trim() == "") {
        outputErrorLoginFormLoginName.textContent = "add login name";
        isValid = false;
    }

    if (password.value.trim() == "") {
        outputErrorLoginFormPassword.textContent = "add password";
        isValid = false;
    }


    if (loginName.value.length > 50 || password.value.length > 50) {

        outputErrorLoginFormLoginName.textContent = "max lenght is 50"
        isValid = false;
    }


    if (password.value.length < 8) {

        outputErrorLoginFormPassword.textContent = "minimum length for password is 8";
        isValid = false;
    }

    if (isValid) {
        console.log("Form submitted successfully!");
        loginForm.submit();

        // todo finish validation login form in frontend
    }


});