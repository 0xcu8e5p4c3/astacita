<div class="bg-white">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Videos</h1>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Large video item -->
            <div class="group md:col-span-2 md:row-span-2 relative overflow-hidden rounded-2xl shadow-lg">
                <video class="video-element w-full h-full object-cover transition-transform duration-300" muted>
                    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                </video>
                <div class="overlay absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-4 text-center transition-all duration-300 translate-y-0">
                    <span class="block text-xs font-bold uppercase">Breaking News</span>
                    <h3 class="text-lg font-semibold">Latest Headlines</h3>
                </div>
            </div>
            
            <!-- Small video items -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg">
                <video class="video-element w-full h-48 object-cover transition-transform duration-300" muted>
                    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                </video>
                <div class="overlay absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-4 text-center transition-all duration-300 translate-y-0">
                    <span class="block text-xs font-bold uppercase">Technology</span>
                    <h4 class="text-lg font-semibold">Innovations</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="videoModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
    <div class="relative w-4/5 h-3/5">
        <button id="closeModal" class="absolute top-2 right-2 text-white text-xl">&times;</button>
        <iframe id="videoFrame" class="w-full h-full" allowfullscreen></iframe>
    </div>
</div>

<script>
    document.querySelectorAll('.group').forEach(group => {
        const overlay = group.querySelector('.overlay');
        const video = group.querySelector('.video-element');
        
        group.addEventListener('mouseenter', () => {
            overlay.classList.add('translate-y-full');
            video.removeAttribute('muted');
            video.setAttribute('controls', '');
            video.play();
        });
        
        group.addEventListener('mouseleave', () => {
            overlay.classList.remove('translate-y-full');
            video.setAttribute('muted', '');
            video.removeAttribute('controls');
            video.pause();
        });
    });
    
    document.querySelectorAll('video').forEach(video => {
        video.addEventListener('click', function() {
            document.getElementById('videoModal').classList.remove('hidden');
            document.getElementById('videoFrame').src = this.querySelector('source').src;
        });
    });
    
    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('videoModal').classList.add('hidden');
        document.getElementById('videoFrame').src = '';
    });
</script>

<style>
    .overlay {
        transform: translateY(0);
    }
    .group:hover .overlay {
        transform: translateY(100%);
    }
</style>
