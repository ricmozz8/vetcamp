const accept_formats = {
    'image/*': ["jpg", "jpeg", "png"],
    'video/*': ["mp4"],
    'audio/*': ["mp3", "wav", "ogg"],
    'application/pdf': ["pdf"],
}

function updateFileName(input) {
    const fileName = input.files[0]?.name || "Selecciona un archivo";
    input.previousElementSibling.querySelector("span").textContent = fileName;

    let accept = input.getAttribute("accept");

    validateExt(fileName, accept_formats[accept], input);

    let next_button = document.querySelector("#next-button");
    next_button.disabled = false;
}

function validateExt(fileName, accept, input) {
    let ext = fileName.split('.').pop();
    let error_exists = document.querySelector('#error-' + input.id)
    if (!accept.includes(ext)) {

        if (error_exists === null) {
            let error_message = document.createElement('span');
            error_message.classList.add('error-document');
            error_message.id = 'error-' + input.id;
            error_message.innerText = 'El archivo debe ser de formato ' + accept.join(', ');
            input.parentElement.parentElement.appendChild(error_message);
        }

        return false;
    }

    // file is ok let's check if there was a previous error and then delete it
    if (error_exists) {
        error_exists.remove();
    }


    return true;

}
