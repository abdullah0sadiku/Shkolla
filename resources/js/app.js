import './bootstrap';
document.addEventListener("DOMContentLoaded", function () {
    const button = document.getElementById("dropdownButton");
    const menu = document.getElementById("dropdownMenu");

    button.addEventListener("click", function () {
        menu.classList.toggle("hidden");
    });

    document.addEventListener("click", function (event) {
        if (!button.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add("hidden");
        }
    });
});
