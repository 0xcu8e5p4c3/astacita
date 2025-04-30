// public/js/video-fixes.js

document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk memastikan TikTok Embed script dimuat ulang setelah konten halaman dimuat
    function reloadTikTokEmbeds() {
        // Pastikan script TikTok dimuat ulang
        if (window.tiktokScriptReloaded) return;
        
        // Hapus script lama jika ada
        const oldScript = document.querySelector('script[src*="tiktok.com/embed.js"]');
        if (oldScript) oldScript.remove();
        
        // Buat dan tambahkan script baru
        const script = document.createElement('script');
        script.src = 'https://www.tiktok.com/embed.js';
        script.async = true;
        document.body.appendChild(script);
        
        window.tiktokScriptReloaded = true;
    }
    
    // Jalankan reload setelah beberapa detik untuk memastikan DOM sudah siap
    setTimeout(reloadTikTokEmbeds, 1000);
    
    // Tambahkan observer untuk memastikan element TikTok terlihat dengan benar
    const resizeObserver = new ResizeObserver(entries => {
        for (let entry of entries) {
            // Cek jika ini adalah container TikTok
            if (entry.target.classList.contains('tiktok-embed-container')) {
                const iframe = entry.target.querySelector('iframe');
                if (iframe) {
                    // Pastikan iframe memiliki tinggi yang cukup
                    iframe.style.minHeight = '580px';
                }
            }
        }
    });
    
    // Pantau semua container TikTok
    document.querySelectorAll('.tiktok-embed-container').forEach(container => {
        resizeObserver.observe(container);
    });
});