// validating file sizes and types

document.ge('#file-input').addEventListener('onchange', function() {
    // let fileInputs = document.querySelectorAll('#file-input');
    // let valid = true;

    // fileInputs.forEach(function(fileInput) {
    //     let file = fileInput.files[0];
    //     let maxSize = 8 * 1024 * 1024; // 8MB in bytes

    //     if (file.size > maxSize) {
    //         alert('El archivo es demasiado grande. Por favor, selecciona un archivo de menos de 8MB.');
    //         valid = false;
    //     }
    // });

    // return valid;
    console('El archivo es demasiado grande. Por favor, selecciona un archivo de menos de 8MB.');
});
