function changePlaceholder() {
  const radio = document.getElementsByName("user");
  var selected;

  for (var i = 0; i < radio.length; i++) {
    if (radio[i].checked) {
      selected = radio[i];
    }
  }

  if (selected.value == 0) {
    document.getElementById("pass").placeholder = "Password";
    document.getElementById("id").placeholder = "Staff ID";
  } else {
    document.getElementById("pass").placeholder = "IC Number";
    document.getElementById("id").placeholder = "Student ID";
  }

  console.log(selected.value);
}
