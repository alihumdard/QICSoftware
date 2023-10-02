<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css" />
    <!-- <script src="https://kit.fontawesome.com/c35c4a5799.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="assets/font-web/css/all.css" />
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <title>Forgot Password</title>
    <style>
        /*
        *
        * ==========================================
        * CUSTOM UTIL CLASSES
        * ==========================================
        *
        */
        .navbar-brand {
            font-family: "Poppins", sans-serif;
            font-style: normal !important;
            font-weight: 700 !important;
            font-size: 45px !important;
            line-height: 68px !important;
            color: #3a0ca3 !important;
        }

        .border-md {
            border-width: 2px;
        }

        .sign_up {
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
            height: 42px;
            padding-left: 0.5rem;
        }

        option,
        .form-control::placeholder {
            color: #ccc;
            font-weight: bold;
            font-size: 0.9rem;
        }

        option {
            color: #000000;
            font-weight: bold;
            font-size: 1rem;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .inputfield {
            width: 100%;
            display: flex;
            justify-content: space-evenly;
        }

        .input {
            height: 3em;
            width: 3em;
            border: 2px solid #452C88;
            outline: none;
            text-align: center;
            /* font-size: 1.5em; */
            border-radius: 0.3em;
            background-color: #ffffff;
            /* outline: none; */
            /* Hide number field arrows */
            /* -moz-appearance: textfield; */
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .input:disabled {
            color: #89888b;
        }

        .input:focus {
            border: 3px solid #ffb800;
        }

        .empty2 {
            border-color: red;
        }
    </style>
</head>

<body style="overflow-x: hidden;">
    <div class="container-fluid mx-2" style="margin-top: 20px !important;">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 ml-auto " style="height: 90vh !important; width: 100%;">
                <div class="">
                    <!-- Navbar Brand -->
                    <a class="navbar-brand">
                        <svg xmlns="http://www.w3.org/2000/svg" width="338" height="120" viewBox="0 0 338 120" version="1.1">
                            <path d="M 59.363 21.497 C 59.017 22.398, 59.196 23.596, 59.761 24.161 C 61.391 25.791, 64.500 24.692, 64.500 22.486 C 64.500 19.943, 60.272 19.128, 59.363 21.497 M 44.200 33.200 C 42.929 34.471, 42.589 39.765, 43.607 42.418 C 44.344 44.340, 51.975 44.625, 53.800 42.800 C 55.352 41.248, 55.352 34.752, 53.800 33.200 C 53.140 32.540, 50.980 32, 49 32 C 47.020 32, 44.860 32.540, 44.200 33.200 M 134.270 46.138 C 130.340 47.244, 125.998 53.201, 126.004 57.482 C 126.009 61.837, 129.475 66.883, 133.664 68.633 C 137.543 70.254, 140.742 69.871, 144.636 67.319 C 146.877 65.851, 146.941 65.593, 145.473 63.970 C 144.052 62.400, 143.580 62.363, 141.052 63.624 C 138.023 65.135, 133.917 64.292, 132.407 61.850 C 131.104 59.741, 131.947 53.587, 133.722 52.250 C 135.836 50.659, 140.237 50.637, 141.811 52.211 C 142.759 53.159, 143.468 52.976, 145.076 51.369 L 147.130 49.315 144.815 47.816 C 141.482 45.657, 137.968 45.098, 134.270 46.138 M 89 48.500 C 89 50.690, 89.433 51, 92.500 51 L 96 51 96 60 C 96 68.933, 96.019 69, 98.500 69 C 100.981 69, 101 68.933, 101 60 L 101 51 104.500 51 L 108 51 108 60 L 108 69 117 69 C 125.933 69, 126 68.981, 126 66.500 C 126 64.090, 125.767 64, 119.500 64 C 113.667 64, 113 63.795, 113 62 C 113 60.222, 113.667 60, 119 60 C 124.778 60, 125 59.905, 125 57.427 C 125 54.931, 124.830 54.863, 119.250 55.125 C 113.993 55.373, 113.473 55.208, 113.180 53.198 C 112.879 51.125, 113.233 51, 119.430 51 C 125.771 51, 126 50.913, 126 48.500 L 126 46 107.500 46 L 89 46 89 48.500 M 148 57.430 L 148 69 150.500 69 C 152.796 69, 153 68.633, 153 64.500 L 153 60 157.500 60 L 162 60 162 64.500 C 162 68.633, 162.204 69, 164.500 69 L 167 69 167 57.500 L 167 46 164.500 46 C 162.160 46, 162 46.326, 162 51.107 C 162 55.353, 161.733 56.112, 160.418 55.607 C 159.548 55.273, 157.549 55, 155.976 55 C 153.325 55, 153.092 54.688, 152.807 50.750 C 152.552 47.217, 152.120 46.446, 150.250 46.180 C 148.028 45.865, 148 46.004, 148 57.430 M 13 76.235 C 7.225 86.263, 2.367 95.176, 2.206 96.042 C 1.792 98.254, 5.765 103, 8.030 103 C 9.207 103, 10.906 101.309, 12.553 98.500 C 14.004 96.025, 15.576 94.238, 16.048 94.530 C 16.520 94.821, 17.910 96.846, 19.137 99.030 L 21.368 103 27.684 103 C 31.158 103, 34 102.793, 34 102.539 C 34 102.286, 31.342 97.688, 28.093 92.322 L 22.186 82.566 26.167 75.313 L 30.148 68.059 27.324 63.030 C 25.771 60.265, 24.275 58.002, 24 58.003 C 23.725 58.003, 18.775 66.208, 13 76.235" stroke="none" fill="#3c90d0" fill-rule="evenodd" />
                            <path d="M 48.465 25.057 C 48.106 25.638, 48.095 27.241, 48.441 28.620 C 48.948 30.640, 49.596 31.065, 51.785 30.813 C 54.038 30.553, 54.553 29.947, 54.813 27.250 C 55.104 24.235, 54.910 24, 52.122 24 C 50.470 24, 48.824 24.476, 48.465 25.057 M 57.518 30.945 C 57.159 32.075, 57.159 33.925, 57.518 35.055 C 58.046 36.720, 58.866 37.053, 61.835 36.805 C 65.299 36.517, 65.500 36.308, 65.500 33 C 65.500 29.692, 65.299 29.483, 61.835 29.195 C 58.866 28.947, 58.046 29.280, 57.518 30.945 M 37.403 35.430 C 35.747 36.590, 26 51.895, 26 53.336 C 26 53.885, 46.025 88.272, 47.154 89.661 C 48.477 91.290, 46.271 92.470, 44.559 91.049 C 43.815 90.431, 40.878 85.893, 38.033 80.963 C 35.188 76.033, 32.554 72.006, 32.180 72.014 C 31.806 72.022, 30.242 74.310, 28.704 77.098 L 25.908 82.166 31.857 92.333 L 37.806 102.500 51.903 102.777 C 59.656 102.930, 66 102.868, 66 102.640 C 66 102.411, 59.920 91.712, 52.488 78.862 C 40.141 57.512, 37.950 52.775, 40.329 52.571 C 40.785 52.532, 47.648 63.750, 55.580 77.500 C 68.026 99.074, 70.357 102.545, 72.589 102.825 C 75.855 103.235, 79 100.469, 79 97.186 C 79 94.479, 52.943 48.318, 50.247 46.250 C 49.351 45.563, 47.152 45, 45.361 45 C 42.144 45, 42.101 44.937, 41.802 39.829 C 41.472 34.172, 40.536 33.236, 37.403 35.430 M 144.863 51.761 C 143.630 53.335, 143.666 53.370, 145.250 52.128 C 146.879 50.850, 147 51.220, 147 57.500 C 147 63.780, 146.879 64.150, 145.250 62.872 C 143.666 61.630, 143.630 61.665, 144.863 63.239 C 147.059 66.040, 148 64.318, 148 57.500 C 148 50.682, 147.059 48.960, 144.863 51.761 M 113 52.941 C 113 54.009, 113.385 55.120, 113.856 55.411 C 114.326 55.702, 114.499 54.828, 114.239 53.470 C 113.675 50.519, 113 50.231, 113 52.941 M 113.158 62 C 113.158 63.375, 113.385 63.938, 113.662 63.250 C 113.940 62.563, 113.940 61.438, 113.662 60.750 C 113.385 60.063, 113.158 60.625, 113.158 62 M 96.017 74.286 C 94.651 74.977, 93.114 76.736, 92.601 78.194 C 91.206 82.159, 93.923 85.626, 99.754 87.324 C 102.545 88.138, 104.630 89.370, 104.816 90.318 C 105.294 92.749, 100.698 93.495, 96.903 91.602 C 93.943 90.125, 93.621 90.136, 92.437 91.755 C 91.335 93.262, 91.550 93.746, 94.016 95.307 C 98.266 97.998, 105.705 97.298, 108.176 93.976 C 110.806 90.440, 109.132 85.659, 104.685 84.003 C 97.732 81.415, 97 80.988, 97 79.521 C 97 77.740, 102.047 77.420, 105.024 79.013 C 106.521 79.814, 107.137 79.612, 107.975 78.047 C 108.876 76.363, 108.592 75.840, 106.066 74.534 C 102.483 72.681, 99.341 72.604, 96.017 74.286 M 115.190 75.026 C 108.222 79.274, 107.672 89.022, 114.096 94.427 C 119.786 99.215, 129.225 97.260, 132.365 90.643 C 134.588 85.960, 134.420 82.919, 131.720 78.912 C 127.630 72.843, 121.235 71.340, 115.190 75.026 M 135 84.971 L 135 97.081 143.250 96.790 C 149.788 96.560, 151.500 96.189, 151.500 95 C 151.500 93.894, 149.960 93.369, 145.637 93 L 139.774 92.500 139.637 83 C 139.507 73.957, 139.392 73.485, 137.250 73.180 C 135.023 72.864, 135 72.984, 135 84.971 M 151.363 74.497 C 151.047 75.321, 150.954 79.640, 151.156 84.094 C 151.492 91.500, 151.763 92.399, 154.318 94.597 C 158.204 97.939, 165.137 97.953, 168.465 94.626 C 170.958 92.133, 172.616 85.004, 171.754 80.491 C 171.312 78.179, 171.559 78, 175.199 78 L 179.120 78 178.912 87.250 C 178.715 96.023, 178.815 96.516, 180.852 96.820 C 182.922 97.127, 183 96.791, 183 87.570 L 183 78 186.500 78 C 189.576 78, 190 77.694, 190 75.476 L 190 72.951 178.500 73.071 L 167 73.191 167 81.096 C 167 87.667, 166.663 89.337, 165 91 C 162.509 93.491, 159.811 93.554, 157.655 91.171 C 156.399 89.784, 156 87.371, 156 81.171 C 156 73.625, 155.845 73, 153.969 73 C 152.851 73, 151.679 73.674, 151.363 74.497 M 191.701 73.632 C 191.316 74.018, 191 79.433, 191 85.667 L 191 97 193.532 97 L 196.063 97 195.782 85.262 C 195.550 75.607, 195.225 73.472, 193.951 73.228 C 193.099 73.064, 192.087 73.246, 191.701 73.632 M 204.500 73.954 C 198.445 76.458, 195.364 84.935, 198.384 90.777 C 200.712 95.277, 203.740 97, 209.323 97 C 213.536 97, 214.663 96.537, 217.600 93.600 C 220.489 90.711, 221 89.503, 221 85.565 C 221 82.943, 220.284 79.837, 219.352 78.414 C 216.324 73.793, 209.699 71.804, 204.500 73.954 M 222.667 73.667 C 222.300 74.033, 222 79.433, 222 85.667 L 222 97 224.458 97 C 226.824 97, 226.927 96.719, 227.208 89.513 L 227.500 82.026 233.286 89.513 C 237.059 94.395, 239.766 97, 241.068 97 C 242.965 97, 243.050 96.419, 242.782 85.250 C 242.518 74.261, 242.371 73.500, 240.500 73.500 C 238.711 73.500, 238.469 74.265, 238.206 80.760 L 237.912 88.020 231.944 80.510 C 226.389 73.519, 224.331 72.002, 222.667 73.667 M 248.017 74.286 C 246.651 74.977, 245.114 76.736, 244.601 78.194 C 243.206 82.159, 245.923 85.626, 251.754 87.324 C 257.154 88.898, 258.607 91.559, 254.613 92.561 C 253.106 92.939, 250.796 92.546, 248.865 91.582 C 245.759 90.033, 244.073 90.593, 244.015 93.193 C 243.976 94.961, 248.870 97, 253.150 97 C 257.042 97, 258.213 96.545, 259.927 94.365 C 263.745 89.512, 261.923 85.850, 254.342 83.138 C 251.570 82.146, 249.500 80.784, 249.500 79.953 C 249.500 78.134, 254.195 77.499, 256.909 78.951 C 258.545 79.827, 259.112 79.660, 259.975 78.047 C 260.876 76.363, 260.592 75.840, 258.066 74.534 C 254.483 72.681, 251.341 72.604, 248.017 74.286 M 318.500 74.403 C 310.161 78.084, 307.953 87.799, 314.066 93.912 C 317.423 97.269, 321.472 98.261, 326.338 96.917 C 331.559 95.476, 334 91.838, 334 85.500 C 334 79.118, 331.557 75.527, 326.205 74.040 C 321.732 72.798, 322.183 72.777, 318.500 74.403 M 272 85.500 L 272 97 274.500 97 C 276.672 97, 277 96.558, 277 93.630 C 277 90.373, 277.153 90.243, 281.541 89.748 C 287.440 89.083, 290 86.744, 290 82.019 C 290 76.186, 286.915 74, 278.686 74 L 272 74 272 85.500 M 291 85.500 L 291 97 293.500 97 C 295.750 97, 296 96.600, 296 93 C 296 89.676, 296.336 89, 297.986 89 C 299.195 89, 301.007 90.565, 302.619 93 C 304.714 96.166, 305.881 97, 308.219 97 L 311.173 97 308.189 92.943 L 305.205 88.885 307.603 86.488 C 310.695 83.396, 310.730 79.034, 307.686 76.174 C 305.753 74.358, 304.187 74, 298.186 74 L 291 74 291 85.500 M 116.455 80.050 C 113.768 83.019, 114.005 88.776, 116.911 91.129 C 118.182 92.158, 120.317 93, 121.656 93 C 124.650 93, 129 88.842, 129 85.980 C 129 83.588, 127.245 79.863, 125.600 78.765 C 123.387 77.288, 118.309 78.001, 116.455 80.050 M 204 80 C 199.051 84.949, 203.670 93.901, 210.484 92.565 C 212.143 92.239, 214.063 91.218, 214.750 90.295 C 216.642 87.757, 216.306 81.587, 214.171 79.655 C 211.655 77.378, 206.445 77.555, 204 80 M 277 81.500 C 277 84.793, 277.195 85, 280.300 85 C 283.376 85, 286 83.560, 286 81.871 C 286 80.149, 282.629 78, 279.929 78 C 277.248 78, 277 78.297, 277 81.500 M 296 81.500 C 296 84.700, 296.250 85, 298.918 85 C 303.314 85, 305 84.029, 305 81.500 C 305 78.971, 303.314 78, 298.918 78 C 296.250 78, 296 78.300, 296 81.500 M 318.011 79.790 C 316.410 81.086, 315.800 82.662, 315.800 85.500 C 315.800 92.611, 323.676 95.771, 327.927 90.365 C 330.677 86.870, 330.545 83.454, 327.545 80.455 C 324.646 77.555, 321.079 77.306, 318.011 79.790" stroke="none" fill="#184A45FF" fill-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div class="row d-flex mt-4">
                    <div action="#" method="post" style="width: 500px !important;">
                        <div class="row">
                            <div class="w-100" style="padding-left: 15px;">
                                <p style="
                      font-style: normal;
                      font-weight: 500;
                      font-size: 30px;
                      line-height: 45px;
                      color: #000000 !important;
                    ">
                                    @lang('lang.forgot_password')?
                                </p>
                            </div>
                            <!-- Email Address -->
                            <div class="w-100 mb-5" style="padding-left: 15px;">
                                <p style="
                      font-style: normal;
                      font-weight: 400;
                      font-size: 16px;
                      line-height: 24px;
                      color: #000000;
                      margin-bottom: 0px !important;
                    ">
                                    @lang('lang.Peteawyaawsaewlyccyp')
                                </p>
                                <form action="/forgot_password" method="post">
                                    @csrf
                            </div>
                            <div class="input-group col-lg-12 mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white px-4 border-md border-right-0 border-left-0 border-top-0 border-dark" style="border-radius: 0px !important;">
                                        <svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.49414 0H15.5059C16.3297 0 17 0.670272 17 1.49414V10.1529C17 10.9768 16.3297 11.6471 15.5059 11.6471H1.49414C0.670271 11.6471 0 10.9768 0 10.1529V1.49414C0 0.670272 0.670271 0 1.49414 0ZM1.68914 0.996094L1.88856 1.16214L7.90719 6.17386C8.25071 6.45987 8.74936 6.45987 9.09281 6.17386L15.1114 1.16214L15.3109 0.996094H1.68914ZM16.0039 1.71521L11.1001 5.79863L16.0039 9.06226V1.71521ZM1.49414 10.651H15.5059C15.7465 10.651 15.9478 10.4794 15.9939 10.2522L10.3014 6.46365L9.73018 6.93932C9.37377 7.23609 8.93685 7.38447 8.49997 7.38447C8.06308 7.38447 7.62619 7.23609 7.26976 6.93932L6.69853 6.46365L1.00605 10.2521C1.05221 10.4794 1.25348 10.651 1.49414 10.651ZM0.996094 9.06226L5.89993 5.79866L0.996094 1.71521V9.06226Z" fill="#000842" />
                                        </svg>
                                    </span>
                                </div>
                                <input id="email" type="email" name="email" placeholder="@lang('lang.enter_your_email_address')" value="{{session('email')}}" class="border-top-0 border-right-0 border-dark form-control bg-white border-left-0 border-md" style="border-radius: 0px !important;" />
                                <div class="col-lg-12">
                                    <p id="email-error" class="text-danger d-none">*Please enter your email.</p>
                                    @if(session('status') == 'invalid')
                                    <span id="email-error" class="text-danger"> * {{ session('message') }}</span>
                                    @enderror
                                </div>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            @if(isset($remainingTime))
                            <script>
                                var remainingTime = @json($remainingTime);
                                
                                var message = @json($forgot_pass);
                                var countdownInterval;

                                function startCountdown() {
                                    var countdownElement = document.getElementById('countdown');

                                    countdownInterval = setInterval(function() {
                                        var minutes = Math.floor(remainingTime / 60);
                                        var seconds = remainingTime % 60;

                                        countdownElement.textContent = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');

                                        if (remainingTime <= 0) {
                                            clearInterval(countdownInterval);
                                            countdownElement.textContent = 'Time expired';
                                            showAlert('Remaining Time:', message, 'warning');
                                        }

                                        remainingTime--;
                                    }, 1000);
                                }

                                var minutesRemaining = Math.ceil(remainingTime / 60);

                                function showAlert(title, message, type) {
                                    Swal.fire({
                                        title: title,
                                        html: message + ' ' + minutesRemaining + ' minutes ',
                                        icon: type,
                                        timer: remainingTime * 1000,
                                        timerProgressBar: true,
                                        onBeforeOpen: function() {
                                            startCountdown();
                                        },
                                        onClose: function() {
                                            clearInterval(countdownInterval);
                                        }
                                    });
                                }

                                showAlert('Limit Exceed', message, 'warning');
                            </script>
                            @endif



                            <!-- Submit Button -->
                            <div class="form-group col-lg-12 mx-auto mb-0" style="margin-top: 60px;">
                                <button type="submit" id="btn_reset_pass" class="font-weight-bold sign_up btn btn-block py-2 text-white" style="background-color:#184A45FF;" name="submit">
                                    <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">@lang('lang.send')</span>
                                </button>
                                <p class="mt-4">@lang('lang.you_can') <a class="text-warning" href="/login">@lang('login_here') !</a></p>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- For Demo Purpose -->
            <div class="col-md-5 col-lg-5 pr-lg-5 d-lg-block d-md-block d-none mb-5 mb-md-0">
                <div class="p-2 d-flex align-items-center justify-content-center" style="
          height: 90vh !important;
          border-radius: 15px;
        ">
                    <!-- Make the image responsive -->
                    <img class="img-fluid" src="{{ asset('assets/images/login-banner.png') }}" alt="banner image">
                </div>
            </div>
            <!-- Registeration Form -->
        </div>
    </div>

    @if (Session::has('otp'))
    <!-- Display the modal using JavaScript/jQuery or CSS styles -->
    <script>
        // JavaScript/jQuery code to show the modal
        // Replace the selector and code with your actual modal implementation
        $(document).ready(function() {
            $('#forgetpassword').modal('show');
        });
    </script>
    @endif

    <!-- forgetpassword Button Modal -->
    <div class="modal fade" id="forgetpassword" tabindex="-1" data-backdrop="static" aria-labelledby="forgetpasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="border: none;">
                    <h5 class="modal-title" id="forgetpasswordLabel"></h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="4" width="48" height="48" rx="24" fill="#D1FADF" />
                            <path d="M37.75 16H18.25C17.0073 16 16 17.3431 16 19V37C16 38.6569 17.0073 40 18.25 40H37.75C38.9927 40 40 38.6569 40 37V19C40 17.3431 38.9927 16 37.75 16ZM37.75 19V21.5503C36.699 22.6915 35.0234 24.466 31.4412 28.2059C30.6518 29.0339 29.0881 31.0229 28 30.9998C26.9121 31.0232 25.3479 29.0336 24.5588 28.2059C20.9772 24.4666 19.3012 22.6917 18.25 21.5503V19H37.75ZM18.25 37V25.3999C19.3241 26.5406 20.8473 28.1413 23.169 30.5653C24.1935 31.6406 25.9877 34.0144 28 33.9999C30.0024 34.0144 31.7739 31.675 32.8306 30.5658C35.1522 28.1418 36.6759 26.5407 37.75 25.3999V37H18.25Z" fill="#0F771A" />
                            <rect x="4" y="4" width="48" height="48" rx="24" stroke="#ECFDF3" stroke-width="8" />
                        </svg>
                        <h3 class="mt-3">@lang('lang.check_your_email')</h3>
                        <p class="mb-0">@lang('lang.we_sent_a_verification_code_to')</p>
                        <p>{{session('email')}}</p>
                        <form action="/forgot_password" method="post">
                            @csrf
                            <input type="hidden" name="email" value="{{ session('email') }}" />
                            <div class="inputfield mb-4 mt-2">
                                <input type="number" name="no1" maxlength="1" value="{{ $no[1] ?? '' }}" class="input" />
                                <input type="number" name="no2" maxlength="1" value="{{ $no[2] ?? '' }}" class="input" />
                                <input type="number" name="no3" maxlength="1" value="{{ $no[3] ?? '' }}" class="input" />
                                <input type="number" name="no4" maxlength="1" value="{{ $no[4] ?? '' }}" class="input" />
                                <input type="number" name="no5" maxlength="1" value="{{ $no[4] ?? '' }}" class="input" />
                            </div>
                            <button id="btn_verify_opt" class="btn btn-sm text-white mt-1" style="background-color: #184A45FF; border-radius: 8px; width: 20%;">@lang('lang.verify_email')</button>
                        </form>
                        @if (Session::has('invalid'))
                        <div class="text-danger">
                            <strong>{{ session('invalid') }}</strong>
                        </div>
                        <script>
                            $(".input").each(function() {
                                $(this).addClass("empty2");
                            });
                        </script>
                        @endif
                        <p class="mt-1">@lang('lang.didn’t_receive_the_email')? <a href="/forgot_password?email={{session('email')}}" style="color: #452C88;">@lang('lang.click_to_resend')</a></p>
                        <div class="py-5 mt-4">
                            @if (Session::has('otp'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>{{ session('otp') }}</strong>
                            </div>
                            @endif
                            <a href="/login" class="text-dark">
                                <p>
                                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.5 16L1 8.5L8.5 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M2.0415 8.5H17.2498" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    @lang('lang.back_to_login')
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- forgetpassword Button Modal End -->

    <script>
        $('#btn_reset_pass').on('click', function() {

            var email_input = $('#email').val().trim();

            if (email_input === '') {
                event.preventDefault();
                $('#email-error').text('*Please enter your email.').removeClass('d-none');
            } else {
                $('#spinner').removeClass('d-none');
                $('#text').addClass('d-none');
            }
            $('#email').on('input', function() {
                $('#email-error').addClass('d-none');
            });
        });

        function showiconss() {
            const inputpass = document.getElementById('inputpassword');
            const hideicon = document.getElementById('hideicon');
            const showicon = document.getElementById('showicon');
            if (inputpass.type === "password") {
                inputpass.type = "text";
                hideicon.style.display = "block";
                showicon.style.display = "none";
                console.log('hello world');

            } else {
                inputpass.type = "password"
                hideicon.style.display = "none";
                showicon.style.display = "block";
                console.log('hello');
            }
        }










        // Initial references
        const input = document.querySelectorAll(".input");
        const inputField = document.querySelector(".inputfield");
        const submitButton = document.getElementById("submit");
        let inputCount = 0;
        let finalInput = "";

        // Update input
        const updateInputConfig = (element, disabledStatus) => {
            if (!disabledStatus) {
                element.focus();
            } else {
                element.blur();
            }
        };

        const handleInput = (e) => {
            e.target.value = e.target.value.replace(/[^0-9]/g, "");
            let {
                value
            } = e.target;

            if (value.length === 1) {
                updateInputConfig(e.target, true);
                if (inputCount <= 4 && e.inputType !== "deleteContentBackward") {
                    finalInput += value;
                    if (inputCount < 4) {
                        updateInputConfig(e.target.nextElementSibling, false);
                    } else if (inputCount === 4) {
                        updateInputConfig(e.target.nextElementSibling, true);
                    }
                }
                inputCount += 1;
            } else if (value.length === 0 && e.inputType === "deleteContentBackward") {
                finalInput = finalInput.substring(0, finalInput.length - 1);
                if (inputCount === 0) {
                    updateInputConfig(e.target, false);
                    return false;
                }
                updateInputConfig(e.target, true);
                e.target.previousElementSibling.value = "";
                updateInputConfig(e.target.previousElementSibling, false);
                inputCount -= 1;
            } else if (value.length > 1) {
                e.target.value = value.split("")[0];
            }
            submitButton.classList.add("hide");
        };

        input.forEach((element) => {
            element.addEventListener("input", handleInput);
        });

        const handleBackspace = (e) => {
            const currentInput = e.target;
            if (currentInput.value.length === 0) {
                const previousInput = currentInput.previousElementSibling;
                if (previousInput) {
                    previousInput.focus();
                    previousInput.value = "";
                    updateInputConfig(previousInput, false);
                    inputCount--;
                }
            }
        };

        input.forEach((element) => {
            element.addEventListener("keydown", (e) => {
                if (e.key === "Backspace") {
                    handleBackspace(e);
                }
            });
        });

        // Handle paste event
        inputField.addEventListener("paste", (e) => {
            e.preventDefault();
            const pasteData = e.clipboardData.getData("text/plain");
            const digits = pasteData.match(/\d/g);
            if (digits && digits.length <= 5) {
                input.forEach((element, index) => {
                    element.value = digits[index] || "";
                    if (index < digits.length) {
                        updateInputConfig(element, true);
                    } else {
                        updateInputConfig(element, false);
                    }
                });
                inputCount = digits.length;
                finalInput = digits.join("");
                submitButton.classList.add("show");
                submitButton.classList.remove("hide");
            }
        });

        // Start
        const startInput = () => {
            inputCount = 0;
            finalInput = "";
            input.forEach((element) => {
                element.value = "";
            });
            updateInputConfig(inputField.firstElementChild, false);
        };

        window.onload = startInput();


        $("#btn_verify_opt").click(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Check if any input is empty
            let emptyInputExists = false;
            $(".input").each(function() {
                const value = $(this).val();
                if (value === "") {
                    $(this).addClass("empty2");
                    emptyInputExists = true;
                } else {
                    $(this).removeClass("empty2");
                }
            });

            if (emptyInputExists) {} else {
                // All inputs are filled, proceed with form submission
                $("form").submit();
            }
        });
    </script>

    <script>

    </script>
</body>

</html>