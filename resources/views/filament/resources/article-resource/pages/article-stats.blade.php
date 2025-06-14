<x-filament-panels::page>
    @php
        $data = $this->getViewData();
        extract($data);
    @endphp
    
    <div class="grid gap-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Views</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalViews) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Hari Ini</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($todayViews) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Minggu Ini</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($weekViews) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Bulan Ini</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($monthViews) }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Daily Views Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Views Harian (30 Hari Terakhir)</h3>
                <canvas id="dailyViewsChart" width="400" height="200"></canvas>
            </div>
            
            <!-- Top Referrers -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Top Referrers</h3>
                <div class="space-y-3">
                    @forelse($topReferrers as $referrer)
                        <div class="flex items-center justify-between">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900 truncate">
                                    @if(filter_var($referrer->referrer, FILTER_VALIDATE_URL))
                                        {{ parse_url($referrer->referrer, PHP_URL_HOST) ?: 'Direct' }}
                                    @else
                                        {{ $referrer->referrer ?: 'Direct' }}
                                    @endif
                                </p>
                            </div>
                            <div class="ml-2 flex-shrink-0">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $referrer->count }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada data referrer</p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- Article Info -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Artikel</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">Judul</p>
                    <p class="text-sm text-gray-900">{{ $article->title }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Status</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        @if($article->status === 'published') bg-green-100 text-green-800
                        @elseif($article->status === 'draft') bg-gray-100 text-gray-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ucfirst($article->status) }}
                    </span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Tanggal Publikasi</p>
                    <p class="text-sm text-gray-900">{{ $article->published_at?->format('d M Y H:i') ?? 'Belum dipublikasi' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Dibuat</p>
                    <p class="text-sm text-gray-900">{{ $article->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Daily Views Chart
            const ctx = document.getElementById('dailyViewsChart').getContext('2d');
            
            // Prepare data for last 30 days
            const dailyViewsData = @json($dailyViews);
            const labels = [];
            const data = [];
            
            for (let i = 29; i >= 0; i--) {
                const date = new Date();
                date.setDate(date.getDate() - i);
                const dateString = date.toISOString().split('T')[0];
                const formattedDate = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
                
                labels.push(formattedDate);
                data.push(dailyViewsData[dateString] || 0);
            }
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Views',
                        data: data,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-filament-panels::page>