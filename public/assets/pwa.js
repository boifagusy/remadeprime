// Service Worker Register 
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('sw.js')
        // navigator.serviceWorker.register({{static_asset('/sw.js')}})
            .then(registration => {
                console.log('SW Connected')
            })
            .catch(err => {
            });
    });
}