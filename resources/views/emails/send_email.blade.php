<!DOCTYPE html>
<html>

<head>
    <title>Invoice Payment Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        h3 {
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
            max-width: 200px;
            height: auto;
        }

        @media (max-width: 1100px) {
            .logo {
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
            <h4>{{ $emailData['body'] }}</h4>
            <p>Please take a moment to review the details and complete the payment at your earliest convenience. Your prompt attention to this matter is greatly appreciated.</p>
        </div>
        <div class="footer">
            <p>
                Thank you for your continued partnership with TechSolution Pro.! We are excited to offer a wide range of services to meet your needs. Whether you're looking for web development, design, marketing, or more, our team is here to help. Discover all our services and explore how we can assist you by visiting our website.
            </p>
            <a href="https://techsolutionspro.co.uk/">
                <strong>Visit our website for more services</strong>
            </a>
        </div>
    </div>
</body>

</html>