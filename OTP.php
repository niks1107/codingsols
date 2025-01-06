<?php
// Generate OTP
function generateOTP($length = 6) {
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= rand(0, 9);
    }
    return $otp;
}

// Send OTP email
function sendOTP($email, $otp) {
    $subject = "Your One-Time Password (OTP)";
    $message = "
        <html>
        <head>
            <title>Your OTP</title>
        </head>
        <body>
            <p>Dear User,</p>
            <p>Your One-Time Password (OTP) is: <strong>$otp</strong></p>
            <p>Please do not share this OTP with anyone. It is valid for a limited time.</p>
            <p>Thank you!</p>
        </body>
        </html>
    ";

    // Headers for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= "From: no-reply@yourdomain.com" . "\r\n";

    // Send email
    return mail($email, $subject, $message, $headers);
}

// Specify recipient email address
$recipientEmail = "recipient@example.com";

// Generate OTP
$otp = generateOTP();

// Send OTP and check if email was sent successfully
if (sendOTP($recipientEmail, $otp)) {
    echo "OTP sent successfully to $recipientEmail";
} else {
    echo "Failed to send OTP. Please check your mail server configuration.";
}
?>
