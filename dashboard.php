<?php
session_start();
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard | CampusConnect</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
  background: linear-gradient(135deg, #e3f2fd 0%, #f8fafc 100%);
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'Inter', sans-serif;
}
.dashboard-card {
  background: rgba(255,255,255,0.98);
  border-radius: 24px;
  box-shadow: 0 8px 32px rgba(108,99,255,0.13);
  padding: 48px 32px 36px 32px;
  max-width: 420px;
  width: 100%;
  text-align: center;
  animation: fadeInUp 0.8s cubic-bezier(0.4,0,0.2,1);
}
.dashboard-card h2 {
  background: linear-gradient(135deg, #6c63ff, #48c6ef);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  font-weight: 700;
  text-decoration: none;
  transition: background 0.2s, box-shadow 0.2s;
  margin-top: 18px;
  box-shadow: 0 4px 18px rgba(108,99,255,0.13);
}
    .confirmation-btn:hover {
      background: linear-gradient(135deg, #48c6ef, #6c63ff);
      box-shadow: 0 6px 24px rgba(72,198,239,0.13);
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(50px);}
      to { opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <div class="dashboard-card">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <a href="logout.php" class="confirmation-btn">Logout</a>
  </div>
</body>
</html>