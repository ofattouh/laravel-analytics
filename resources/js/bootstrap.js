import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Allow incoming requests from Vue/SPA to authenticate using Laravel web session cookies while still
// allowing requests from third parties or mobile applications to authenticate using API tokens
window.axios.defaults.withCredentials = true;
window.axios.defaults.withXSRFToken = true;
