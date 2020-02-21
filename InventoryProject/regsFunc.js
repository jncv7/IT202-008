function checkPassword(form) {

    if (form.password.value.length == 0 || form.confirm.value.length ==0) {
        alert ("Please check that both the password and the confirmed password are the filled in");
        return false;
    }
    if (form.password.value != form.confirm.value) {
        alert("The password and the confirmed pass are not matching!");
        return false;
        
    }
    return true;
}