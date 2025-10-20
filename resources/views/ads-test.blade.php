<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart Ads Testing Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
        }

        body {
            background: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .test-header {
            background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%);
            color: white;
            padding: 2rem;
            margin-bottom: 2rem;
            border-radius: 0 0 1rem 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .ad-slot {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border: 2px solid #e2e8f0;
            position: relative;
        }

        .ad-slot-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .ad-slot-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .ad-status {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-loaded {
            background: #d1fae5;
            color: #065f46;
        }

        .status-empty {
            background: #fef3c7;
            color: #92400e;
        }

        .status-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .ad-preview-area {
            min-height: 120px;
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .ad-preview-area.has-ad {
            border-color: var(--success);
            background: white;
        }

        .ad-preview-area.empty {
            border-color: var(--warning);
        }

        .empty-state {
            text-align: center;
            color: #64748b;
            padding: 2rem;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            opacity: 0.3;
        }

        .debug-panel {
            background: #fefce8;
            border-left: 4px solid var(--warning);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
            font-size: 0.85rem;
        }

        .debug-item {
            display: flex;
            gap: 0.5rem;
            padding: 0.25rem 0;
        }

        .debug-label {
            font-weight: 600;
            color: #92400e;
            min-width: 120px;
        }

        .debug-value {
            color: #451a03;
            font-family: 'Courier New', monospace;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border-left: 4px solid var(--primary);
        }

        .stat-label {
            font-size: 0.875rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-top: 0.5rem;
        }

        .test-controls {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .btn-test {
            margin: 0.25rem;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        .info-box {
            background: #eff6ff;
            border-left: 4px solid var(--info);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .ad-slot-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }

        /* Popup Overlay */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9998;
            display: none;
        }

        .popup-overlay.show {
            display: block;
        }

        /* Loading Animation */
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e2e8f0;
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="test-header">
        <div class="container">
            <h1 class="mb-2">🎯 Smart Ads Testing Dashboard</h1>
            <p class="mb-0 opacity-75">Test semua posisi iklan dan lihat status real-time</p>
        </div>
    </div>

    <div class="container">
        <!-- Stats Overview -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Ads</div>
                <div class="stat-value">{{ $allAds->count() }}</div>
            </div>
            <div class="stat-card" style="border-left-color: var(--success)">
                <div class="stat-label">Active Ads</div>
                <div class="stat-value">{{ $activeAds->count() }}</div>
            </div>
            <div class="stat-card" style="border-left-color: var(--warning)">
                <div class="stat-label">Impressions</div>
                <div class="stat-value">{{ number_format($allAds->sum(function($ad) { return $ad->analytics->sum('impressions'); })) }}</div>
            </div>
            <div class="stat-card" style="border-left-color: var(--info)">
                <div class="stat-label">Active Slots</div>
                <div class="stat-value" id="active-slots-count">0</div>
            </div>
        </div>

        <!-- Test Controls -->
        <div class="test-controls">
            <h5 class="mb-3">🔧 Test Controls</h5>
            <div class="info-box">
                <strong>💡 Tips:</strong> Klik tombol di bawah untuk test berbagai halaman atau reload semua iklan
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-primary btn-test" onclick="reloadAllAds()">🔄 Reload All Ads</button>
                <button class="btn btn-success btn-test" onclick="testPopup()">🚀 Test Popup</button>
                <a href="{{ route('ads.test.page', 'home') }}" class="btn btn-outline-secondary btn-test">Home Page</a>
                <a href="{{ route('ads.test.page', 'blog') }}" class="btn btn-outline-secondary btn-test">Blog Page</a>
                <a href="{{ route('ads.test.page', 'about') }}" class="btn btn-outline-secondary btn-test">About Page</a>
                <a href="/admin" target="_blank" class="btn btn-outline-primary btn-test">Open Admin</a>
            </div>
        </div>

        <!-- Banner Top -->
        <div class="ad-slot" data-type="banner" data-position="top">
            <div class="ad-slot-header">
                <div class="ad-slot-title">
                    📱 Banner Top
                </div>
                <div class="ad-status">
                    <span class="status-badge status-empty" id="status-banner-top">Checking...</span>
                </div>
            </div>
            <div class="ad-preview-area" id="preview-banner-top">
                <div class="loading-spinner"></div>
            </div>
            <div class="debug-panel" id="debug-banner-top" style="display:none;"></div>
        </div>

        <div class="row">
            <!-- Sidebar Left -->
            <div class="col-md-3">
                <div class="ad-slot" data-type="sidebar" data-position="left">
                    <div class="ad-slot-header">
                        <div class="ad-slot-title">
                            ◀️ Sidebar Left
                        </div>
                        <div class="ad-status">
                            <span class="status-badge status-empty" id="status-sidebar-left">Checking...</span>
                        </div>
                    </div>
                    <div class="ad-preview-area" id="preview-sidebar-left">
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="debug-panel" id="debug-sidebar-left" style="display:none;"></div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-6">
                <!-- Inline Ad -->
                <div class="ad-slot" data-type="inline" data-position="center">
                    <div class="ad-slot-header">
                        <div class="ad-slot-title">
                            📰 Inline Content Ad
                        </div>
                        <div class="ad-status">
                            <span class="status-badge status-empty" id="status-inline-center">Checking...</span>
                        </div>
                    </div>
                    <div class="ad-preview-area" id="preview-inline-center">
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="debug-panel" id="debug-inline-center" style="display:none;"></div>
                </div>

                <!-- Sample Content -->
                <div class="ad-slot">
                    <div class="ad-slot-header">
                        <div class="ad-slot-title">📄 Sample Content</div>
                    </div>
                    <div style="padding: 1rem; line-height: 1.6; color: #64748b;">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar Right -->
            <div class="col-md-3">
                <div class="ad-slot" data-type="sidebar" data-position="right">
                    <div class="ad-slot-header">
                        <div class="ad-slot-title">
                            ▶️ Sidebar Right
                        </div>
                        <div class="ad-status">
                            <span class="status-badge status-empty" id="status-sidebar-right">Checking...</span>
                        </div>
                    </div>
                    <div class="ad-preview-area" id="preview-sidebar-right">
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="debug-panel" id="debug-sidebar-right" style="display:none;"></div>
                </div>
            </div>
        </div>

        <!-- Banner Bottom -->
        <div class="ad-slot" data-type="banner" data-position="bottom">
            <div class="ad-slot-header">
                <div class="ad-slot-title">
                    📱 Banner Bottom
                </div>
                <div class="ad-status">
                    <span class="status-badge status-empty" id="status-banner-bottom">Checking...</span>
                </div>
            </div>
            <div class="ad-preview-area" id="preview-banner-bottom">
                <div class="loading-spinner"></div>
            </div>
            <div class="debug-panel" id="debug-banner-bottom" style="display:none;"></div>
        </div>

        <!-- Active Ads Table -->
        @if($activeAds->count() > 0)
        <div class="ad-slot">
            <div class="ad-slot-header">
                <div class="ad-slot-title">📋 Active Ads Configuration</div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Position</th>
                            <th>Priority</th>
                            <th>Target Pages</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeAds as $ad)
                        <tr>
                            <td>{{ $ad->title }}</td>
                            <td><span class="badge bg-primary">{{ $ad->type }}</span></td>
                            <td><span class="badge bg-secondary">{{ $ad->position }}</span></td>
                            <td>{{ $ad->priority }}</td>
                            <td><small class="text-muted">{{ $ad->target_pages ?? 'All Pages' }}</small></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    <!-- Popup Overlay -->
    <div class="popup-overlay" id="popup-overlay" onclick="closePopup()"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const adSlots = [
        { type: 'banner', position: 'top' },
        { type: 'sidebar', position: 'left' },
        { type: 'inline', position: 'center' },
        { type: 'sidebar', position: 'right' },
        { type: 'banner', position: 'bottom' }
    ];

    let activeSlots = 0;

    document.addEventListener('DOMContentLoaded', function() {
        console.log('🎯 Smart Ads Test Dashboard Loaded');
        loadAllAds();
    });

    function loadAllAds() {
        activeSlots = 0;
        adSlots.forEach(slot => loadAd(slot.type, slot.position));
    }

    function reloadAllAds() {
        adSlots.forEach(slot => {
            const preview = document.getElementById(`preview-${slot.type}-${slot.position}`);
            preview.innerHTML = '<div class="loading-spinner"></div>';
            preview.classList.remove('has-ad', 'empty');
        });
        loadAllAds();
    }

    function loadAd(type, position) {
        const page = '{{ request()->segment(3) ?? "test" }}';
        const statusEl = document.getElementById(`status-${type}-${position}`);
        const previewEl = document.getElementById(`preview-${type}-${position}`);
        const debugEl = document.getElementById(`debug-${type}-${position}`);

        fetch(`/api/smart-ads?type=${type}&position=${position}&page=${page}`)
            .then(response => response.json())
            .then(data => {
                if (data.ads && data.ads.length > 0) {
                    renderAd(data.ads[0], previewEl);
                    statusEl.textContent = 'Loaded';
                    statusEl.className = 'status-badge status-loaded';
                    previewEl.classList.add('has-ad');
                    recordImpression(data.ads[0].id);
                    activeSlots++;
                    showDebug(debugEl, data.ads[0], true);
                } else {
                    showEmptyState(previewEl, type, position);
                    statusEl.textContent = 'No Ads';
                    statusEl.className = 'status-badge status-empty';
                    previewEl.classList.add('empty');
                    showDebug(debugEl, { type, position, page }, false);
                }
                updateActiveSlots();
            })
            .catch(error => {
                console.error(`Error loading ${type}-${position}:`, error);
                statusEl.textContent = 'Error';
                statusEl.className = 'status-badge status-error';
                showErrorState(previewEl);
                showDebug(debugEl, { error: error.message }, false);
            });
    }

    function renderAd(ad, container) {
        if (ad.content.image_url) {
            const link = document.createElement('a');
            link.href = ad.content.link_url || '#';
            link.target = '_blank';
            link.onclick = () => recordClick(ad.id);
            
            const img = document.createElement('img');
            img.src = ad.content.image_url;
            img.alt = ad.content.alt_text || ad.title;
            img.style.maxWidth = '100%';
            img.style.height = 'auto';
            img.style.borderRadius = '8px';
            
            link.appendChild(img);
            container.innerHTML = '';
            container.appendChild(link);
        }
    }

    function showEmptyState(container, type, position) {
        container.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div><strong>No ads available</strong></div>
                <small class="text-muted">Type: ${type} | Position: ${position}</small>
            </div>
        `;
    }

    function showErrorState(container) {
        container.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-icon">⚠️</div>
                <div><strong>Error loading ad</strong></div>
            </div>
        `;
    }

    function showDebug(debugEl, data, hasAd) {
        let debugHtml = '<strong>🔍 Debug Info:</strong><br>';
        
        if (hasAd) {
            debugHtml += `
                <div class="debug-item"><span class="debug-label">✅ Ad Found:</span><span class="debug-value">${data.title}</span></div>
                <div class="debug-item"><span class="debug-label">Type:</span><span class="debug-value">${data.type}</span></div>
                <div class="debug-item"><span class="debug-label">Position:</span><span class="debug-value">${data.position}</span></div>
                <div class="debug-item"><span class="debug-label">Priority:</span><span class="debug-value">${data.priority}</span></div>
            `;
        } else {
            debugHtml += `
                <div class="debug-item"><span class="debug-label">❌ Reason:</span><span class="debug-value">No active ads match criteria</span></div>
                <div class="debug-item"><span class="debug-label">Checked:</span><span class="debug-value">type=${data.type}, position=${data.position}</span></div>
                <div class="debug-item"><span class="debug-label">Page:</span><span class="debug-value">${data.page || 'test'}</span></div>
                <div class="debug-item"><span class="debug-label">💡 Fix:</span><span class="debug-value">Create ad in admin with matching type/position</span></div>
            `;
        }
        
        debugEl.innerHTML = debugHtml;
        debugEl.style.display = 'block';
    }

    function updateActiveSlots() {
        document.getElementById('active-slots-count').textContent = activeSlots;
    }

    function testPopup() {
        fetch('/api/smart-ads?type=popup&position=center&page=home')
            .then(response => response.json())
            .then(data => {
                if (data.ads && data.ads.length > 0) {
                    const overlay = document.getElementById('popup-overlay');
                    overlay.classList.add('show');
                    
                    const popup = createPopupElement(data.ads[0]);
                    document.body.appendChild(popup);
                    recordImpression(data.ads[0].id);
                } else {
                    alert('❌ No popup ads available. Create a popup ad in admin first.');
                }
            });
    }

    function createPopupElement(ad) {
        const popup = document.createElement('div');
        popup.style.cssText = `
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            max-width: 90%;
        `;
        
        const closeBtn = document.createElement('button');
        closeBtn.textContent = '×';
        closeBtn.style.cssText = `
            position: absolute;
            top: 10px;
            right: 15px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer;
            font-size: 20px;
        `;
        closeBtn.onclick = closePopup;
        
        const img = document.createElement('img');
        img.src = ad.content.image_url;
        img.style.maxWidth = '100%';
        img.style.borderRadius = '8px';
        img.style.cursor = 'pointer';
        img.onclick = () => {
            if (ad.content.link_url) {
                recordClick(ad.id);
                window.open(ad.content.link_url, '_blank');
            }
        };
        
        popup.appendChild(closeBtn);
        popup.appendChild(img);
        return popup;
    }

    function closePopup() {
        document.getElementById('popup-overlay').classList.remove('show');
        document.querySelectorAll('[style*="z-index: 9999"]').forEach(el => el.remove());
    }

    function recordImpression(adId) {
        fetch(`/api/smart-ads/${adId}/impression`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).catch(e => console.log('Impression logged'));
    }

    function recordClick(adId) {
        fetch(`/api/smart-ads/${adId}/click`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).catch(e => console.log('Click logged'));
    }
    </script>
</body>
</html>