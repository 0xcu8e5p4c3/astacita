document.addEventListener('DOMContentLoaded', function () {
    const loadMoreBtn = document.getElementById('load-more');
    const loadMoreText = document.getElementById('load-more-text'); // Ambil span teksnya

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            const page = this.getAttribute('data-page');
            const url = this.getAttribute('data-url');
            const button = this;

            button.disabled = true;
            loadMoreText.innerText = 'Loading...'; // cuma ubah teks

            fetch(`${url}?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('article-container').insertAdjacentHTML('beforeend', data.html);

                    if (data.has_more) {
                        button.setAttribute('data-page', data.next_page);
                        loadMoreText.innerText = 'View More'; // balikin teks
                        button.disabled = false;
                    } else {
                        button.remove(); // hapus tombol kalau sudah habis
                    }
                })
                .catch(error => {
                    console.error('Error loading more articles:', error);
                    loadMoreText.innerText = 'View More'; // error juga balikin
                    button.disabled = false;
                });
        });
    }
});
