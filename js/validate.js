document
	.getElementById("signupForm")
	.addEventListener("submit", function (event) {
		event.preventDefault(); // Prevent form submission
		var email = document.getElementById("email");
		var password = document.getElementById("password");
		var confirmPassword = document.getElementById("confirm-password");
		var valid = true;

		// Clear previous errors
		document.querySelectorAll(".error-message").forEach(function (element) {
			element.textContent = "";
		});

		document.querySelectorAll("input").forEach(function (input) {
			input.classList.remove("error");
		});

		if (password.value !== confirmPassword.value) {
			showError(password, "Passwords do not match.");
			showError(confirmPassword, "Passwords do not match.");
			valid = false;
		}

		// Submit form if valid
		if (valid) {
			this.submit();
		}
	});

// Clear password errors on focus
document.getElementById("password").addEventListener("focus", function () {
	clearPasswordErrors();
});

document
	.getElementById("confirm-password")
	.addEventListener("focus", function () {
		clearPasswordErrors();
	});

function clearPasswordErrors() {
	var passwordFields = [
		document.getElementById("password"),
		document.getElementById("confirm-password"),
	];
	passwordFields.forEach(function (field) {
		var errorDiv = field.nextElementSibling;
		field.classList.remove("error");
		errorDiv.textContent = "";
	});
}

function showError(input, message) {
	var errorDiv = input.nextElementSibling;
	input.classList.add("error");
	errorDiv.textContent = message;
}
