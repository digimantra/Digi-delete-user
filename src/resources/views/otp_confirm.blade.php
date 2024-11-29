<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm OTP</title>
    <style>
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Confirm OTP</h1>
        <form id="otpConfirmForm" method="POST" action="{{ route('otp.confirm') }}">
            @csrf
            <div class="form-group">
                <label for="otp">Enter OTP:</label>
                <input type="text" class="form-control" id="otp" name="otp" required pattern="^\d{6}$" title="Please enter a 6-digit OTP." maxlength="6" oninput="validateOtpInput(this)">
            </div>
            <button type="submit" class="btn btn-primary">Confirm OTP</button>
            <div id="timer" class="mt-3"></div>
            <div id="responseMessage" class="mt-3"></div>
        </form>
        <div id="resendLinkContainer" class="mt-3" style="display: none;">
            <a href="#" id="resendLink" onclick="requestNewOtp()">Resend OTP</a>
        </div>
    </div>

    <script>
        let timeLeft = 30;
        const timeLimit = 30;
        const timerElement = document.getElementById('timer');
        const resendLinkContainer = document.getElementById('resendLinkContainer');
        let timerInterval;
        function validateOtpInput(input) {
            input.value = input.value.replace(/\D/g, '');
        }


        function startCountdown() {
            timeLeft = timeLimit;
            timerElement.style.display = 'block';
            resendLinkContainer.style.display = 'none';

            timerElement.innerHTML = `Time remaining: ${timeLeft} seconds`;

            timerInterval = setInterval(() => {
                timeLeft--;
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerElement.style.display = 'none';
                    resendLinkContainer.style.display = 'block';
                } else {
                    timerElement.innerHTML = `Time remaining: ${timeLeft} seconds`;
                }
            }, 1000);
        }

        // Function to request a new OTP
        function requestNewOtp() {
            const email = '{{ Cache::get("otp_email") }}';  
            fetch('/request-otp/resend', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                } 
                return response.json();
            })
            .then(data => {
                if (data.message) {
                    document.getElementById('responseMessage').innerText = data.message;
                    startCountdown(); 
                } else {
                    throw new Error('Unexpected response format');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('responseMessage').innerText = 'Error resending OTP. Please try again.';
            });
        } 
        startCountdown();
    </script>
</body>
</html>
