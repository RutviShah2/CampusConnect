<?php
// Database connection for CampusConnect
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connect to MySQL and fetch latest 5 events
$events = [];
$sql = "SELECT title, description, event_date FROM events ORDER BY event_date DESC LIMIT 5";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}
?>
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
