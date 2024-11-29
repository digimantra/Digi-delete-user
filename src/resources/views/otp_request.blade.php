<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request OTP</title>
    <style>
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }
        .error {
            color: red; 
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    @if (session('success'))
    <div class="alert alert-primary">
        {{ session('success') }}
    </div>
    @endif
    
    @if (session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
    @endif

    <div class="container mt-5">
        <h1>Request OTP</h1>


        <form id="otpRequestForm" method="POST" action="{{ route('otp.request') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <button type="submit" class="btn btn-primary" id="sendOtpButton">Send OTP</button>
            <div id="responseMessage" class="mt-3"></div>
        </form>
    </div>


    <script>
        document.getElementById('otpRequestForm').addEventListener('submit', function() {
            var button = document.getElementById('sendOtpButton');
            button.disabled = true;
            button.innerText = 'Sending OTP...'; 
        });
    </script>
</body>
</html>
