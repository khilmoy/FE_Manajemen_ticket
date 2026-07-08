document.addEventListener("DOMContentLoaded", () => {

    const button = document.getElementById("accountButton");
    const menu = document.getElementById("accountMenu");

    if (!button || !menu) return;

    button.addEventListener("click", function (e) {
        e.stopPropagation();
        menu.classList.toggle("hidden");
    });

    document.addEventListener("click", function (e) {

        if (!menu.contains(e.target) && !button.contains(e.target)) {
            menu.classList.add("hidden");
        }

    });

});