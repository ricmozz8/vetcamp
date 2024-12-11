

function updateFileName(input) {
  const fileName = input.files[0]?.name || "Selecciona un archivo";
  input.previousElementSibling.querySelector("span").textContent = fileName;

  let next_button = document.querySelector("#next-button");
  next_button.disabled = false;
}


