<div id="editPicturesModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('editPicturesModal')"><i class="las la-times"></i></span>
        <i class="las la-paw"></i>
        <h2>Editar fotos de la página de inicio</h2>

        <p class="modal-note">
          Nota: Cuando se muestra la imagen por defecto significa que ningún administrador ha subido una foto dinámicamente.
          Fue programado así para evitar que la página principal se quede sin imágenes.
        </p>

        <form action="/admin/settings/editpicture" method="POST" enctype="multipart/form-data">
            <input type="file" name="uploaded_image" id="uploaded-image" style="display: none;" accept="image/*">

            <div class="image-grid">
                <div class="image-slot">
                    <img src="/<?= asset($customImages[1]) ?>" alt="Vetcamp Verano 2023">
                </div>
                <div class="image-slot">
                    <img src="/<?= asset($customImages[2]) ?>" alt="Vetcamp Verano 2023">
                </div>
                <div class="image-slot">
                    <img src="/<?= asset($customImages[3]) ?>" alt="Vetcamp Verano 2023">
                </div>
                <div class="image-slot">
                    <img src="/<?= asset($customImages[4]) ?>" alt="Vetcamp Verano 2023">
                </div>
            </div>

            <input type="hidden" name="selected_slot" id="selected-slot" value="">

            <div class="modal-actions">
                <button type="button" class="main-action-bright secondary" onclick="closeModal('editPicturesModal')">
                    <i class="las la-times"></i> Cancelar
                </button>
                <button type="button" class="main-action-bright primary" onclick="triggerUpload()">
                    <i class="las la-upload"></i> Subir imagen
                </button>
                <button type="submit" name="delete_image" class="main-action-bright danger" onclick="return confirmDelete()">
                    <i class="las la-trash"></i> Borrar imagen
                </button>
            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const imageSlots = document.querySelectorAll('.image-slot');
  const hiddenInput = document.getElementById('selected-slot');

  imageSlots.forEach((slot, index) => {
    slot.addEventListener('click', function () {
      // Remove selection
      imageSlots.forEach(s => s.classList.remove('selected'));
      this.classList.add('selected');
      // store index. 1 to 4
      hiddenInput.value = index + 1;
    });
  });
});

function triggerUpload() {
  const selectedSlot = document.getElementById('selected-slot').value;
  if (!selectedSlot) {
    return;
  }

  document.getElementById('uploaded-image').click();
}

document.getElementById('uploaded-image').addEventListener('change', function () {
  if (this.files.length > 0) {
    this.form.submit();
  }
});

</script>