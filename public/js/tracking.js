// tracking.js - Sistem tracking menggunakan JavaScript
class WebsiteTracker {
    constructor() {
        this.sessionId = this.getOrCreateSessionId();
        this.startTime = Date.now();
        this.apiEndpoint = '/api/track';
        this.visitEndpoint = '/api/visit';
        this.eventEndpoint = '/api/track-event';
        this.durationEndpoint = '/api/visit/duration';
        this.init();
    }

    // Membuat atau mendapatkan session ID dari localStorage
    getOrCreateSessionId() {
        let sessionId = localStorage.getItem('website_session_id');
        if (!sessionId) {
            sessionId = this.generateSessionId();
            localStorage.setItem('website_session_id', sessionId);
        }
        return sessionId;
    }

    // Generate unique session ID
    generateSessionId() {
        return 'sess_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    }

    // Initialize tracking
    init() {
        // Track page visit
        this.trackVisit();
        
        // Track article view jika ada article ID
        const articleId = this.getArticleId();
        if (articleId) {
            this.trackArticleView(articleId);
        }

        // Track durasi ketika user akan meninggalkan halaman
        this.trackPageDuration();
    }

    // Mendapatkan article ID dari meta tag atau data attribute
    getArticleId() {
        const metaTag = document.querySelector('meta[name="article-id"]');
        if (metaTag) {
            return metaTag.getAttribute('content');
        }
        
        const dataAttribute = document.querySelector('[data-article-id]');
        if (dataAttribute) {
            return dataAttribute.getAttribute('data-article-id');
        }
        
        return null;
    }

    // Get CSRF token
    getCSRFToken() {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        return token || '';
    }

    // Track website visit
    async trackVisit() {
        const visitData = {
            session_id: this.sessionId,
            page_url: window.location.href,
            referrer: document.referrer || '',
            user_agent: navigator.userAgent,
            visited_at: new Date().toISOString()
        };

        try {
            const response = await fetch(this.visitEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.getCSRFToken()
                },
                body: JSON.stringify(visitData)
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('Visit tracked successfully:', result);
        } catch (error) {
            console.error('Error tracking visit:', error);
        }
    }

    // Track article view
    async trackArticleView(articleId) {
        const viewData = {
            article_id: parseInt(articleId),
            session_id: this.sessionId,
            user_agent: navigator.userAgent,
            referrer: document.referrer || '',
            viewed_at: new Date().toISOString()
        };

        try {
            const response = await fetch(this.apiEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.getCSRFToken()
                },
                body: JSON.stringify(viewData)
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('Article view tracked successfully:', result);
        } catch (error) {
            console.error('Error tracking article view:', error);
        }
    }

    // Track durasi halaman
    trackPageDuration() {
        const updateDuration = async () => {
            const duration = Math.round((Date.now() - this.startTime) / 1000);
            
            const durationData = {
                session_id: this.sessionId,
                page_url: window.location.href,
                duration: duration
            };

            try {
                // Menggunakan fetch dengan POST method, bukan sendBeacon
                const response = await fetch(this.durationEndpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': this.getCSRFToken()
                    },
                    body: JSON.stringify(durationData)
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
            } catch (error) {
                console.error('Error updating duration:', error);
                
                // Fallback dengan sendBeacon jika fetch gagal
                try {
                    navigator.sendBeacon(
                        this.durationEndpoint, 
                        JSON.stringify(durationData)
                    );
                } catch (beaconError) {
                    console.error('Error with sendBeacon:', beaconError);
                }
            }
        };

        // Track ketika user akan meninggalkan halaman
        window.addEventListener('beforeunload', () => {
            updateDuration();
        });
        
        // Track setiap 30 detik untuk backup
        setInterval(() => {
            updateDuration();
        }, 30000);

        // Track ketika halaman menjadi hidden (user pindah tab)
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                updateDuration();
            }
        });
    }

    // Method untuk tracking event khusus
    async trackEvent(eventName, eventData = {}) {
        const trackingData = {
            session_id: this.sessionId,
            event_name: eventName,
            event_data: eventData,
            page_url: window.location.href,
            timestamp: new Date().toISOString()
        };

        try {
            const response = await fetch(this.eventEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.getCSRFToken()
                },
                body: JSON.stringify(trackingData)
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('Event tracked successfully:', result);
        } catch (error) {
            console.error('Error tracking event:', error);
        }
    }

    // Method untuk tracking scroll depth
    trackScrollDepth() {
        let maxScrollDepth = 0;
        let scrollTimer = null;

        const updateScrollDepth = () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const documentHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollDepth = Math.round((scrollTop / documentHeight) * 100);

            if (scrollDepth > maxScrollDepth) {
                maxScrollDepth = scrollDepth;
                
                // Track milestone scroll depths
                if (maxScrollDepth >= 25 && maxScrollDepth < 50) {
                    this.trackEvent('scroll_depth', { depth: '25%' });
                } else if (maxScrollDepth >= 50 && maxScrollDepth < 75) {
                    this.trackEvent('scroll_depth', { depth: '50%' });
                } else if (maxScrollDepth >= 75 && maxScrollDepth < 100) {
                    this.trackEvent('scroll_depth', { depth: '75%' });
                } else if (maxScrollDepth >= 100) {
                    this.trackEvent('scroll_depth', { depth: '100%' });
                }
            }
        };

        window.addEventListener('scroll', () => {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(updateScrollDepth, 250);
        });
    }

    // Method untuk tracking clicks
    trackClicks() {
        document.addEventListener('click', (event) => {
            const target = event.target;
            const tagName = target.tagName.toLowerCase();
            
            // Track link clicks
            if (tagName === 'a') {
                this.trackEvent('link_click', {
                    url: target.href,
                    text: target.textContent.trim().substring(0, 100)
                });
            }
            
            // Track button clicks
            if (tagName === 'button' || target.type === 'button') {
                this.trackEvent('button_click', {
                    text: target.textContent.trim().substring(0, 100),
                    id: target.id || null,
                    class: target.className || null
                });
            }
        });
    }

    // Enable advanced tracking
    enableAdvancedTracking() {
        this.trackScrollDepth();
        this.trackClicks();
    }
}

// Initialize tracker ketika DOM ready
document.addEventListener('DOMContentLoaded', function() {
    window.tracker = new WebsiteTracker();
    
    // Enable advanced tracking if needed
    // window.tracker.enableAdvancedTracking();
});

// Export untuk penggunaan sebagai module
if (typeof module !== 'undefined' && module.exports) {
    module.exports = WebsiteTracker;
}