const themeButton = document.getElementById("theme-toggle");

function applyTheme(isDark) {
    document.body.classList.toggle("dark-mode", isDark);

    if (themeButton) {
        themeButton.textContent = isDark
            ? "Light Mode"
            : "Dark Mode";

        themeButton.setAttribute(
            "aria-pressed",
            String(isDark)
        );
    }
}

let savedTheme = null;

try {
    savedTheme = localStorage.getItem("theme");
} catch {
}

applyTheme(savedTheme === "dark");

if (themeButton) {
    themeButton.addEventListener("click", function () {
        const isDark =  !document.body.classList.contains("dark-mode");

        applyTheme(isDark);

        try {
            localStorage.setItem(
                "theme",
                isDark ? "dark" : "light"
            );
        } catch {
        }
    });
}