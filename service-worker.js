const CACHE_NAME = 'jura-quest-cache-v2'; // Zmieniono wersję cache
const urlsToCache = [
    '/',
    '/index.html',
    '/aktywacja.html',
    '/css/style.css',
    '/js/main.js',
    '/data/warszycki-quest.json', // Dodano plik z danymi gry
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
    'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@700;900&display=swap',
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
    // Dodaj tutaj inne kluczowe zasoby, takie jak obrazy używane na stronie aktywacji, itp.
    // Np. '/images/logo.png', '/videos/intro.mp4' (jeśli są małe i krytyczne)
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Opened cache');
                return cache.addAll(urlsToCache);
            })
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                // Cache hit - return response
                if (response) {
                    return response;
                }
                // Cache miss - fetch from network
                return fetch(event.request).then(networkResponse => {
                    // Check if we received a valid response
                    if (!networkResponse || networkResponse.status !== 200 || networkResponse.type !== 'basic') {
                        return networkResponse;
                    }
                    // IMPORTANT: Clone the response. A response is a stream
                    // and can only be consumed once. We must clone it in order
                    // to be able to consume the response twice: one for the
                    // browser and one for the cache.
                    const responseToCache = networkResponse.clone();

                    caches.open(CACHE_NAME)
                        .then(cache => {
                            cache.put(event.request, responseToCache);
                        });

                    return networkResponse;
                });
            })
    );
});

self.addEventListener('activate', event => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});