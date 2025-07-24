<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | cllsystems</title>
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-bg">
    <div class="login-bg-pic"></div>
    <div class="login-center-frame">
        <a href="login.php" class="login-back-btn" aria-label="Back">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <polygon points="15,6 9,12 15,18" fill="#222"/>
          </svg>
        </a>
        <img src="assets/img/company-logo.png" alt="cllsystems" class="login-logo">
        <div class="login-title">Email OTP</div>
          <form class="login-form">
            <div class="login-form-row">
              <label for="email" class="login-form-label">Insert Email for OTP</label>
              <div class="login-form-otp-row">
                <input type="email" id="email" name="email" class="login-form-input" placeholder="abc@example.com" autocomplete="email">
                <button type="button" class="login-send-otp" id="sendOtpBtn" disabled>Send OTP</button>
              </div>
              <input type="text" id="otp" name="otp" class="login-form-input" placeholder="Insert OTP here" autocomplete="off">
            </div>
            <button type="submit" class="login-btn-verify" id="verifyBtn" disabled>Verify</button>
          </form>
    </div>
</body>
<script src="assets/js/script.js"></script>
</html>