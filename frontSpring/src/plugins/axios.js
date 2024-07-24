import { createApp } from 'vue';
import axios from 'axios';

// Configuration globale d'axios
axios.defaults.baseURL = process.env.baseURL || process.env.apiUrl || 'http://localhost:9090/api';
// axios.defaults.headers.common['Authorization'] = AUTH_TOKEN;
// axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

const app = createApp({});

app.config.globalProperties.$axios = axios;

export default app;
