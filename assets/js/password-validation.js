function validatePassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("cpassword").value;
    var email = document.getElementById("email").value;
    var requirements = document.getElementById("password-requirements");

    // Regular expression to enforce password complexity
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&#]{8,}$/;

    if (!passwordRegex.test(password)) {
        requirements.innerText = "Password must contain at least 8 characters, Uppercase letter,  lowercase letter, a number and a special character.";
        requirements.style.display = "block";
        return false;
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        alert("Passwords do not match");
        return false;
    }

    return true;

    // Check if email contains "@gmail.com"
    if (!email.includes("@gmail.com")) {
        alert("Email must be a valid Gmail address");
        return false;
    }

    return true;
}
