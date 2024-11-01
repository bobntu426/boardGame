import Echo from 'laravel-echo';
import axios from 'axios';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
axios.interceptors.request.use(config => {
    if (window.Echo && window.Echo.socketId()) {
        config.headers['X-Socket-ID'] = window.Echo.socketId();

    } 
    // else {
    //     console.warn('Echo is not initialized or not connected yet.');
    // }
    return config;
});