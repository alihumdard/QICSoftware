<!DOCTYPE html>
<html>
<head>
    <title>Scooble Updates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        /* .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        } */
        h1 {
            color: #333333;
            margin-bottom: 20px;
        }
        h2 {
            color: #555555;
            margin-bottom: 20px;
        }
        .message {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
        }
        .logo {
            text-align: left;
        }
        .logo img {
            display: block;
            margin: 0;
            /* max-width: 200px; */
            /* height: auto; */
        }
        @media (max-width: 1100px){
            .logo{
                margin-left: 39% !important;
            }
        }
    </style>
</head>
<body style="background-color: #f9f9f9;">
    <div class="container" style="text-align: center;">
        <div class="logo" style="margin-left: 42%;">
            <img src="{{ $message->embed(public_path('assets/images/Logo.png')) }}" alt="logo" />
        </div>
        <h3>Dear, {{ $emailData['name'] }}</h3>
        <div class="message">
            <p>{{ $emailData['body'] }}</p>
            @if($emailData['otp'] !== 'Account Activation')
            <h3>Your OTP for verification is: <strong>{{ $emailData['otp'] }}</strong></h3>
            @endif
        </div>
        <div class="footer">
            <h3>Thank you for choosing our services!</h3>
        </div>
    </div>
</body>
</html>
