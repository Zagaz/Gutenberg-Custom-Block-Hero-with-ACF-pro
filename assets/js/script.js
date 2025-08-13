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
        
        // More thorough detection of WordPress editor environment
        const isEditor = document.body.classList.contains('wp-admin') || 
                        document.body.classList.contains('block-editor-page') ||
                        document.body.classList.contains('edit-post-visual-editor') ||
                        document.querySelector('.edit-post-visual-editor') !== null ||
                        document.querySelector('.block-editor') !== null ||
                        window.location.href.indexOf('/wp-admin/') !== -1;
        
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
                
                // We want the video to fill the width completely
                // and maintain aspect ratio by adjusting height
                let width, height;
                
                // Always use the full width
                width = Math.max(wrapperWidth, window.innerWidth);
                
                // Calculate height based on 16:9 aspect ratio
                height = width * (9/16); // 16:9 ratio
                
                // Make sure height is at least as tall as the wrapper
                if (height < wrapperHeight) {
                    height = wrapperHeight;
                    // Recalculate width to maintain aspect ratio
                    // but ensure it's still at least the wrapper width
                    const newWidth = height * (16/9);
                    width = Math.max(newWidth, wrapperWidth);
                }
                
                // Apply the calculated dimensions
                iframe.style.width = width + 'px';
                iframe.style.height = height + 'px';
                
                // Center the video
                iframe.style.position = 'absolute';
                iframe.style.left = '50%';
                iframe.style.top = '50%';
                iframe.style.transform = 'translate(-50%, -50%)';
                
                // Force iframe to be visible
                iframe.style.visibility = 'visible';
                iframe.style.opacity = '1';
                
                // Use object-fit: cover to fill the container
                iframe.style.objectFit = 'cover';
                
                // In editor, make sure to use the same approach but larger dimensions
                if (isEditor) {
                    iframe.style.width = (width * 1.1) + 'px'; // Slightly wider in editor
                    iframe.style.height = (height * 1.1) + 'px';
                    iframe.style.objectFit = 'cover';
                }
                
                // Ensure parent containers are visible
                if (container) {
                    container.style.visibility = 'visible';
                    container.style.opacity = '1';
                    container.style.zIndex = '1'; // Just behind content
                }
            }
        });
    }
    
    // Initial resize and setup
    function initYouTubeVideos() {
        // First resize
        resizeYouTubeVideos();
        
        // Re-calculate on window resize
        window.addEventListener('resize', resizeYouTubeVideos);
        
        // Determine if we're in the WordPress editor
        const isEditor = document.body.classList.contains('wp-admin') || 
                         document.body.classList.contains('block-editor-page') ||
                         document.body.classList.contains('edit-post-visual-editor') ||
                         document.querySelector('.edit-post-visual-editor') !== null ||
                         document.querySelector('.block-editor') !== null ||
                         window.location.href.indexOf('/wp-admin/') !== -1;
        
        // For WordPress editor, observe DOM changes as blocks can be moved/resized
        if (isEditor) {
            console.log('WordPress editor detected - applying enhanced YouTube background handling');
            
            // Add editor-specific class to body if not already present
            document.body.classList.add('wp-admin-editor');
            
            // Create an observer with more specific configuration for editor
            const observer = new MutationObserver(function(mutations) {
                resizeYouTubeVideos();
            });
            
            // Start observing the document body for DOM changes
            observer.observe(document.body, { 
                childList: true, 
                subtree: true,
                attributes: true,
                attributeFilter: ['style', 'class']
            });
            
            // Set a periodic check in the editor for safety
            const editorInterval = setInterval(resizeYouTubeVideos, 1000);
            
            // Clean up interval when page unloads
            window.addEventListener('beforeunload', function() {
                clearInterval(editorInterval);
            });
        }
    }
    
    // Document ready with multiple fallback methods
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            // Initial call with delay to ensure elements are ready
            setTimeout(initYouTubeVideos, 100);
            
            // Secondary call with longer delay as extra safety
            setTimeout(resizeYouTubeVideos, 500);
            
            // Third call with even longer delay for sluggish editor loads
            setTimeout(resizeYouTubeVideos, 1500);
        });
    } else {
        // Document already loaded
        setTimeout(initYouTubeVideos, 100);
        
        // Secondary safety call
        setTimeout(resizeYouTubeVideos, 500);
    }
})();
