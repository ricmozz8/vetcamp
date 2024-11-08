
  // Get all the upload boxes
  const uploadBoxes = document.querySelectorAll('.upload-box');

  uploadBoxes.forEach(uploadBox => {
    // Prevent the default behavior when dragging over the drop zone
    uploadBox.addEventListener('dragover', (event) => {
      event.preventDefault();
      event.stopPropagation();
      uploadBox.classList.add('dragging'); // Optional: Add visual feedback (e.g., change color)
    });

    // Remove the "dragging" class when the drag leaves the drop zone
    uploadBox.addEventListener('dragleave', (event) => {
      event.preventDefault();
      event.stopPropagation();
      uploadBox.classList.remove('dragging');
    });

    // Handle when a file is dropped
    uploadBox.addEventListener('drop', (event) => {
      event.preventDefault();
      event.stopPropagation();
      uploadBox.classList.remove('dragging'); // Remove "dragging" class on drop

      const files = event.dataTransfer.files;
      if (files.length > 0) {
        const input = uploadBox.querySelector('input[type="file"]');
        input.files = files; // Set the dropped files to the file input
      }
    });
  });

