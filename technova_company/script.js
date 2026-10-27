function validateRegistration() {

    let name =
        document.getElementById("name").value.trim();

    let email =
        document.getElementById("email").value.trim();

    let password =
        document.getElementById("password").value;

    let phone =
        document.getElementById("phone").value.trim();


    if (name === "") {
        alert("Please enter your name.");
        return false;
    }


    if (email === "") {
        alert("Please enter your email.");
        return false;
    }


    if (password.length < 6) {
        alert("Password must contain at least 6 characters.");
        return false;
    }


    if (phone.length < 10) {
        alert("Please enter a valid phone number.");
        return false;
    }


    return true;
}


function confirmLogout() {

    return confirm(
        "Are you sure you want to logout?"
    );

}