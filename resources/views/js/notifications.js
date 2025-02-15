document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        document.querySelectorAll('.notification').forEach(function (element) {
            element.style.transition = "opacity 0.5s";
            element.style.opacity = "0";
            setTimeout(function () {
                element.style.display = "none";
            }, 500);
        });
    }, 5000);
});