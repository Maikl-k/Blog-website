


const deleteForm = document.getElementById('delete-post-form');

deleteForm.addEventListener('submit', function (e){
    e.preventDefault();


    const titleOfPostToDelete = document.getElementById('title-post-to-delete-input-f');

    let deleteErrors = document.getElementById('delete-errors');

    isValid = true;

    document.getElementById('delete-errors').textContent = "";

    

    if(titleOfPostToDelete.value.trim() == ""){
        isValid = false;
        deleteErrors.textContent = "add title of post what you want delete";
    }


    if(titleOfPostToDelete.value.length > 50){
        isValid = false;
        deleteErrors.textContent = "to long title name, maximum length is 50"
    }

    if (isValid) {
        console.log("Form submitted successfully!");
        deleteForm.submit();
    }

});

