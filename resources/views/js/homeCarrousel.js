



/**
 * Scroll the carrousel to the right by the width of one image
 * @function scrollRight
 */

function scroll_by_right() {
    let carroussel = document.querySelector(".carroussel");
    carroussel.scrollBy({ left: 350, behavior: "smooth" });
}

/**
 * Scrolls the carousel to the left by the width of one image.
 * Utilizes smooth scrolling behavior to enhance user experience.
 */
function scroll_by_left() {
    let carroussel = document.querySelector(".carroussel");
    carroussel.scrollBy({ left: -350, behavior: "smooth" });

}