



const createPostForm = document.getElementById("createPostsForm");

createPostForm.addEventListener("submit", function (e) {
    e.preventDefault();


    const postTitle = document.getElementById("postTitle");

    const postContent = document.getElementById("postContent");

    let titleError = document.getElementById('error-title');
    let contentError = document.getElementById('error-content');

    isValid = true;

    document.getElementById('error-title').textContent = "";
    document.getElementById('error-content').textContent = "";

    if (postTitle.value.trim() == "") {
        isValid = false;
        titleError.textContent = "add title please";
    }



    if (postContent.value.trim() == "") {
        isValid = false;
        contentError.textContent = "add content please";
    }


    if (postTitle.value.length > 50) {
        isValid = false;
        titleError.textContent = "max length for title is 50!";

    }


    if (postContent.value.length > 900) {
        isValid = false;
        contentError.textContent = "max leagth for content is 900";
    }

    if (isValid) {
        console.log("Form submitted successfully!");
        createPostForm.submit();

        // todo finish validation login form in frontend
    }


});