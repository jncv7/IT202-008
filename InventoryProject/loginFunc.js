// make sure the password is not empty
function checkPassword(form) {

    let isValid = true;

    if (form.password.value.length == 0) {
        alert("Please input a password!");
        isValid = false;
    }

    return isValid;

}


// make sure the username is not empty
function checkUsername(form) {

    let isValid = true;

    if (form.username.value.length == 0) {
        alert("Please input a username!");
        isValid = false;

    }

    return isValid;
}

function checkAll(form) {
    let isValid = true;
    if (!checkUsername(form)) {
        isValid = false;
    }

    if (!checkPassword(form)) {
        isValid = false;
    }

    return isValid;
}