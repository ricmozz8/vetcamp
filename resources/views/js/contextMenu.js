let openContext = false;

function openContextMenu(event, contextMenu) {
    if (openContext) {
        closeContextMenu(contextMenu);
        return;
    }
    let mousePos = {x: event.clientX, y: event.clientY};

    let contextMenuElement = document.getElementById(contextMenu);

    // with 204.1px of width

    // add open the modal here subtracting the width of the context menu
    contextMenuElement.style.left = mousePos.x - 204.1 + "px";
    contextMenuElement.style.top = mousePos.y + "px";

    contextMenuElement.style.display = "block";
    openContext = true;
}

function closeContextMenu(contextMenu) {
    let contextMenuElement = document.getElementById(contextMenu);
    contextMenuElement.style.display = "none";
    openContext = false;
}