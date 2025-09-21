<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'fullName' => htmlspecialchars($_POST['fullName']),
        'email' => htmlspecialchars($_POST['email']),
        'studentId' => htmlspecialchars($_POST['studentId']),
        'department' => htmlspecialchars($_POST['department']),
        'year' => htmlspecialchars($_POST['year']),
        'registered_at' => date('Y-m-d H:i:s')
    ];

    // Store data as JSON (append to file)
    $file = 'registrations.json';
    $registrations = [];
    if (file_exists($file)) {
        $registrations = json_decode(file_get_contents($file), true) ?: [];
    }
    $registrations[] = $data;
    file_put_contents($file, json_encode($registrations, JSON_PRETTY_PRINT));
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Registration Successful | CampusConnect</title>
      <link rel="stylesheet" href="style.css" />
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
      <style>
        body {
          background: linear-gradient(135deg, #e3f2fd 0%, #f8fafc 100%);
          min-height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          font-family: 'Inter', sans-serif;
        }
        .confirmation-card {
          background: rgba(255,255,255,0.98);
          border-radius: 28px;
          box-shadow: 0 12px 40px rgba(102,126,234,0.13);
          padding: 56px 36px 40px 36px;
          max-width: 420px;
          width: 100%;
          text-align: center;
          animation: fadeInUp 0.8s cubic-bezier(0.4,0,0.2,1);
          position: relative;
        }
        .confirmation-icon {
          font-size: 3.2rem;
          margin-bottom: 12px;
          background: linear-gradient(135deg, #667eea, #48c6ef);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          background-clip: text;
        }
        .confirmation-card h2 {
          background: linear-gradient(135deg, #667eea, #764ba2);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          background-clip: text;
          font-size: 2.1rem;
          margin-bottom: 10px;
          font-weight: 800;
          letter-spacing: 0.5px;
        }
        .confirmation-card p {
          color: #444;
          font-size: 1.13rem;
          margin-bottom: 22px;
          line-height: 1.6;
        }
        .confirmation-details {
          background: linear-gradient(90deg, #e3f2fd 60%, #f8fafc 100%);
          border-radius: 14px;
          padding: 18px 14px;
          margin-bottom: 22px;
          color: #333;
          font-size: 1rem;
          text-align: left;
          box-shadow: 0 2px 10px rgba(102,126,234,0.07);
        }
        .confirmation-details strong {
          color: #667eea;
        }
        .confirmation-btn {
          display: inline-block;
          background: linear-gradient(135deg, #667eea, #764ba2);
          color: #fff;
          padding: 13px 36px;
          border-radius: 14px;
          font-size: 1.13rem;
          font-weight: 700;
          text-decoration: none;
          transition: background 0.2s, transform 0.2s;
          margin-bottom: 10px;
          box-shadow: 0 4px 18px rgba(102,126,234,0.10);
        }
        .confirmation-btn:hover {
          background: linear-gradient(135deg, #48c6ef, #667eea);
          transform: translateY(-2px) scale(1.04);
        }
        .confirmation-links {
          margin-top: 18px;
        }
        .confirmation-links a {
          color: #667eea;
          text-decoration: underline;
          font-size: 1rem;
          margin: 0 8px;
          transition: color 0.2s;
        }
        .confirmation-links a:hover {
          color: #764ba2;
        }
        @keyframes fadeInUp {
          from { opacity: 0; transform: translateY(50px);}
          to { opacity: 1; transform: translateY(0);}
        }
        @media (max-width: 600px) {
          .confirmation-card {
            padding: 32px 8vw 28px 8vw;
            max-width: 98vw;
          }
        }
      </style>
    </head>
    <body>
      <div class="confirmation-card">
        <div class="confirmation-icon">✅</div>
        <h2>Registration Successful!</h2>
        <p>
          Thank you,
           <strong><?php echo $data['fullName']; ?></strong>, for joining <span style="color:#667eea;font-weight:600;">CampusConnect</span>.<br>
          We’ve received your registration.<br>
          <span style="color:#48c6ef;">Welcome to the community!</span>
        </p>
        <div class="confirmation-details">
          <div><strong>Email:</strong>
           <?php echo $data['email']; ?>
          </div>
          <div><strong>Student ID:</strong>
           <?php echo $data['studentId']; ?>
          </div>
          <div><strong>Department:</strong>
           <?php echo ucfirst(str_replace('-', ' ', $data['department'])); ?>
          </div>
          <div><strong>Year:</strong>
           <?php echo ucfirst($data['year']); ?>
          </div>
          <div><strong>Registered at:</strong>
           <?php echo $data['registered_at']; ?>
          </div>
        </div>
        <a href="dashboard.html" class="confirmation-btn">Go to Dashboard</a>
        <div class="confirmation-links">
          <a href="index.html">Back to Home</a> |
          <a href="eventPlanner.html">Explore Events</a>
        </div>
      </div>
    </body>
    </html>
    <?php
    exit;
}
?>
