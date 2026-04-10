document.addEventListener("DOMContentLoaded", function () {
    const paginationContainer = document.getElementById("pagination-container");
    const contentContainer = document.getElementById("admin-content");

    function setupPagination() {
        const container = document.getElementById("pagination-container");
        if (container) {
            container.replaceWith(container.cloneNode(true));
            const newContainer = document.getElementById("pagination-container");

            newContainer.addEventListener("click", function (e) {
                const link = e.target.closest("a");

                if (
                    link &&
                    !link.classList.contains("text-gray-400") &&
                    !link.classList.contains("cursor-not-allowed") &&
                    link.getAttribute("href") !== "#" &&
                    link.getAttribute("href") !== null
                ) {
                    e.preventDefault();
                    const url = link.getAttribute("href");

                    if (url && url !== window.location.href) {
                        loadPage(url);
                    }
                }
            });
        }
    }

    function loadPage(url) {
        if (!contentContainer) return;

        contentContainer.style.transition = "opacity 0.3s ease";
        contentContainer.style.opacity = "0.5";
        contentContainer.style.pointerEvents = "none";

        fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "text/html",
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then((html) => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");
                const newContent = doc.getElementById("admin-content");

                if (newContent) {
                    contentContainer.innerHTML = newContent.innerHTML;
                    setupPagination();
                    contentContainer.style.opacity = "1";
                    contentContainer.style.pointerEvents = "auto";
                } else {
                    window.location.href = url;
                }

                window.history.pushState({}, "", url);
            })
            .catch((error) => {
                console.error("Error:", error);
                contentContainer.style.opacity = "1";
                contentContainer.style.pointerEvents = "auto";
                window.location.href = url;
            });
    }

    setupPagination();

    window.addEventListener("popstate", function (e) {
        if (e.state) {
            loadPage(window.location.href);
        }
    });
});
