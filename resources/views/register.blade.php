<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register </title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <!-- <script src="https://kit.fontawesome.com/c35c4a5799.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="assets/font-web/css/all.css">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <style>
        /*
        *
        * ==========================================
        * CUSTOM UTIL CLASSES
        * ==========================================
        *
        */
        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-style: normal !important;
            font-weight: 700 !important;
            font-size: 45px !important;
            line-height: 68px !important;
            color: #3A0CA3 !important;
        }

        .border-md {
            border-width: 2px;
        }

        .sign_up {
            background-color: #452C88;
            box-shadow: 0px 4px 26px rgba(0, 0, 0, 0.25) !important;
            border-radius: 32px !important;
        }

        /*
        *
        * ==========================================
        * FOR DEMO PURPOSES
        * ==========================================
        *
        */
        input,
        .input-group-text {
            /*border-top: 0px !important;*/
            /*border-left: 0px !important;*/
            /*border-right: 0px !important;*/
            outline: 0px !important;
        }

        .form-control:not(select) {
            padding: 1.2rem 0.5rem;
        }

        select.form-control {
            height: 52px;
            padding-left: 0.5rem;
        }

        .form-control::placeholder {
            color: #ccc;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .form-control:focus {
            box-shadow: none;
        }
    </style>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
</head>

