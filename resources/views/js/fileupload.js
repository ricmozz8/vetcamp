const accept_formats = {
    'image/*': ["jpg", "jpeg", "png"],
    'video/*': ["mp4"],
    'audio/*': ["mp3", "wav", "ogg"],
    'application/pdf': ["pdf"],
}

const MAX_SIZE = '10'; //MB

let is_form_valid = false;

function updateFileName(input) {
    const fileName = input.files[0]?.name || "Selecciona un archivo";
    input.previousElementSibling.querySelector("span").textContent = fileName;

    let accept = input.getAttribute("accept");

    is_form_valid = validateExt(fileName, accept_formats[accept], input) && validateSize(input.files[0], input);


    let next_button = document.querySelector("#next-button");
    next_button.disabled = false;
}

function validateExt(fileName, accept, input) {

    if(fileName === undefined || fileName === '') return false;

    let ext = fileName.split('.').pop().toLowerCase();
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

function validateSize(file, input){

    if (!file) return false;

    let fileSizeInMB = file.size / (1024 * 1024); // Convert file size from bytes to MB
    let error_exists = document.querySelector('#size-error-' + input.id);

    if (fileSizeInMB > parseFloat(MAX_SIZE)) {
        if (!error_exists) {
            let error_message = document.createElement('span');
            error_message.classList.add('error-document');
            error_message.id = 'size-error-' + input.id;
            error_message.innerText = `El tamaño máximo permitido es ${MAX_SIZE} MB.`;
            input.parentElement.parentElement.appendChild(error_message);
        }

        return false;
    }

    // Remove error message if size is valid and error exists
    if (error_exists) {
        error_exists.remove();
    }

    return true;
    
    
    
}

document.addEventListener('change', function () {

    let nextButton = document.querySelector("#next-button");
    if (!is_form_valid) {
        nextButton.disabled = true;
        nextButton.classList.add('disabled');
    } else {
        nextButton.disabled = false;
        nextButton.classList.remove('disabled');
    }
})
