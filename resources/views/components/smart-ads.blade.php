{{-- resources/views/components/smart-ads.blade.php --}}
@props(['type' => null, 'position' => null, 'page' => null])

<div id="smart-ads-{{ $type }}-{{ $position }}" class="smart-ads-container" data-type="{{ $type }}" data-position="{{ $position }}">
    <!-- Loading Animation -->
    <div class="ads-loading">
        <div class="spinner-wrapper">
            <div class="spinner"></div>
            <p class="loading-text">Memuat iklan...</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadSmartAds('{{ $type }}', '{{ $position }}', '{{ $page ?? request()->route()->getName() }}');
});

function loadSmartAds(type, position, page) {
    const container = document.getElementById(`smart-ads-${type}-${position}`);
    if (!container) return;
    
    const loadingElement = container.querySelector('.ads-loading');
    
    // Simulasi loading (hapus setTimeout ini dan gunakan fetch asli)
    setTimeout(() => {
        fetch(`/api/smart-ads?type=${type}&position=${position}&page=${page}`)
            .then(response => response.json())
            .then(data => {
                // Fade out loading
                loadingElement.style.opacity = '0';
                
                setTimeout(() => {
                    loadingElement.remove();
                    
                    if (data.ads && data.ads.length > 0) {
                        data.ads.forEach((ad, index) => {
                            const adElement = createAdElement(ad);
                            container.appendChild(adElement);
                            
                            // Staggered animation
                            setTimeout(() => {
                                adElement.classList.add('ads-visible');
                            }, index * 100);
                            
                            // Record impression
                            recordImpression(ad.id);
                        });
                    } else {
                        // No ads available
                        showNoAds(container);
                    }
                }, 300);
            })
            .catch(error => {
                console.error('Error loading ads:', error);
                loadingElement.style.opacity = '0';
                setTimeout(() => {
                    loadingElement.remove();
                    showNoAds(container);
                }, 300);
            });
    }, 1500); // Simulasi delay, hapus ini untuk production
}

function createAdElement(ad) {
    const adDiv = document.createElement('div');
    adDiv.className = `smart-ad smart-ad-${ad.type} smart-ad-${ad.position}`;
    adDiv.dataset.adId = ad.id;
    
    if (ad.content.image_url) {
        const link = document.createElement('a');
        link.href = ad.content.link_url || '#';
        link.target = '_blank';
        link.onclick = () => recordClick(ad.id);
        link.className = 'smart-ad-link';
        
        const img = document.createElement('img');
        img.src = ad.content.image_url;
        img.alt = ad.content.alt_text || ad.title;
        img.className = 'smart-ad-image';
        
        // Optional: Add title overlay
        if (ad.title) {
            const overlay = document.createElement('div');
            overlay.className = 'smart-ad-overlay';
            overlay.innerHTML = `<span>${ad.title}</span>`;
            link.appendChild(overlay);
        }
        
        link.appendChild(img);
        adDiv.appendChild(link);
    }
    
    return adDiv;
}

function showNoAds(container) {
    const noAdsDiv = document.createElement('div');
    noAdsDiv.className = 'no-ads-message';
    noAdsDiv.innerHTML = `
        <div class="no-ads-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <p>Tidak ada iklan tersedia</p>
    `;
    container.appendChild(noAdsDiv);
    
    setTimeout(() => {
        noAdsDiv.classList.add('ads-visible');
    }, 50);
}

function recordImpression(adId) {
    fetch(`/api/smart-ads/${adId}/impression`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).catch(error => console.error('Error recording impression:', error));
}

function recordClick(adId) {
    fetch(`/api/smart-ads/${adId}/click`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).catch(error => console.error('Error recording click:', error));
}
</script>

<style>
.smart-ads-container {
    position: relative;
    min-height: 100px;
}

/* Loading Animation */
.ads-loading {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 150px;
    opacity: 1;
    transition: opacity 0.3s ease;
}

.spinner-wrapper {
    text-align: center;
}

.spinner {
    width: 50px;
    height: 50px;
    margin: 0 auto 15px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-text {
    color: #666;
    font-size: 14px;
    margin: 0;
    animation: pulse 1.5s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 0.6; }
    50% { opacity: 1; }
}

/* No Ads Message */
.no-ads-message {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 30px 20px;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 16px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.no-ads-message.ads-visible {
    opacity: 1;
    transform: translateY(0);
}

.no-ads-icon {
    width: 60px;
    height: 60px;
    margin-bottom: 15px;
    color: #7f8c8d;
    animation: bounce 2s infinite;
}

.no-ads-icon svg {
    width: 100%;
    height: 100%;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.no-ads-message p {
    margin: 0;
    color: #555;
    font-size: 16px;
    font-weight: 500;
}

/* Smart Ad Container */
.smart-ad {
    margin: 15px 0;
    opacity: 0;
    transform: translateY(30px) scale(0.95);
    transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.smart-ad.ads-visible {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.smart-ad-link {
    display: block;
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.smart-ad-link:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.smart-ad-image {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.4s ease;
}

.smart-ad-link:hover .smart-ad-image {
    transform: scale(1.05);
}

/* Overlay for title */
.smart-ad-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    color: white;
    padding: 20px 15px 15px;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
}

.smart-ad-link:hover .smart-ad-overlay {
    opacity: 1;
    transform: translateY(0);
}

.smart-ad-overlay span {
    font-size: 16px;
    font-weight: 600;
}

/* Banner Ads */
.smart-ad-banner {
    max-width: 728px;
    margin: 0 auto;
}

/* Popup Ads */
.smart-ad-popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.8);
    z-index: 9999;
    background: white;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    max-width: 90%;
}

.smart-ad-popup.ads-visible {
    transform: translate(-50%, -50%) scale(1);
}

/* Sidebar Ads */
.smart-ad-sidebar {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1000;
    max-width: 300px;
}

.smart-ad-sidebar.smart-ad-left {
    left: 20px;
}

.smart-ad-sidebar.smart-ad-right {
    right: 20px;
}

/* Inline Ads */
.smart-ad-inline {
    display: inline-block;
    margin: 15px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .smart-ad-sidebar {
        position: relative;
        top: auto;
        left: auto;
        right: auto;
        transform: none;
        margin: 10px auto;
        max-width: 100%;
    }
    
    .smart-ad-banner {
        max-width: 100%;
    }
    
    .smart-ad-popup {
        max-width: 95%;
        padding: 15px;
    }
    
    .no-ads-icon {
        width: 50px;
        height: 50px;
    }
}

/* Smooth scrolling untuk konten */
@media (prefers-reduced-motion: no-preference) {
    .smart-ad {
        scroll-margin-top: 100px;
    }
}
</style>
@endpush