
function updateFileName(input) {
  const fileName = input.files[0]?.name || "Selecciona un archivo";
  input.previousElementSibling.querySelector("span").textContent = fileName;
}