<body style="overflow-x: hidden;">
    <div class="container-fluid mx-2" style="margin-top: 20px !important;">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 ml-auto " style="height: 90vh !important; width: 100%;">
                <div class="">
                    <!-- Navbar Brand -->
                    <a href="/" class="navbar-brand">
                        <svg xmlns="http://www.w3.org/2000/svg" width="338" height="120" viewBox="0 0 338 120" version="1.1">
                            <path d="M 59.363 21.497 C 59.017 22.398, 59.196 23.596, 59.761 24.161 C 61.391 25.791, 64.500 24.692, 64.500 22.486 C 64.500 19.943, 60.272 19.128, 59.363 21.497 M 44.200 33.200 C 42.929 34.471, 42.589 39.765, 43.607 42.418 C 44.344 44.340, 51.975 44.625, 53.800 42.800 C 55.352 41.248, 55.352 34.752, 53.800 33.200 C 53.140 32.540, 50.980 32, 49 32 C 47.020 32, 44.860 32.540, 44.200 33.200 M 134.270 46.138 C 130.340 47.244, 125.998 53.201, 126.004 57.482 C 126.009 61.837, 129.475 66.883, 133.664 68.633 C 137.543 70.254, 140.742 69.871, 144.636 67.319 C 146.877 65.851, 146.941 65.593, 145.473 63.970 C 144.052 62.400, 143.580 62.363, 141.052 63.624 C 138.023 65.135, 133.917 64.292, 132.407 61.850 C 131.104 59.741, 131.947 53.587, 133.722 52.250 C 135.836 50.659, 140.237 50.637, 141.811 52.211 C 142.759 53.159, 143.468 52.976, 145.076 51.369 L 147.130 49.315 144.815 47.816 C 141.482 45.657, 137.968 45.098, 134.270 46.138 M 89 48.500 C 89 50.690, 89.433 51, 92.500 51 L 96 51 96 60 C 96 68.933, 96.019 69, 98.500 69 C 100.981 69, 101 68.933, 101 60 L 101 51 104.500 51 L 108 51 108 60 L 108 69 117 69 C 125.933 69, 126 68.981, 126 66.500 C 126 64.090, 125.767 64, 119.500 64 C 113.667 64, 113 63.795, 113 62 C 113 60.222, 113.667 60, 119 60 C 124.778 60, 125 59.905, 125 57.427 C 125 54.931, 124.830 54.863, 119.250 55.125 C 113.993 55.373, 113.473 55.208, 113.180 53.198 C 112.879 51.125, 113.233 51, 119.430 51 C 125.771 51, 126 50.913, 126 48.500 L 126 46 107.500 46 L 89 46 89 48.500 M 148 57.430 L 148 69 150.500 69 C 152.796 69, 153 68.633, 153 64.500 L 153 60 157.500 60 L 162 60 162 64.500 C 162 68.633, 162.204 69, 164.500 69 L 167 69 167 57.500 L 167 46 164.500 46 C 162.160 46, 162 46.326, 162 51.107 C 162 55.353, 161.733 56.112, 160.418 55.607 C 159.548 55.273, 157.549 55, 155.976 55 C 153.325 55, 153.092 54.688, 152.807 50.750 C 152.552 47.217, 152.120 46.446, 150.250 46.180 C 148.028 45.865, 148 46.004, 148 57.430 M 13 76.235 C 7.225 86.263, 2.367 95.176, 2.206 96.042 C 1.792 98.254, 5.765 103, 8.030 103 C 9.207 103, 10.906 101.309, 12.553 98.500 C 14.004 96.025, 15.576 94.238, 16.048 94.530 C 16.520 94.821, 17.910 96.846, 19.137 99.030 L 21.368 103 27.684 103 C 31.158 103, 34 102.793, 34 102.539 C 34 102.286, 31.342 97.688, 28.093 92.322 L 22.186 82.566 26.167 75.313 L 30.148 68.059 27.324 63.030 C 25.771 60.265, 24.275 58.002, 24 58.003 C 23.725 58.003, 18.775 66.208, 13 76.235" stroke="none" fill="#3c90d0" fill-rule="evenodd" />
                            <path d="M 48.465 25.057 C 48.106 25.638, 48.095 27.241, 48.441 28.620 C 48.948 30.640, 49.596 31.065, 51.785 30.813 C 54.038 30.553, 54.553 29.947, 54.813 27.250 C 55.104 24.235, 54.910 24, 52.122 24 C 50.470 24, 48.824 24.476, 48.465 25.057 M 57.518 30.945 C 57.159 32.075, 57.159 33.925, 57.518 35.055 C 58.046 36.720, 58.866 37.053, 61.835 36.805 C 65.299 36.517, 65.500 36.308, 65.500 33 C 65.500 29.692, 65.299 29.483, 61.835 29.195 C 58.866 28.947, 58.046 29.280, 57.518 30.945 M 37.403 35.430 C 35.747 36.590, 26 51.895, 26 53.336 C 26 53.885, 46.025 88.272, 47.154 89.661 C 48.477 91.290, 46.271 92.470, 44.559 91.049 C 43.815 90.431, 40.878 85.893, 38.033 80.963 C 35.188 76.033, 32.554 72.006, 32.180 72.014 C 31.806 72.022, 30.242 74.310, 28.704 77.098 L 25.908 82.166 31.857 92.333 L 37.806 102.500 51.903 102.777 C 59.656 102.930, 66 102.868, 66 102.640 C 66 102.411, 59.920 91.712, 52.488 78.862 C 40.141 57.512, 37.950 52.775, 40.329 52.571 C 40.785 52.532, 47.648 63.750, 55.580 77.500 C 68.026 99.074, 70.357 102.545, 72.589 102.825 C 75.855 103.235, 79 100.469, 79 97.186 C 79 94.479, 52.943 48.318, 50.247 46.250 C 49.351 45.563, 47.152 45, 45.361 45 C 42.144 45, 42.101 44.937, 41.802 39.829 C 41.472 34.172, 40.536 33.236, 37.403 35.430 M 144.863 51.761 C 143.630 53.335, 143.666 53.370, 145.250 52.128 C 146.879 50.850, 147 51.220, 147 57.500 C 147 63.780, 146.879 64.150, 145.250 62.872 C 143.666 61.630, 143.630 61.665, 144.863 63.239 C 147.059 66.040, 148 64.318, 148 57.500 C 148 50.682, 147.059 48.960, 144.863 51.761 M 113 52.941 C 113 54.009, 113.385 55.120, 113.856 55.411 C 114.326 55.702, 114.499 54.828, 114.239 53.470 C 113.675 50.519, 113 50.231, 113 52.941 M 113.158 62 C 113.158 63.375, 113.385 63.938, 113.662 63.250 C 113.940 62.563, 113.940 61.438, 113.662 60.750 C 113.385 60.063, 113.158 60.625, 113.158 62 M 96.017 74.286 C 94.651 74.977, 93.114 76.736, 92.601 78.194 C 91.206 82.159, 93.923 85.626, 99.754 87.324 C 102.545 88.138, 104.630 89.370, 104.816 90.318 C 105.294 92.749, 100.698 93.495, 96.903 91.602 C 93.943 90.125, 93.621 90.136, 92.437 91.755 C 91.335 93.262, 91.550 93.746, 94.016 95.307 C 98.266 97.998, 105.705 97.298, 108.176 93.976 C 110.806 90.440, 109.132 85.659, 104.685 84.003 C 97.732 81.415, 97 80.988, 97 79.521 C 97 77.740, 102.047 77.420, 105.024 79.013 C 106.521 79.814, 107.137 79.612, 107.975 78.047 C 108.876 76.363, 108.592 75.840, 106.066 74.534 C 102.483 72.681, 99.341 72.604, 96.017 74.286 M 115.190 75.026 C 108.222 79.274, 107.672 89.022, 114.096 94.427 C 119.786 99.215, 129.225 97.260, 132.365 90.643 C 134.588 85.960, 134.420 82.919, 131.720 78.912 C 127.630 72.843, 121.235 71.340, 115.190 75.026 M 135 84.971 L 135 97.081 143.250 96.790 C 149.788 96.560, 151.500 96.189, 151.500 95 C 151.500 93.894, 149.960 93.369, 145.637 93 L 139.774 92.500 139.637 83 C 139.507 73.957, 139.392 73.485, 137.250 73.180 C 135.023 72.864, 135 72.984, 135 84.971 M 151.363 74.497 C 151.047 75.321, 150.954 79.640, 151.156 84.094 C 151.492 91.500, 151.763 92.399, 154.318 94.597 C 158.204 97.939, 165.137 97.953, 168.465 94.626 C 170.958 92.133, 172.616 85.004, 171.754 80.491 C 171.312 78.179, 171.559 78, 175.199 78 L 179.120 78 178.912 87.250 C 178.715 96.023, 178.815 96.516, 180.852 96.820 C 182.922 97.127, 183 96.791, 183 87.570 L 183 78 186.500 78 C 189.576 78, 190 77.694, 190 75.476 L 190 72.951 178.500 73.071 L 167 73.191 167 81.096 C 167 87.667, 166.663 89.337, 165 91 C 162.509 93.491, 159.811 93.554, 157.655 91.171 C 156.399 89.784, 156 87.371, 156 81.171 C 156 73.625, 155.845 73, 153.969 73 C 152.851 73, 151.679 73.674, 151.363 74.497 M 191.701 73.632 C 191.316 74.018, 191 79.433, 191 85.667 L 191 97 193.532 97 L 196.063 97 195.782 85.262 C 195.550 75.607, 195.225 73.472, 193.951 73.228 C 193.099 73.064, 192.087 73.246, 191.701 73.632 M 204.500 73.954 C 198.445 76.458, 195.364 84.935, 198.384 90.777 C 200.712 95.277, 203.740 97, 209.323 97 C 213.536 97, 214.663 96.537, 217.600 93.600 C 220.489 90.711, 221 89.503, 221 85.565 C 221 82.943, 220.284 79.837, 219.352 78.414 C 216.324 73.793, 209.699 71.804, 204.500 73.954 M 222.667 73.667 C 222.300 74.033, 222 79.433, 222 85.667 L 222 97 224.458 97 C 226.824 97, 226.927 96.719, 227.208 89.513 L 227.500 82.026 233.286 89.513 C 237.059 94.395, 239.766 97, 241.068 97 C 242.965 97, 243.050 96.419, 242.782 85.250 C 242.518 74.261, 242.371 73.500, 240.500 73.500 C 238.711 73.500, 238.469 74.265, 238.206 80.760 L 237.912 88.020 231.944 80.510 C 226.389 73.519, 224.331 72.002, 222.667 73.667 M 248.017 74.286 C 246.651 74.977, 245.114 76.736, 244.601 78.194 C 243.206 82.159, 245.923 85.626, 251.754 87.324 C 257.154 88.898, 258.607 91.559, 254.613 92.561 C 253.106 92.939, 250.796 92.546, 248.865 91.582 C 245.759 90.033, 244.073 90.593, 244.015 93.193 C 243.976 94.961, 248.870 97, 253.150 97 C 257.042 97, 258.213 96.545, 259.927 94.365 C 263.745 89.512, 261.923 85.850, 254.342 83.138 C 251.570 82.146, 249.500 80.784, 249.500 79.953 C 249.500 78.134, 254.195 77.499, 256.909 78.951 C 258.545 79.827, 259.112 79.660, 259.975 78.047 C 260.876 76.363, 260.592 75.840, 258.066 74.534 C 254.483 72.681, 251.341 72.604, 248.017 74.286 M 318.500 74.403 C 310.161 78.084, 307.953 87.799, 314.066 93.912 C 317.423 97.269, 321.472 98.261, 326.338 96.917 C 331.559 95.476, 334 91.838, 334 85.500 C 334 79.118, 331.557 75.527, 326.205 74.040 C 321.732 72.798, 322.183 72.777, 318.500 74.403 M 272 85.500 L 272 97 274.500 97 C 276.672 97, 277 96.558, 277 93.630 C 277 90.373, 277.153 90.243, 281.541 89.748 C 287.440 89.083, 290 86.744, 290 82.019 C 290 76.186, 286.915 74, 278.686 74 L 272 74 272 85.500 M 291 85.500 L 291 97 293.500 97 C 295.750 97, 296 96.600, 296 93 C 296 89.676, 296.336 89, 297.986 89 C 299.195 89, 301.007 90.565, 302.619 93 C 304.714 96.166, 305.881 97, 308.219 97 L 311.173 97 308.189 92.943 L 305.205 88.885 307.603 86.488 C 310.695 83.396, 310.730 79.034, 307.686 76.174 C 305.753 74.358, 304.187 74, 298.186 74 L 291 74 291 85.500 M 116.455 80.050 C 113.768 83.019, 114.005 88.776, 116.911 91.129 C 118.182 92.158, 120.317 93, 121.656 93 C 124.650 93, 129 88.842, 129 85.980 C 129 83.588, 127.245 79.863, 125.600 78.765 C 123.387 77.288, 118.309 78.001, 116.455 80.050 M 204 80 C 199.051 84.949, 203.670 93.901, 210.484 92.565 C 212.143 92.239, 214.063 91.218, 214.750 90.295 C 216.642 87.757, 216.306 81.587, 214.171 79.655 C 211.655 77.378, 206.445 77.555, 204 80 M 277 81.500 C 277 84.793, 277.195 85, 280.300 85 C 283.376 85, 286 83.560, 286 81.871 C 286 80.149, 282.629 78, 279.929 78 C 277.248 78, 277 78.297, 277 81.500 M 296 81.500 C 296 84.700, 296.250 85, 298.918 85 C 303.314 85, 305 84.029, 305 81.500 C 305 78.971, 303.314 78, 298.918 78 C 296.250 78, 296 78.300, 296 81.500 M 318.011 79.790 C 316.410 81.086, 315.800 82.662, 315.800 85.500 C 315.800 92.611, 323.676 95.771, 327.927 90.365 C 330.677 86.870, 330.545 83.454, 327.545 80.455 C 324.646 77.555, 321.079 77.306, 318.011 79.790" stroke="none" fill="#184A45FF" fill-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div class="row mt-4">
                    <form action="/register" method="post" style="width: 500px !important;">
                        @csrf
                        <input type="hidden" name="role" value="Client" id="role" />
                        <div class="row">
                            <div class="w-100" style="padding-left: 15px;">
                                <p style="font-style: normal;font-weight: 500;font-size: 30px;line-height: 45px;color: #000000 !important;">@lang('lang.signup')</p>
                            </div>
                            <!-- Email Address -->
                            <div class="w-100" style="padding-left: 15px;">
                                <p style="font-style: normal;font-weight: 400;font-size: 16px;line-height: 24px;color: #000000;margin-bottom: 0px !important;">@lang('lang.if_you_already_have_an_account_register')</p>
                                <p>@lang('lang.you_can') <a href="/login" class="text-warning ml-2">@lang('lang.login_here') !</a></p>
                            </div>
                            <div class="input-group col-lg-12 mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white px-4 border-md border-right-0 border-left-0 border-top-0 border-dark" style="border-radius: 0px !important;">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.85376 7.70726C8.9126 7.70726 9.82935 7.3275 10.5786 6.57823C11.3276 5.82909 11.7075 4.91247 11.7075 3.85351C11.7075 2.79492 11.3278 1.87817 10.5785 1.12878C9.82922 0.37976 8.91248 0 7.85376 0C6.7948 0 5.87817 0.37976 5.12903 1.1289C4.37988 1.87805 4 2.79479 4 3.85351C4 4.91247 4.37988 5.82921 5.12903 6.57836C5.87842 7.32738 6.79517 7.70726 7.85376 7.70726ZM5.79211 1.79187C6.36694 1.21704 7.04126 0.93762 7.85376 0.93762C8.66614 0.93762 9.34058 1.21704 9.91553 1.79187C10.4904 2.36682 10.7699 3.04125 10.7699 3.85351C10.7699 4.66601 10.4904 5.34032 9.91553 5.91527C9.34058 6.49022 8.66614 6.76964 7.85376 6.76964C7.0415 6.76964 6.36719 6.4901 5.79211 5.91527C5.21716 5.34044 4.93762 4.66601 4.93762 3.85351C4.93762 3.04125 5.21716 2.36682 5.79211 1.79187Z" fill="black" />
                                            <path d="M14.629 12.3032C14.6074 11.9914 14.5637 11.6513 14.4994 11.2922C14.4344 10.9304 14.3508 10.5883 14.2507 10.2757C14.1472 9.9526 14.0067 9.63351 13.8328 9.32773C13.6525 9.01034 13.4406 8.73398 13.2028 8.50656C12.9541 8.26865 12.6497 8.07736 12.2976 7.93784C11.9468 7.79904 11.558 7.72873 11.1421 7.72873C10.9788 7.72873 10.8208 7.79575 10.5157 7.99435C10.328 8.11679 10.1084 8.25839 9.86328 8.41501C9.65369 8.54855 9.36975 8.67367 9.01904 8.78695C8.67688 8.89767 8.32947 8.95382 7.98645 8.95382C7.64368 8.95382 7.29626 8.89767 6.95386 8.78695C6.60352 8.6738 6.31946 8.54867 6.11023 8.41513C5.86743 8.25998 5.64771 8.11838 5.45715 7.99423C5.15234 7.79562 4.99438 7.72861 4.83105 7.72861C4.41504 7.72861 4.02637 7.79904 3.67566 7.93796C3.32385 8.07724 3.01929 8.26852 2.77039 8.50668C2.53259 8.73422 2.32068 9.01047 2.1405 9.32773C1.9668 9.63351 1.82617 9.95248 1.72266 10.2758C1.62268 10.5885 1.53906 10.9304 1.47412 11.2922C1.40967 11.6508 1.36609 11.9911 1.34448 12.3035C1.32324 12.6091 1.3125 12.9271 1.3125 13.2484C1.3125 14.0836 1.578 14.7597 2.10156 15.2584C2.61865 15.7504 3.30273 16 4.13489 16H11.839C12.6709 16 13.355 15.7504 13.8722 15.2584C14.3959 14.7601 14.6614 14.0837 14.6614 13.2483C14.6613 12.9259 14.6504 12.6079 14.629 12.3032ZM13.2257 14.5791C12.884 14.9043 12.4304 15.0623 11.8389 15.0623H4.13489C3.54321 15.0623 3.0896 14.9043 2.74805 14.5792C2.41296 14.2602 2.25012 13.8248 2.25012 13.2484C2.25012 12.9486 2.26001 12.6525 2.27979 12.3684C2.29907 12.0896 2.3385 11.7833 2.39697 11.4578C2.45471 11.1364 2.5282 10.8348 2.6156 10.5617C2.69946 10.2999 2.81384 10.0406 2.95569 9.79086C3.09106 9.55282 3.24683 9.3486 3.4187 9.18405C3.57947 9.03012 3.7821 8.90414 4.02087 8.80966C4.2417 8.72226 4.48987 8.67441 4.75928 8.6672C4.79211 8.68466 4.85059 8.71799 4.94531 8.77975C5.13806 8.90536 5.36023 9.04867 5.60583 9.20553C5.88269 9.38205 6.23938 9.54147 6.66553 9.67904C7.1012 9.81991 7.54553 9.89144 7.98657 9.89144C8.42761 9.89144 8.87207 9.81991 9.3075 9.67917C9.73401 9.54135 10.0906 9.38205 10.3678 9.20529C10.6191 9.04464 10.8351 8.90548 11.0278 8.77975C11.1226 8.71811 11.181 8.68466 11.2139 8.6672C11.4834 8.67441 11.7316 8.72226 11.9525 8.80966C12.1912 8.90414 12.3938 9.03024 12.5546 9.18405C12.7264 9.34848 12.8822 9.5527 13.0176 9.79098C13.1595 10.0406 13.274 10.3 13.3578 10.5616C13.4453 10.835 13.5189 11.1366 13.5765 11.4577C13.6349 11.7838 13.6744 12.0902 13.6937 12.3685V12.3687C13.7136 12.6518 13.7236 12.9477 13.7238 13.2484C13.7236 13.8249 13.5608 14.2602 13.2257 14.5791Z" fill="black" />
                                        </svg>
                                    </span>
                                </div>
                                <input id="username" type="text" value="{{ old('name') }}" name="name" placeholder="@lang('lang.enter_your_full_name')" class="border-top-0 border-right-0 border-dark form-control bg-white border-left-0 border-md" style="border-radius: 0px !important;">
                                <div class="col-lg-12">
                                    @error('name')
                                    <span class="text-danger"> * {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- user name -->
                            <div class="input-group col-lg-12 mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white px-4 border-md border-right-0 border-left-0 border-top-0 border-dark" style="border-radius: 0px !important;">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.49414 2.67649H15.5059C16.3297 2.67649 17 3.34677 17 4.17064V12.8294C17 13.6533 16.3297 14.3236 15.5059 14.3236H1.49414C0.670271 14.3236 0 13.6533 0 12.8294V4.17064C0 3.34677 0.670271 2.67649 1.49414 2.67649ZM1.68914 3.67259L1.88856 3.83864L7.90719 8.85035C8.25071 9.13636 8.74936 9.13636 9.09281 8.85035L15.1114 3.83864L15.3109 3.67259H1.68914ZM16.0039 4.3917L11.1001 8.47512L16.0039 11.7388V4.3917ZM1.49414 13.3275H15.5059C15.7465 13.3275 15.9478 13.1559 15.9939 12.9287L10.3014 9.14015L9.73018 9.61582C9.37377 9.91259 8.93685 10.061 8.49997 10.061C8.06308 10.061 7.62619 9.91259 7.26976 9.61582L6.69853 9.14015L1.00605 12.9286C1.05221 13.1559 1.25348 13.3275 1.49414 13.3275ZM0.996094 11.7388L5.89993 8.47516L0.996094 4.3917V11.7388Z" fill="#000842" />
                                        </svg>

                                    </span>
                                </div>
                                <input id="email" type="email" value="{{ old('email') }}" name="email" placeholder="@lang('lang.enter_your_email')" class="border-top-0 border-right-0 border-dark form-control bg-white border-left-0 border-md" style="border-radius: 0px !important;">
                                <div class="col-lg-12">
                                    @error('email')
                                    <span class="text-danger"> * {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="input-group col-lg-12 mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white px-4 border-md border-right-0 border-left-0 border-top-0 border-dark" style="border-radius: 0px !important;">
                                        <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.6318 7.2296V4.53742C10.639 3.31927 10.1524 2.14798 9.28387 1.29383C8.44414 0.457706 7.34492 0 6.18084 0C6.16282 0 6.14119 0 6.12317 0C3.64003 0.00360399 1.62179 2.03625 1.62179 4.53742V7.2296C0.684757 7.34132 0 8.12699 0 9.07844V15.1259C0 16.1531 0.821709 17 1.84884 17H10.4083C11.4354 17 12.2572 16.1531 12.2572 15.1259V9.07844C12.2535 8.13059 11.5688 7.34132 10.6318 7.2296ZM2.33899 4.53742H2.34259C2.34259 2.43269 4.04007 0.709985 6.12678 0.709985H6.13038C7.12148 0.706381 8.07293 1.09922 8.7757 1.79839C9.50731 2.52279 9.91457 3.51028 9.90736 4.53742V7.2332H9.11448V4.53742C9.12169 3.71931 8.79733 2.93364 8.21709 2.35701C7.66928 1.8092 6.92686 1.49926 6.152 1.49926H6.13038C4.47255 1.49926 3.13186 2.86156 3.13186 4.53381V7.2332H2.33899V4.53742ZM8.39729 4.53742V7.2332H3.85626V4.53742C3.85626 3.26161 4.87259 2.22366 6.13398 2.22366H6.15561C6.73945 2.22366 7.30167 2.45792 7.71613 2.87238C8.15582 3.31206 8.40449 3.91393 8.39729 4.53742ZM11.5688 15.1367C11.5688 15.7674 11.057 16.2792 10.4263 16.2792H1.86326C1.23256 16.2792 0.720797 15.7674 0.720797 15.1367V9.09646C0.720797 8.46576 1.23256 7.954 1.86326 7.954H10.4263C11.057 7.954 11.5688 8.46576 11.5688 9.09646V15.1367Z" fill="#000842" />
                                            <path d="M7.37376 11.8932C7.21519 11.3346 6.70703 10.9525 6.12678 10.9525C5.40959 10.9525 4.82574 11.5328 4.82574 12.2536C4.82574 12.8338 5.20777 13.342 5.76639 13.5005V14.5097C5.76639 14.7079 5.92856 14.8701 6.12678 14.8701C6.325 14.8701 6.48718 14.7079 6.48718 14.5097V13.5005C7.17554 13.3023 7.57559 12.5815 7.37376 11.8932ZM6.12678 12.8302C5.80603 12.8302 5.54654 12.5707 5.54654 12.25C5.54654 11.9292 5.80603 11.6697 6.12678 11.6697C6.44754 11.6697 6.70703 11.9292 6.70703 12.25C6.70703 12.5707 6.44754 12.8302 6.12678 12.8302Z" fill="#000842" />
                                        </svg>

                                    </span>
                                </div>
                                <input id="password" type="password" value="{{ old('password') }}" name="password" placeholder="@lang('lang.enter_your_password')" class="border-top-0 border-right-0  form-control bg-white border-left-0 border-md border-dark" style="border-radius: 0px !important;">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white px-4 border-md border-right-0 border-left-0 border-top-0 border-dark" style="border-radius: 0px !important;">
                                        <button style="border: none;background: none; cursor: pointer;" type="button" id="eye"><i class="fa fa-eye text-muted"></i></button>
                                    </span>
                                </div>
                                <div class="col-lg-12">
                                    @error('password')
                                    <span class="text-danger"> * {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Password Confirmation -->
                            <div class="input-group col-lg-12 mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white px-4 border-md border-right-0 border-left-0 border-top-0 border-dark" style="border-radius: 0px !important;">
                                        <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.6318 7.2296V4.53742C10.639 3.31927 10.1524 2.14798 9.28387 1.29383C8.44414 0.457706 7.34492 0 6.18084 0C6.16282 0 6.14119 0 6.12317 0C3.64003 0.00360399 1.62179 2.03625 1.62179 4.53742V7.2296C0.684757 7.34132 0 8.12699 0 9.07844V15.1259C0 16.1531 0.821709 17 1.84884 17H10.4083C11.4354 17 12.2572 16.1531 12.2572 15.1259V9.07844C12.2535 8.13059 11.5688 7.34132 10.6318 7.2296ZM2.33899 4.53742H2.34259C2.34259 2.43269 4.04007 0.709985 6.12678 0.709985H6.13038C7.12148 0.706381 8.07293 1.09922 8.7757 1.79839C9.50731 2.52279 9.91457 3.51028 9.90736 4.53742V7.2332H9.11448V4.53742C9.12169 3.71931 8.79733 2.93364 8.21709 2.35701C7.66928 1.8092 6.92686 1.49926 6.152 1.49926H6.13038C4.47255 1.49926 3.13186 2.86156 3.13186 4.53381V7.2332H2.33899V4.53742ZM8.39729 4.53742V7.2332H3.85626V4.53742C3.85626 3.26161 4.87259 2.22366 6.13398 2.22366H6.15561C6.73945 2.22366 7.30167 2.45792 7.71613 2.87238C8.15582 3.31206 8.40449 3.91393 8.39729 4.53742ZM11.5688 15.1367C11.5688 15.7674 11.057 16.2792 10.4263 16.2792H1.86326C1.23256 16.2792 0.720797 15.7674 0.720797 15.1367V9.09646C0.720797 8.46576 1.23256 7.954 1.86326 7.954H10.4263C11.057 7.954 11.5688 8.46576 11.5688 9.09646V15.1367Z" fill="#000842" />
                                            <path d="M7.37376 11.8932C7.21519 11.3346 6.70703 10.9525 6.12678 10.9525C5.40959 10.9525 4.82574 11.5328 4.82574 12.2536C4.82574 12.8338 5.20777 13.342 5.76639 13.5005V14.5097C5.76639 14.7079 5.92856 14.8701 6.12678 14.8701C6.325 14.8701 6.48718 14.7079 6.48718 14.5097V13.5005C7.17554 13.3023 7.57559 12.5815 7.37376 11.8932ZM6.12678 12.8302C5.80603 12.8302 5.54654 12.5707 5.54654 12.25C5.54654 11.9292 5.80603 11.6697 6.12678 11.6697C6.44754 11.6697 6.70703 11.9292 6.70703 12.25C6.70703 12.5707 6.44754 12.8302 6.12678 12.8302Z" fill="#184A45FF" />
                                        </svg>

                                    </span>
                                </div>
                                <input id="passwordConfirmation" value="{{ old('confirm_password') }}" type="password" name="confirm_password" placeholder="@lang('confirm_your_password')" class="border-top-0 border-right-0  form-control bg-white border-left-0 border-md border-dark" style="border-radius: 0px !important;">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white px-4 border-md border-right-0 border-left-0 border-top-0 border-dark" style="border-radius: 0px !important;">
                                        <button style="border: none;background: none; cursor: pointer;" type="button" id="eye2"><i class="fa fa-eye text-muted"></i></button>
                                    </span>
                                </div>
                                <div class="col-lg-12">
                                    @error('confirm_password')
                                    <span class="text-danger"> * {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group col-lg-12 mx-auto" style="">
                                <button type="submit" id="btn_user_register" class="font-weight-bold sign_up btn btn-block py-2 text-white" style="background-color: #184A45FF;" name="submit">
                                    <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">@lang('lang.create_your_account')</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- For Demo Purpose -->
            <div class="col-md-5 col-lg-5 pr-lg-5 d-lg-block d-md-block d-none mb-5 mb-md-0">
                <div class="p-2 d-flex align-items-center justify-content-center" style="height: 90vh !important;border-radius: 15px;">
                    <!-- Make the image responsive -->
                    <img class="img-fluid" src="{{ asset('assets/images/login-banner.png') }}" alt="banner image">
                </div>
                <!-- Registeration Form -->
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
            // For Demo Purpose [Changing input group text on focus]
            $(document).ready(function() {

                $('#username').on('input', function() {
                    if ($(this).val().trim() !== '') {
                        $(this).closest('.input-group').find('.text-danger').hide();
                    }
                });

                $('#email').on('input', function() {
                    if ($(this).val().trim() !== '') {
                        $(this).closest('.input-group').find('.text-danger').hide();
                    }
                });

                $('#password').on('input', function() {
                    if ($(this).val().trim() !== '') {
                        $(this).closest('.input-group').find('.text-danger').hide();
                    }
                });

                $('#passwordConfirmation').on('input', function() {
                    if ($(this).val().trim() !== '') {
                        $(this).closest('.input-group').find('.text-danger').hide();
                    }
                });

                $("#eye").on('click', function() {
                    var passwordField = $("#password");
                    var passwordFieldType = passwordField.attr('type');
                    if (passwordFieldType == 'password') {
                        passwordField.attr('type', 'text');
                        $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
                    } else {
                        passwordField.attr('type', 'password');
                        $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
                    }
                });

                $("#eye2").on('click', function() {
                    var passwordField = $("#passwordConfirmation");
                    var passwordFieldType = passwordField.attr('type');
                    if (passwordFieldType == 'password') {
                        passwordField.attr('type', 'text');
                        $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
                    } else {
                        passwordField.attr('type', 'password');
                        $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
                    }
                });
            });
        </script>

        <script>
            window.onload = function() {
                var alertPopup = document.getElementById('alertPopup');
                var alertMessage = document.getElementById('alertMessage');
                var closeAlert = document.getElementById('closeAlert');

                var successMessage = '{{ session('
                success ') }}';

                if (successMessage) {
                    swal({
                        title: 'Account Created Successfully!',
                        text: successMessage,
                        icon: 'success',
                        showClass: {
                            popup: 'swal2-show',
                            backdrop: 'swal2-backdrop-show',
                            icon: 'swal2-icon-show'
                        },
                        hideClass: {
                            popup: 'swal2-hide',
                            backdrop: 'swal2-backdrop-hide',
                            icon: 'swal2-icon-hide'
                        },
                        onOpen: function() {
                            $('.swal2-popup').css('animation', 'swal2-show 0.5s');
                        },
                        onClose: function() {
                            $('.swal2-popup').css('animation', 'swal2-hide 0.5s');
                        }
                    });
                }

                closeAlert.addEventListener('click', function() {
                    alertPopup.classList.remove('show');
                });
            }
            $('#btn_user_register').on('click', function() {
                $('#spinner').removeClass('d-none');
                $('#text').addClass('d-none');

                swal({
                    title: 'wait',
                    content: {
                        element: "div",
                        attributes: {
                            class: "custom-spinner"
                        }
                    },
                    text: 'Regitering',
                    buttons: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    onOpen: function() {
                        $('.custom-spinner').addClass('spinner-border spinner-border-sm text-primary');
                    },
                    onClose: function() {
                        $('.custom-spinner').removeClass('spinner-border spinner-border-sm text-primary');
                    }
                });
            });
        </script>

</body>

</html>
@include('apicall')