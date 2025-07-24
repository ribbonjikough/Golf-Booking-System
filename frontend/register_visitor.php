<?php
$phase = 1;
if (isset($_GET['phase'])) {
  $phase = intval($_GET['phase']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Registration | cllsystems</title>
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
        <?php if ($phase === 1): ?>
          <div class="login-title">Email OTP</div>
          <form class="login-form" id="otpPhaseForm">
            <div class="login-form-row">
              <label for="email" class="login-form-label">Insert Email for OTP</label>
              <div class="login-form-otp-row">
                <input type="email" id="email" name="email" class="login-form-input" placeholder="abc@example.com" autocomplete="email">
                <button type="button" class="login-send-otp" id="sendOtpBtn">Send OTP</button>
              </div>
              <input type="text" id="otp" name="otp" class="login-form-input" placeholder="Insert OTP here" autocomplete="off">
            </div>
            <button type="button" class="login-btn-verify" id="verifyBtn" disabled>Verify</button>
          </form>
        <?php elseif ($phase === 2): ?>
          <div class="login-title">Visitor Registration</div>
          <form class="login-form" id="registerPhaseForm">
            <div class="login-form-row">
              <label for="reg_email" class="login-form-label">Email</label>
              <input type="email" id="reg_email" name="reg_email" class="login-form-input" placeholder="abc@example.com" autocomplete="email">
            </div>
            <div class="login-form-row">
              <label for="reg_username" class="login-form-label">Username</label>
              <input type="text" id="reg_username" name="reg_username" class="login-form-input" placeholder="Insert Username" autocomplete="username">
            </div>
            <div class="login-form-row">
              <label for="reg_fullname" class="login-form-label">Full Name</label>
              <input type="text" id="reg_fullname" name="reg_fullname" class="login-form-input" placeholder="Insert Full Name" autocomplete="name">
            </div>
            <div class="login-form-row">
              <label for="reg_mobile" class="login-form-label">Mobile No</label>
              <input type="tel" id="reg_mobile" name="reg_mobile" class="login-form-input" placeholder="Insert Mobile No" autocomplete="tel">
            </div>
            <div class="login-form-row">
              <label for="reg_password" class="login-form-label">Password</label>
              <input type="password" id="reg_password" name="reg_password" class="login-form-input" placeholder="**********" autocomplete="new-password">
            </div>
            <div class="login-form-row">
              <label for="reg_confirm" class="login-form-label">Confirm Password</label>
              <input type="password" id="reg_confirm" name="reg_confirm" class="login-form-input" placeholder="**********" autocomplete="new-password">
            </div>
            <button type="button" class="login-btn login-btn-next">Sign Up</button>
          </form>
        <?php elseif ($phase === 3): ?>
          <div class="login-title">Visitor Registration Complete</div>
          <button onclick="window.location.href='login.php'" class="login-btn login-btn-next" style="margin-top:32px;">Head to Login Page</button>
        <?php endif; ?>
    </div>
</body>
<script src="assets/js/script.js"></script>
</html>