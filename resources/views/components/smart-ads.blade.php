{{-- resources/views/components/smart-ads.blade.php --}}
@props(['type' => null, 'position' => null, 'page' => null])

<div id="smart-ads-{{ $type }}-{{ $position }}" class="smart-ads-container">
    <!-- Ads will be loaded here via JavaScript -->
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadSmartAds('{{ $type }}', '{{ $position }}', '{{ $page ?? request()->route()->getName() }}');
});

function loadSmartAds(type, position, page) {
    const container = document.getElementById(`smart-ads-${type}-${position}`);
    if (!container) return;
    
    fetch(`/api/smart-ads?type=${type}&position=${position}&page=${page}`)
        .then(response => response.json())
        .then(data => {
            if (data.ads && data.ads.length > 0) {
                data.ads.forEach(ad => {
                    const adElement = createAdElement(ad);
                    container.appendChild(adElement);
                    
                    // Record impression
                    recordImpression(ad.id);
                });
            }
        })
        .catch(error => console.error('Error loading ads:', error));
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
        
        const img = document.createElement('img');
        img.src = ad.content.image_url;
        img.alt = ad.content.alt_text || ad.title;
        img.className = 'smart-ad-image';
        
        link.appendChild(img);
        adDiv.appendChild(link);
    }
    
    return adDiv;
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
}

.smart-ad {
    margin: 10px 0;
    text-align: center;
}

.smart-ad-banner {
    width: 100%;
    max-width: 728px;
    margin: 0 auto;
}

.smart-ad-popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

.smart-ad-sidebar {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1000;
}

.smart-ad-sidebar.smart-ad-left {
    left: 20px;
}

.smart-ad-sidebar.smart-ad-right {
    right: 20px;
}

.smart-ad-inline {
    display: inline-block;
    margin: 15px;
}

.smart-ad-image {
    max-width: 100%;
    height: auto;
    cursor: pointer;
    transition: opacity 0.3s ease;
}

.smart-ad-image:hover {
    opacity: 0.8;
}

@media (max-width: 768px) {
    .smart-ad-sidebar {
        position: relative;
        top: auto;
        left: auto;
        right: auto;
        transform: none;
        margin: 10px 0;
    }
}
</style>
@endpush