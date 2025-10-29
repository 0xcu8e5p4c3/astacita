<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Ticker Bar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        .crypto-ticker {
            animation: scroll 40s linear infinite;
        }

        .crypto-ticker:hover {
            animation-play-state: paused;
        }

        .crypto-item {
            min-width: 200px;
            flex-shrink: 0;
        }

        @media (max-width: 640px) {
            .crypto-item {
                min-width: 160px;
            }
        }

        .price-up {
            color: #10b981;
        }

        .price-down {
            color: #ef4444;
        }

        .loading-skeleton {
            background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
            background-size: 200% 100%;
            animation: loading 1.5s ease-in-out infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Crypto Ticker Bar -->
    <div class="w-full bg-white shadow-sm border-b border-gray-200 overflow-hidden">
        <div class="relative py-3">
            <!-- Loading State -->
            <div id="loadingState" class="flex justify-center items-center">
                <div class="flex gap-4 px-4">
                    <div class="loading-skeleton h-8 w-40 rounded"></div>
                    <div class="loading-skeleton h-8 w-40 rounded"></div>
                    <div class="loading-skeleton h-8 w-40 rounded"></div>
                    <div class="loading-skeleton h-8 w-40 rounded"></div>
                </div>
            </div>

            <!-- Ticker Container -->
            <div id="tickerContainer" class="hidden flex items-center">
                <div class="crypto-ticker flex gap-6 px-4">
                    <!-- Crypto items will be inserted here dynamically -->
                </div>
            </div>

            <!-- Error State -->
            <div id="errorState" class="hidden text-center py-2">
                <p class="text-sm text-red-600">Unable to load crypto data. Using demo mode.</p>
            </div>
        </div>
    </div>

    <!-- Demo Preview (Remove this section when integrating) -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Live Crypto Ticker Bar</h2>
            <p class="text-gray-600 mb-4">This ticker displays real-time data for the top 10 cryptocurrencies by market cap.</p>
            
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <h3 class="font-semibold text-blue-900 mb-2">⚠️ API Key Required</h3>
                <p class="text-sm text-blue-800 mb-2">To use live data, you need a CoinMarketCap API key:</p>
                <ol class="text-sm text-blue-800 list-decimal list-inside space-y-1 ml-2">
                    <li>Get free API key at <a href="https://coinmarketcap.com/api/" target="_blank" class="underline font-medium">coinmarketcap.com/api</a></li>
                    <li>Replace 'YOUR_API_KEY_HERE' in the code with your actual API key</li>
                    <li>The ticker will automatically update every 60 seconds</li>
                </ol>
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <h3 class="font-semibold text-gray-900 mb-2">Features:</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li>✓ Real-time prices from CoinMarketCap API</li>
                    <li>✓ Smooth auto-scrolling animation (pauses on hover)</li>
                    <li>✓ Color-coded 24h price changes (green = up, red = down)</li>
                    <li>✓ Fully responsive design for mobile and desktop</li>
                    <li>✓ Automatic data refresh every 60 seconds</li>
                    <li>✓ Loading skeleton and error handling</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // CoinMarketCap API Configuration
        const API_KEY = 'YOUR_API_KEY_HERE'; // Replace with your actual API key
        const API_URL = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        const USE_DEMO_MODE = API_KEY === 'YOUR_API_KEY_HERE'; // Auto switch to demo if no key

        // Demo data for testing without API key
        const DEMO_DATA = [
            { name: 'Bitcoin', symbol: 'BTC', price: 67234.56, change: 2.34 },
            { name: 'Ethereum', symbol: 'ETH', price: 3456.78, change: -1.23 },
            { name: 'Tether', symbol: 'USDT', price: 1.00, change: 0.01 },
            { name: 'BNB', symbol: 'BNB', price: 598.34, change: 3.45 },
            { name: 'Solana', symbol: 'SOL', price: 156.78, change: 5.67 },
            { name: 'XRP', symbol: 'XRP', price: 0.6234, change: -2.34 },
            { name: 'Cardano', symbol: 'ADA', price: 0.5678, change: 1.89 },
            { name: 'Dogecoin', symbol: 'DOGE', price: 0.1234, change: 4.56 },
            { name: 'TRON', symbol: 'TRX', price: 0.1678, change: -0.89 },
            { name: 'Polygon', symbol: 'MATIC', price: 0.8456, change: 2.78 }
        ];

        const loadingState = document.getElementById('loadingState');
        const tickerContainer = document.getElementById('tickerContainer');
        const errorState = document.getElementById('errorState');

        function formatPrice(price) {
            if (price >= 1) {
                return `$${price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
            } else {
                return `$${price.toFixed(6)}`;
            }
        }

        function formatChange(change) {
            const sign = change >= 0 ? '+' : '';
            return `${sign}${change.toFixed(2)}%`;
        }

        function createCryptoItem(crypto) {
            const changeClass = crypto.change >= 0 ? 'price-up' : 'price-down';
            const arrow = crypto.change >= 0 ? '▲' : '▼';
            
            return `
                <div class="crypto-item flex items-center gap-3 bg-gray-50 rounded-lg px-4 py-2 hover:bg-gray-100 transition-colors">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-gray-800 text-sm">${crypto.symbol}</span>
                        <span class="text-xs text-gray-500 hidden sm:inline">${crypto.name}</span>
                    </div>
                    <div class="flex items-center gap-2 ml-auto">
                        <span class="font-semibold text-gray-900 text-sm">${formatPrice(crypto.price)}</span>
                        <span class="${changeClass} text-xs font-medium flex items-center gap-1">
                            <span class="text-[10px]">${arrow}</span>
                            ${formatChange(crypto.change)}
                        </span>
                    </div>
                </div>
            `;
        }

        async function fetchCryptoData() {
            if (USE_DEMO_MODE) {
                return DEMO_DATA;
            }

            try {
                const response = await fetch(`${API_URL}?limit=10&convert=USD`, {
                    headers: {
                        'X-CMC_PRO_API_KEY': API_KEY,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('API request failed');
                }

                const data = await response.json();
                
                return data.data.map(coin => ({
                    name: coin.name,
                    symbol: coin.symbol,
                    price: coin.quote.USD.price,
                    change: coin.quote.USD.percent_change_24h
                }));
            } catch (error) {
                console.error('Error fetching crypto data:', error);
                errorState.classList.remove('hidden');
                return DEMO_DATA;
            }
        }

        function updateTicker(cryptoData) {
            const ticker = tickerContainer.querySelector('.crypto-ticker');
            
            // Create items HTML
            const itemsHTML = cryptoData.map(createCryptoItem).join('');
            
            // Duplicate items for seamless loop
            ticker.innerHTML = itemsHTML + itemsHTML;
            
            // Show ticker, hide loading
            loadingState.classList.add('hidden');
            tickerContainer.classList.remove('hidden');
        }

        async function init() {
            const cryptoData = await fetchCryptoData();
            updateTicker(cryptoData);
            
            // Refresh data every 60 seconds
            setInterval(async () => {
                const newData = await fetchCryptoData();
                updateTicker(newData);
            }, 60000);
        }

        // Initialize on page load
        init();
    </script>
</body>
</html>