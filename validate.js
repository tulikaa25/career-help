function validateForm() {
    var phone = document.getElementById("phone").value;
    var password = document.getElementById("password").value;

    var phonePattern = /^[0-9]{10}$/; // Simple phone validation
    if (!phonePattern.test(phone)) {
        alert("Please enter a valid 10-digit phone number.");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
    }

    return true;
}
