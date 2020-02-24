// checks the password that is inputed
function checkPassword(form) {

    if (form.password.value.length == 0 || form.confirm.value.length == 0) {
        alert("Please check that both the password and the confirmed password are the filled in");
        return false;
    }
    if (form.password.value != form.confirm.value) {
        alert("The password and the confirmed pass are not matching!");
        return false;

    }
    return true;
}

// check if the user inputed a legal username
function checkUsername(form) {

    let ee = document.getElementById("user_error");

    if (form.username.value.trim().length == 0) { // is the username is empty
        alert("Please input a username");
        // ee.innerText = "Please enter a username!";
        return false;

    } else {
        ee.innerText = "_";
        return true;

    }


}

// checking if either one is false, and thus just rejecting the user altogether
function isAllCorrect(form) {

    let isValid = true;

    if (!checkUsername(form)) {
        isValid = false;

    }

    if (!checkPassword(form)) {
        isValid = false;

    }

    return isValid;

}