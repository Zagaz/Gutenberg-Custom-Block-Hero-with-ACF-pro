//console.log('It\'s aliiive')

/**
 * YouTube Video Background Enhancement
 * This script adds functionality to improve the YouTube video background experience
 */
(function() {
    // Function to handle video sizing for proper coverage
    function resizeYouTubeVideos() {
        const videoContainers = document.querySelectorAll('.youtube-background');
        
        if (videoContainers.length === 0) return;
        
        videoContainers.forEach(container => {
            const wrapper = container.closest('.acf-hero-wrapper');
            const iframe = container.querySelector('iframe');
            
            if (iframe && wrapper) {
                // Get aspect ratio of the wrapper
                const wrapperWidth = wrapper.offsetWidth;
                const wrapperHeight = wrapper.offsetHeight;
                const wrapperRatio = wrapperWidth / wrapperHeight;
                
                // Standard video ratio is 16:9 = 1.77
                const videoRatio = 16/9;
                
                // Determine size based on aspect ratio comparison
                if (wrapperRatio > videoRatio) {
                    // Wrapper is wider than video, scale by width
                    const newWidth = wrapperWidth;
                    const newHeight = wrapperWidth / videoRatio;
                    
                    iframe.style.width = newWidth + 'px';
                    iframe.style.height = newHeight + 'px';
                    iframe.style.left = '0';
                    iframe.style.top = ((wrapperHeight - newHeight) / 2) + 'px';
                } else {
                    // Wrapper is taller than video, scale by height
                    const newHeight = wrapperHeight;
                    const newWidth = wrapperHeight * videoRatio;
                    
                    iframe.style.height = newHeight + 'px';
                    iframe.style.width = newWidth + 'px';
                    iframe.style.top = '0';
                    iframe.style.left = ((wrapperWidth - newWidth) / 2) + 'px';
                }
            }
        });
    }
    
    // Initial resize and setup
    document.addEventListener('DOMContentLoaded', function() {
        // Add a small delay to ensure elements are ready
        setTimeout(resizeYouTubeVideos, 100);
        
        // Re-calculate on window resize
        window.addEventListener('resize', resizeYouTubeVideos);
    });
})();
