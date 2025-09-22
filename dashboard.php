<?php
session_start();
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';
$events = [];
$sql = "SELECT title, description, event_date FROM events ORDER BY event_date DESC LIMIT 5";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
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
  <div class="dashboard-card" style="margin-top:24px; text-align:left;">
    <h3 style="text-align:center; margin-bottom:16px;">Latest Events</h3>
    <?php if (count($events) > 0): ?>
      <ul style="list-style:none; padding:0;">
        <?php foreach($events as $event): ?>
          <li style="margin-bottom:18px; padding-bottom:10px; border-bottom:1px solid #e0e7ff;">
            <strong><?php echo htmlspecialchars($event['title']); ?></strong><br>
            <span style="color:#6c63ff; font-size:0.97em;">Date: <?php echo htmlspecialchars($event['event_date']); ?></span><br>
            <span><?php echo htmlspecialchars($event['description']); ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p style="text-align:center; color:#888;">No events found.</p>
    <?php endif; ?>
  </div>
</body>
</html>