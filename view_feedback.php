<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Feedback Submissions | CampusConnect</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #3F88C5 0%, #6c63ff 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Inter', sans-serif;
    }
    .feedback-list-container {
      background: rgba(255,255,255,0.98);
      border-radius: 24px;
      box-shadow: 0 8px 32px rgba(63,136,197,0.13);
      border: 2px solid #3F88C5;
      padding: 44px 32px 36px 32px;
      max-width: 600px;
      width: 100%;
      margin: 0 auto;
      animation: fadeInUp 0.8s cubic-bezier(0.4,0,0.2,1);
    }
    .feedback-list-container h2 {
      margin-bottom: 18px;
      background: linear-gradient(135deg, #3F88C5, #6c63ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 900;
      letter-spacing: 1px;
      font-size: 2.1rem;
      text-align: center;
    }
    .feedback-entry {
      background: linear-gradient(120deg, #f7fafc 60%, #e3f2fd 100%);
      border-radius: 14px;
      box-shadow: 0 2px 10px rgba(63,136,197,0.07);
      padding: 18px 16px;
      margin-bottom: 18px;
      color: #333;
      font-size: 1.05rem;
      border-left: 5px solid #3F88C5;
      position: relative;
      transition: box-shadow 0.2s;
    }
    .feedback-entry:last-child {
      margin-bottom: 0;
    }
    .feedback-entry strong {
      color: #3F88C5;
    }
    .no-feedback {
      text-align: center;
      color: #888;
      font-size: 1.1rem;
      margin-top: 24px;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(50px);}
      to { opacity: 1; transform: translateY(0);}
    }
    @media (max-width: 700px) {
      .feedback-list-container {
        padding: 24px 4vw 18px 4vw;
        max-width: 98vw;
      }
    }
  </style>
</head>
<body>
  <div class="feedback-list-container">
    <h2>Feedback Submissions</h2>
    <?php
    $file = 'feedback.txt';
    if (file_exists($file) && filesize($file) > 0) {
      $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      foreach ($lines as $entry) {
        echo '<div class="feedback-entry">' . nl2br(htmlspecialchars($entry)) . '</div>';
      }
    } else {
      echo '<div class="no-feedback">No feedback submissions yet.</div>';
    }
    ?>
  </div>
</body>
</html>
