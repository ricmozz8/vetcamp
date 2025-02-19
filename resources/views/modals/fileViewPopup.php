<div class="file-view-popup" id="fileViewPopup-<?php echo $file['name'] ?>" style="display: none;">
    <div class="document-info-topbar">
        <div class="details">
            <h2 class="file-name"><?= $file['name'] ?></h2>
            <span class="file-size"><?= round($file['size'] / 1024)   ?>KB</span>
        </div>
        <div class="action">
            <button class="main-action-bright tertiary" onclick="closeModal('fileViewPopup-<?php echo $file['name'] ?>')"><i class="fas fa-times"></i>Cerrar</button>
        </div>
    </div>

    <div class="file-content">
        <?php if ($file['type'] == 'application/pdf') { ?>
            <embed src="data:<?php echo $file['type']; ?>;base64,<?php echo base64_encode($file['contents']); ?>" type="<?php echo $file['type']; ?>" />
        <?php } else if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/png' || $file['type'] == 'image/jpg') { ?>
            <img src="data:<?php echo $file['type']; ?>;base64,<?php echo base64_encode($file['contents']); ?>" alt="Image">
        <?php } else if ($file['type'] == 'video/mp4') { ?>
            <video src="data:<?php echo $file['type']; ?>;base64,<?php echo base64_encode($file['contents']); ?>" controls></video>

        <?php } ?>
    </div>
</div>