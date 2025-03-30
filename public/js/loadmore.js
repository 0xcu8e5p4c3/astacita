document.addEventListener("DOMContentLoaded", function () {
    let offset = 5;
    const loadMoreBtn = document.getElementById("load-more");
    const newsContainer = document.getElementById("news-container");
    const categorySlug = loadMoreBtn.getAttribute("data-category"); // Ambil slug kategori

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener("click", function () {
            console.log("Tombol Load More diklik!"); // Debugging

            loadMoreBtn.querySelector("svg").classList.add("animate-spin"); // Animasi loading
            loadMoreBtn.disabled = true;

            fetch(`/category/${categorySlug}/loadmore?offset=${offset}`)
                .then(response => {
                    console.log("Response status:", response.status); // Debugging
                    return response.json();
                })
                .then(data => {
                    console.log("Data dari server:", data); // Debugging

                    if (data.html.trim() !== "") {
                        newsContainer.insertAdjacentHTML("beforeend", data.html);
                        offset += 5;
                        loadMoreBtn.textContent = "Load More";
                        loadMoreBtn.disabled = false;
                    } else {
                        console.log("Tidak ada artikel tambahan.");
                        loadMoreBtn.style.display = "none";
                    }
                })
                .catch(error => {
                    console.error("Error Fetch:", error);
                    alert("Gagal memuat artikel!");
                    loadMoreBtn.textContent = "Load More";
                    loadMoreBtn.disabled = false;
                });
        });
    }
});
