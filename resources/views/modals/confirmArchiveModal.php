<!-- Main popup container with the form -->
<div class="message-popup" id="confirmArchiveModal" style="display: none">
    <!-- Close button in the top-right corner -->
    <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
    <a href="#" class="plain-action" id="closePopup" onclick="closeModal('confirmArchiveModal')"><i class="las la-times"></i></a>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('confirmArchiveModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary"> 
                    <i class="las la-archive"></i> 
                    Confirmar
                </button>
            </div>
          
        </form>
    </div>
</div>