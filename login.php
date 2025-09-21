<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | CampusConnect</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #6c63ff 0%, #48c6ef 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Inter', sans-serif;
    }
    .login-container {
      background: rgba(255,255,255,0.98);
      border-radius: 24px;
      box-shadow: 0 8px 32px rgba(108,99,255,0.13);
      border: 2px solid #e0e7ff;
      padding: 48px 32px 36px 32px;
      max-width: 350px;
      width: 100%;
      margin: 0 auto;
      animation: fadeInUp 0.8s cubic-bezier(0.4,0,0.2,1);
    }
    .login-form h2 {
      margin-bottom: 18px;
      background: linear-gradient(135deg, #6c63ff, #48c6ef);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 800;
      letter-spacing: 1px;
      font-size: 2rem;
      text-align: center;
    }
    .login-form input[type="text"],
    .login-form input[type="password"] {
      width: 100%;
      padding: 12px 14px;
      margin-bottom: 16px;
      border-radius: 10px;
      border: 1.5px solid #b3b8f7;
      font-size: 1rem;
      background: #f8fafc;
      transition: border 0.2s, box-shadow 0.2s;
      color: #333;
    }
    .login-form input[type="text"]:focus,
    .login-form input[type="password"]:focus {
      border: 1.5px solid #6c63ff;
      box-shadow: 0 0 0 2px #48c6ef33;
      outline: none;
    }
    .login-form label {
      display: flex;
      align-items: center;
      font-size: 0.98rem;
      color: #6c63ff;
      margin-bottom: 18px;
      gap: 7px;
      font-weight: 500;
    }
    .login-btn {
      width: 100%;
      background: linear-gradient(135deg, #6c63ff, #48c6ef);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 13px 0;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.2s, box-shadow 0.2s;
      margin-bottom: 8px;
      box-shadow: 0 4px 18px rgba(108,99,255,0.13);
    }
    .login-btn:hover {
      background: linear-gradient(135deg, #48c6ef, #6c63ff);
      box-shadow: 0 6px 24px rgba(72,198,239,0.13);
    }
    .error-msg {
      color: #fff;
      background: linear-gradient(90deg, #e74c3c 60%, #6c63ff 100%);
      border-radius: 8px;
      padding: 10px 0;
      margin-top: 10px;
      font-size: 1rem;
      text-align: center;
      letter-spacing: 0.5px;
      box-shadow: 0 2px 8px rgba(231,76,60,0.10);
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(50px);}
      to { opacity: 1; transform: translateY(0);}
    }
    @media (max-width: 600px) {
      .login-container {
        padding: 28px 6vw 20px 6vw;
        max-width: 98vw;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <form action="logout.php" method="POST" class="login-form">
      <h2>Login</h2>
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <label>
        <input type="checkbox" name="remember" /> Remember Me
      </label>
      <button type="submit" class="login-btn">Login</button>
      <?php if (isset($_GET['error'])): ?>
        <div class="error-msg">Invalid credentials. Please try again.</div>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>