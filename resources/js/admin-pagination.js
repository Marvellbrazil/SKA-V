document.addEventListener("DOMContentLoaded", function () {
    const paginationContainer = document.getElementById("pagination-container");
    const contentContainer = document.getElementById("admin-content");

    function setupPagination() {
        if (paginationContainer) {
            paginationContainer.replaceWith(
                paginationContainer.cloneNode(true)
            );
            const newPaginationContainer = document.getElementById(
                "pagination-container"
            );

            newPaginationContainer.addEventListener("click", function (e) {
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

        contentContainer.style.opacity = "0.5";
        contentContainer.style.pointerEvents = "none";

        const separator = url.includes('?') ? '&' : '?';
        const ajaxUrl = url + separator + "ajax=1";

        fetch(ajaxUrl, {
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
                    contentContainer.style.opacity = "0";
                    setTimeout(() => {
                        contentContainer.innerHTML = newContent.innerHTML;
                        setupPagination();
                        
                        setupPagination();
                        setTimeout(() => {
                            contentContainer.style.opacity = "1";
                            contentContainer.style.pointerEvents = "auto";
                        }, 50);
                    }, 300);
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

    document.addEventListener("click", function (e) {
        if (
            e.target.closest("a.text-gray-400") ||
            e.target.closest("a.cursor-not-allowed")
        ) {
            e.preventDefault();
        }
    });
});
