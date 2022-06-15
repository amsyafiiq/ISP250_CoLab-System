function changePlaceholder() {
  const radio = document.getElementsByName("user");
  var selected;

  for (var i = 0; i < radio.length; i++) {
    if (radio[i].checked) {
      selected = radio[i];
    }
  }

  if (selected.value == 1) {
    document.getElementById("pass").placeholder = "Password";
    document.getElementById("id").placeholder = "Staff ID";
  } else {
    document.getElementById("pass").placeholder = "IC Number";
    document.getElementById("id").placeholder = "Student ID";
  }

  console.log(selected.value);
}

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#pass");

togglePassword.addEventListener("click", function () {
  // toggle the type attribute
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);

  // toggle the icon
  this.classList.toggle("bi-eye");
});