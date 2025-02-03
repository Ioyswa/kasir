import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 'resources/js/app.js',
                'resources/css/sb-admin-2.css', 'resources/js/sb-admin-2.js',
                'resource/js/demo/chart-area-demo.js',
                'resource/js/demo/chart-pie-demo.js',
                'vendor/fontawesome-free/css/all.min.css',
                'vendor/jquery/jquery.js',
                'vendor/bootstrap/js/bootstrap.min.js',
                'vendor/jquery-easing/jquery.easing.min.js',
                'vendor/chart.js/Chart.bundle.min.js',
                'vendor/fontawesome-free/css/all.min.css'




            ],
            refresh: true,
        }),
    ],
});


// // <!-- Bootstrap core JavaScript-->
// <script src="vendor/jquery/jquery.min.js"></script>
// <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

// <!-- Core plugin JavaScript-->
// <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

// <!-- Custom scripts for all pages-->
// <script src="js/sb-admin-2.min.js"></script>

// <!-- Page level plugins -->
// <script src="vendor/chart.js/Chart.min.js"></script>

// <!-- Page level custom scripts -->
// <script src="js/demo/chart-area-demo.js"></script>
// <script src="js/demo/chart-pie-demo.js"></script>
