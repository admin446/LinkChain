import './bootstrap'; // Laravel 預設的 axios 設定

// 引入 Bootstrap 5 (Vanilla JS)
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// 引入 AdminLTE v4 腳本
import 'admin-lte/dist/js/adminlte.min.js';

// 引入與配置 Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// 引入與配置 SweetAlert2
import Swal from 'sweetalert2';
window.Swal = Swal;

// 引入與配置 Chart.js
import Chart from 'chart.js/auto';
window.Chart = Chart;

// 建立一個全域的 Toast 實體，方便在任何地方調用 (取代傳統相依 jQuery 的 Toastr)
window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
