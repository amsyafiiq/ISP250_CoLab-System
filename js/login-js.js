const radioButtons = document.querySelectorAll("input[name='user']");
const button = document.querySelector("button[type='button']");

button.addEventListener("click", changePlaceholder());

for (const radioButton of radioButtons) {
  radioButton.addEventListener("change", changePlaceholder());
}

function changePlaceholder() {
  console.log(1);
}
