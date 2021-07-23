import axios from 'axios';

axios.interceptors.request.use(function (config) {
    const token = localStorage.getItem('token');
    // Prepend /api to all routes
    config.baseURL = '/api';
    // If the JWT token isn't set then we just return the basic config
    if (token === null) {
        return config;
    }
    config.headers.Authorization = 'Bearer ' + token;

    return config;
});

export default axios;