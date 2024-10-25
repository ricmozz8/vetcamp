let scroll = document.querySelector(".scroll");

function scrollLeft() {
    scroll.scrollBy(-500, 0);
}

function scrollRight() {
    scroll.scrollBy(500, 0);
}

document.querySelector(".scroll-left").addEventListener("click", scrollLeft);
document.querySelector(".scroll-right").addEventListener("click", scrollRight);