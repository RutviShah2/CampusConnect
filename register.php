<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data safely
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
          overflow-x: hidden;
        }
        .confirmation-card {
          background: rgba(255,255,255,0.98);
          border-radius: 32px;
          box-shadow: 0 16px 48px rgba(102,126,234,0.15);
          padding: 60px 38px 44px 38px;
          max-width: 440px;
          width: 100%;
          text-align: center;
          animation: fadeInUp 0.8s cubic-bezier(0.4,0,0.2,1);
          position: relative;
        }
        .confirmation-icon {
          width: 70px;
          height: 70px;
          margin: 0 auto 18px auto;
          display: flex;
          align-items: center;
          justify-content: center;
          background: linear-gradient(135deg, #667eea, #48c6ef);
          border-radius: 50%;
          box-shadow: 0 4px 18px rgba(102,126,234,0.13);
          animation: popIn 0.7s cubic-bezier(.4,0,.2,1);
        }
        .confirmation-icon svg {
          width: 40px;
          height: 40px;
          display: block;
          margin: auto;
          stroke-dasharray: 100;
          stroke-dashoffset: 100;
          animation: checkmark 1s 0.2s forwards cubic-bezier(.4,0,.2,1);
        }
        @keyframes checkmark {
          to { stroke-dashoffset: 0; }
        }
        @keyframes popIn {
          0% { transform: scale(0.5); opacity: 0;}
          80% { transform: scale(1.1);}
          100% { transform: scale(1); opacity: 1;}
        }
        .confetti {
          position: absolute;
          left: 0; top: 0; width: 100%; height: 100%;
          pointer-events: none;
          z-index: 2;
        }
        .confirmation-card h2 {
          background: linear-gradient(135deg, #667eea, #764ba2);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          background-clip: text;
          font-size: 2.2rem;
          margin-bottom: 12px;
          font-weight: 800;
          letter-spacing: 0.5px;
        }
        .confirmation-card p {
          color: #444;
          font-size: 1.15rem;
          margin-bottom: 22px;
          line-height: 1.6;
        }
        .confirmation-details {
          background: linear-gradient(90deg, #e3f2fd 60%, #f8fafc 100%);
          border-radius: 16px;
          padding: 20px 16px;
          margin-bottom: 26px;
          color: #333;
          font-size: 1.03rem;
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
          padding: 15px 38px;
          border-radius: 16px;
          font-size: 1.15rem;
          font-weight: 700;
          text-decoration: none;
          transition: background 0.2s, transform 0.2s;
          margin-bottom: 12px;
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
            padding: 32px 4vw 28px 4vw;
            max-width: 98vw;
          }
        }
      </style>
    </head>
    <body>
      <div class="confirmation-card">
        <canvas class="confetti"></canvas>
        <div class="confirmation-icon">
          <svg viewBox="0 0 52 52" fill="none" stroke="#fff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="26" cy="26" r="25" stroke="#fff" stroke-opacity="0.18" />
            <polyline points="16,28 24,36 38,18" />
          </svg>
        </div>
        <h2>Registration Successful!</h2>
        <p>
          Thank you, <strong><?php echo $data['fullName']; ?></strong>, for joining <span style="color:#667eea;font-weight:600;">CampusConnect</span>.<br>
          We’ve received your registration.<br>
          <span style="color:#48c6ef;">Welcome to the community!</span>
        </p>
        <div class="confirmation-details">
          <div><strong>Email:</strong> <?php echo $data['email']; ?></div>
          <div><strong>Student ID:</strong> <?php echo $data['studentId']; ?></div>
          <div><strong>Department:</strong> <?php echo $data['department']; ?></div>
          <div><strong>Year:</strong> <?php echo $data['year']; ?></div>
          <div><strong>Registered at:</strong> <?php echo $data['registered_at']; ?></div>
        </div>
        <a href="dashboard.html" class="confirmation-btn">Go to Dashboard</a>
        <div class="confirmation-links">
          <a href="index.html">Back to Home</a> |
          <a href="eventPlanner.html">Explore Events</a>
        </div>
      </div>
      <script>
        // Simple confetti effect
        const canvas = document.querySelector('.confetti');
        const ctx = canvas.getContext('2d');
        let W = canvas.width = window.innerWidth;
        let H = canvas.height = window.innerHeight;
        let particles = [];
        for(let i=0;i<60;i++){
          particles.push({
            x: Math.random()*W,
            y: Math.random()*H/2,
            r: Math.random()*6+4,
            d: Math.random()*Math.PI*2,
            color: `hsl(${Math.random()*360},80%,60%)`,
            tilt: Math.random()*10-10
          });
        }
        function draw(){
          ctx.clearRect(0,0,W,H);
          for(let i=0;i<particles.length;i++){
            let p = particles[i];
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI*2, false);
            ctx.fillStyle = p.color;
            ctx.fill();
          }
          update();
        }
        function update(){
          for(let i=0;i<particles.length;i++){
            let p = particles[i];
            p.y += Math.cos(p.d)+2+p.r/5;
            p.x += Math.sin(p.d)*2;
            if(p.y > H){
              p.y = -10;
              p.x = Math.random()*W;
            }
          }
        }
        setInterval(draw, 33);
        window.addEventListener('resize',()=>{
          W = canvas.width = window.innerWidth;
          H = canvas.height = window.innerHeight;
        });
      </script>
    </body>
    </html>
    <?php
    exit;
}
?>