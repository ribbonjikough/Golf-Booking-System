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
        <div class="login-title">Visitor Login</div>
        <form class="login-form">
          <div class="login-form-row">
            <label for="email" class="login-form-label">Email/ Username</label>
            <input type="text" id="email" name="email" class="login-form-input" placeholder="Insert Email/ Username" autocomplete="username">
            <label for="password" class="login-form-label">Password</label>
            <input type="password" id="password" name="password" class="login-form-input" placeholder="**********" autocomplete="current-password">
          </div>
          <div class="login-checkbox-row">
            <input type="checkbox" id="remember" class="login-checkbox" />
            <label for="remember" class="login-checkbox-label">Remember Me?</label>
          </div>
          <a href="index.php" class="login-btn login-btn-next">Login</a>
          <div class="login-link-row">
            <a href="forgot_password.php" class="login-link">Forgot Password?</a>
            <a href="register_visitor.php" class="login-link">Register</a>
          </div>
        </form>
    </div>
</body>
<script src="assets/js/script.js"></script>
</html>