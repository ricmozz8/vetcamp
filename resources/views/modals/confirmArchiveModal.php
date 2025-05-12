<!-- Main popup container with the form -->
<div id="confirmArchiveModal" class="modal">
    <div class="modal-content">
    
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('confirmArchiveModal')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-archive"></i>
            ¿Desea archivar las solicitudes?
        </h2>
        
        <form id="archiveForm" action="/admin/settings/archive" method="POST">
    
            <div class="form-group">
                <p>Esta acción creará un documento con la información de las solicitudes actuales. Recuerde limpiar las listas para evitar documentos duplicados.</p>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('confirmArchiveModal')">Cancelar</a>
                <button id="archiveBtn" type="button" class="main-action-bright primary"> 
                    <i class="fas fa-archive"></i>
                    Confirmar
                </button>

            </div>
          
        </form>
        <script>
                document.getElementById('archiveBtn').addEventListener('click', function () {
                const form = document.getElementById('archiveForm');

                // Handle download
                const iframe = document.createElement('iframe');
                iframe.style.display = 'none';
                document.body.appendChild(iframe);

                const iframeDoc = iframe.contentWindow.document;

                iframeDoc.open();
                iframeDoc.write(`
                    <form id="downloadForm" action="${form.action}" method="POST"></form>
        `       );
                iframeDoc.close();
                iframeDoc.getElementById('downloadForm').submit();

                setTimeout(() => {
                    location.reload(); // CTRL+R
                }, 2000);
            });
        </script>

    </div>
</div>