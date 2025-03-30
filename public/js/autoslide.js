document.addEventListener("DOMContentLoaded", function () {
    fetch('/trending') // Ambil data trending dari backend
        .then(response => response.json())
        .then(data => {
            let container = document.getElementById("carousel");
            container.innerHTML = "";

            let slides = ""; // Menampung HTML setiap slide
            for (let i = 0; i < data.length; i += 4) {
                let group = data.slice(i, i + 4); // Ambil 4 artikel per slide
                let slideContent = `
                    <div class="flex justify-between gap-4 min-w-full">
                `;
                group.forEach(article => {
                    slideContent += `
                        <a href="#" class="flex flex-col bg-white p-4 rounded-lg shadow hover:bg-green-200 transition w-1/4">
                            <img src="${article.image}" class="rounded-full w-12 h-12 object-cover mb-2" alt="Image">
                            <span class="bg-black text-white text-xs font-semibold px-2 py-1 rounded-md">
                                ${article.category ?? 'Unknown'}
                            </span>
                            <div class="text-sm font-bold mt-2">${article.title}</div>
                        </a>
                    `;
                });
                slideContent += `</div>`; // Tutup div slide
                slides += slideContent; // Gabungkan dengan slides lainnya
            }

            container.innerHTML = slides; // Masukkan semua slides ke dalam carousel

            // Sliding otomatis dan manual
            let index = 0;
            const totalSlides = container.children.length;

            function slideNext() {
                index = (index + 1) % totalSlides;
                container.style.transform = `translateX(-${index * 100}%)`;
            }

            function slidePrev() {
                index = (index - 1 + totalSlides) % totalSlides;
                container.style.transform = `translateX(-${index * 100}%)`;
            }

            document.getElementById("next").addEventListener("click", slideNext);
            document.getElementById("prev").addEventListener("click", slidePrev);

            setInterval(slideNext, 4000); // Auto-slide setiap 4 detik
        })
        .catch(error => console.error("Error fetching trending topics:", error));
});
