document.addEventListener("DOMContentLoaded", function () {
    let offset = document.querySelectorAll("#news-container > div").length;
    const loadMoreBtn = document.getElementById("load-more");
    const newsContainer = document.getElementById("news-container");

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener("click", function () {
            loadMoreBtn.querySelector("svg")?.classList.add("animate-spin");
            loadMoreBtn.disabled = true;

            const url = loadMoreBtn.getAttribute("data-url") + `?offset=${offset}`;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                loadMoreBtn.querySelector("svg")?.classList.remove("animate-spin");

                if (data.html.trim() !== "") {
                    newsContainer.insertAdjacentHTML("beforeend", data.html);
                    offset = document.querySelectorAll("#news-container > div").length;
                }

                if (!data.hasMore || data.html.trim() === "") {
                    loadMoreBtn.style.display = "none";
                    const message = document.createElement("p");
                    message.className = "text-center text-gray-500 my-4";
                    message.textContent = "Semua artikel telah dimuat.";
                    newsContainer.appendChild(message);
                } else {
                    loadMoreBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error("Gagal fetch:", error);
                alert("Gagal memuat artikel!");
                loadMoreBtn.querySelector("svg")?.classList.remove("animate-spin");
                loadMoreBtn.disabled = false;
            });
        });
    }
});
