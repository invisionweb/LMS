import axios from 'axios';
import Swiper from 'swiper/bundle';
import 'swiper/swiper-bundle.css';

window.axios = axios;
window.Swiper = Swiper;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
