document.addEventListener("DOMContentLoaded", function () {
    const $overlay = document.getElementById("overlay");
    const $dropdowns = document.querySelectorAll(".js-dropdown-menu");

    function toggleDropdown(commentId) {
        const $dropdown = document.getElementById(`dropdown-${commentId}`);

        $dropdowns.forEach((menu) => {
            if (menu !== $dropdown) {
                menu.classList.add("hidden");
            }
        });

        $dropdown.classList.toggle("hidden");

        if (!$dropdown.classList.contains("hidden")) {
            $overlay.classList.remove("hidden");
        } else {
            $overlay.classList.add("hidden");
        }
    }

    function closeDropdowns() {
        $dropdowns.forEach((menu) => {
            menu.classList.add("hidden");
        });
        $overlay.classList.add("hidden");
    }

    const $button = document.querySelectorAll(".js-button");
    $button.forEach((button) => {
        button.addEventListener("click", function (event) {
            const commentId = button.getAttribute("data-comment-id");
            toggleDropdown(commentId);
            event.stopPropagation();
        });
    });

    document.addEventListener("click", closeDropdowns);
});
