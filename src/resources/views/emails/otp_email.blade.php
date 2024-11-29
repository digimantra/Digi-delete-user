<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #666;
        }
        .otp {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1>OTP Verification</h1>
        <p>Hello,</p>
        <p>Your OTP for account deletion is:</p>
        <div class="otp">{{ $otp }}</div>
        <p>This OTP is valid for 10 minute. Please do not share it with anyone.</p>
        <p>If you did not request this, please ignore this email.</p>
    </div>
</body>
</html>
