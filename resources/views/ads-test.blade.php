<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart Ads Test - Semua Jenis Iklan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .smart-ads-container {
            position: relative;
            margin: 10px 0;
        }

        .smart-ad {
            margin: 10px 0;
            text-align: center;
            border: 2px dashed #28a745;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
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
            border: 3px solid #dc3545;
        }

        .smart-ad-sidebar {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
            max-width: 250px;
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
            max-width: 468px;
        }

        .smart-ad-image {
            max-width: 100%;
            height: auto;
            cursor: pointer;
            transition: opacity 0.3s ease;
            border-radius: 4px;
        }

        .smart-ad-image:hover {
            opacity: 0.8;
            transform: scale(1.02);
        }

        .test-section {
            margin: 30px 0;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: #ffffff;
        }

        .section-title {
            color: #495057;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .ads-info {
            background: #e9ecef;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .close-popup {
            position: absolute;
            top: 10px;
            right: 15px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            font-size: 16px;
            line-height: 1;
        }

        .test-content {
            min-height: 500px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            margin: 20px 0;
        }

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
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .debug-info {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            font-family: monospace;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header dengan Banner Top -->
        <div class="row">
            <div class="col-12">
                <div class="test-section">
                    <h2 class="section-title">🎯 Smart Ads Test Page - Semua Jenis Iklan</h2>
                    <div class="alert alert-info">
                        <strong>Info:</strong> Halaman ini menampilkan semua jenis iklan untuk testing. 
                        Scroll ke bawah untuk melihat berbagai posisi dan jenis ads.
                    </div>
                </div>
                
                <!-- Banner Top Ads -->
                <div class="test-section">
                    <h3 class="section-title">📱 Banner Top Ads</h3>
                    <div class="ads-info">
                        <strong>Posisi:</strong> Banner - Top | <strong>Target:</strong> Semua halaman
                    </div>
                    <x-smart-ads type="banner" position="top" page="test" />
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar Left -->
            <div class="col-md-2">
                <div class="test-section">
                    <h4 class="section-title">◀️ Sidebar Left</h4>
                    <x-smart-ads type="sidebar" position="left" page="test" />
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-8">
                <!-- Stats Overview -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="stats-card">
                            <h5>📊 Total Ads</h5>
                            <h2>{{ $allAds->count() }}</h2>
                            <small>Active: {{ $activeAds->count() }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stats-card">
                            <h5>👀 Total Impressions</h5>
                            <h2>{{ number_format($allAds->sum(function($ad) { return $ad->analytics->sum('impressions'); })) }}</h2>
                            <small>All time</small>
                        </div>
                    </div>
                </div>

                <!-- Inline Ads Test -->
                <div class="test-section">
                    <h3 class="section-title">📰 Inline Content Ads</h3>
                    <div class="ads-info">
                        <strong>Posisi:</strong> Inline - Center | <strong>Target:</strong> Blog/Article pages
                    </div>
                    
                    <div class="test-content">
                        <h4>Sample Article Content</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                        
                        <!-- Inline Ads Here -->
                        <x-smart-ads type="inline" position="center" page="blog" />
                        
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>
                    </div>
                </div>

                <!-- Popup Ads Test -->
                <div class="test-section">
                    <h3 class="section-title">🚀 Popup Ads</h3>
                    <div class="ads-info">
                        <strong>Posisi:</strong> Popup - Center | <strong>Target:</strong> Homepage
                        <br><small class="text-muted">Popup akan muncul otomatis setelah halaman dimuat</small>
                    </div>
                    <button class="btn btn-primary" onclick="loadPopupAds()">Tampilkan Popup Ads</button>
                    <div id="popup-container"></div>
                </div>

                <!-- Debug Information -->
                <div class="test-section">
                    <h3 class="section-title">🔧 Debug Information</h3>
                    <div class="debug-info">
                        <strong>Current Route:</strong> {{ request()->route()->getName() ?? 'N/A' }}<br>
                        <strong>Page Parameter:</strong> test<br>
                        <strong>Total Active Ads:</strong> {{ $activeAds->count() }}<br>
                        <strong>API Endpoint:</strong> /api/smart-ads<br>
                        <strong>Cache Status:</strong> Enabled
                    </div>
                </div>

                <!-- Active Ads List -->
                <div class="test-section">
                    <h3 class="section-title">📋 Active Ads List</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Position</th>
                                    <th>Priority</th>
                                    <th>Status</th>
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
                                    <td>
                                        <span class="badge bg-{{ $ad->is_active ? 'success' : 'danger' }}">
                                            {{ $ad->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $ad->target_pages ?? 'All Pages' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar Right -->
            <div class="col-md-2">
                <div class="test-section">
                    <h4 class="section-title">▶️ Sidebar Right</h4>
                    <x-smart-ads type="sidebar" position="right" page="test" />
                </div>
            </div>
        </div>

        <!-- Banner Bottom -->
        <div class="row">
            <div class="col-12">
                <div class="test-section">
                    <h3 class="section-title">📱 Banner Bottom Ads</h3>
                    <div class="ads-info">
                        <strong>Posisi:</strong> Banner - Bottom | <strong>Target:</strong> Semua halaman
                    </div>
                    <x-smart-ads type="banner" position="bottom" page="test" />
                </div>
            </div>
        </div>

        <!-- Test Links -->
        <div class="row">
            <div class="col-12">
                <div class="test-section">
                    <h3 class="section-title">🔗 Test Different Pages</h3>
                    <div class="btn-group" role="group">
                        <a href="{{ route('ads.test.page', 'home') }}" class="btn btn-outline-primary">Home Page</a>
                        <a href="{{ route('ads.test.page', 'blog') }}" class="btn btn-outline-primary">Blog Page</a>
                        <a href="{{ route('ads.test.page', 'about') }}" class="btn btn-outline-primary">About Page</a>
                        <a href="{{ route('ads.test.page', 'news') }}" class="btn btn-outline-primary">News Page</a>
                        <a href="/admin" target="_blank" class="btn btn-success">Open Filament Admin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('🎯 Smart Ads Test Page Loaded');
        
        // Auto load popup after 3 seconds
        setTimeout(loadPopupAds, 3000);
        
        // Log all ads containers
        const containers = document.querySelectorAll('.smart-ads-container');
        console.log(`Found ${containers.length} ads containers`);
    });

    function loadPopupAds() {
        const container = document.getElementById('popup-container');
        if (!container) return;
        
        fetch('/api/smart-ads?type=popup&position=center&page=home')
            .then(response => response.json())
            .then(data => {
                console.log('Popup ads data:', data);
                if (data.ads && data.ads.length > 0) {
                    data.ads.forEach(ad => {
                        const popupElement = createPopupElement(ad);
                        document.body.appendChild(popupElement);
                        recordImpression(ad.id);
                    });
                }
            })
            .catch(error => console.error('Error loading popup ads:', error));
    }

    function createPopupElement(ad) {
        const popupDiv = document.createElement('div');
        popupDiv.className = 'smart-ad smart-ad-popup smart-ad-center';
        popupDiv.dataset.adId = ad.id;
        
        const closeBtn = document.createElement('button');
        closeBtn.className = 'close-popup';
        closeBtn.innerHTML = '×';
        closeBtn.onclick = () => popupDiv.remove();
        
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
            popupDiv.appendChild(closeBtn);
            popupDiv.appendChild(link);
        }
        
        return popupDiv;
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

    @stack('scripts')
</body>
</html>