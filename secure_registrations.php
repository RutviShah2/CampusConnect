<?php
// filepath: d:\Programming\WebDevelopment\HTML\CampusConnect\secure_registration.php
session_start();
require_once 'db.php';

$errors = [];
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input validation and sanitization
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Sanitize inputs
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    // Validation
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = "Username can only contain letters, numbers, and underscores";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/', $password)) {
        $errors[] = "Password must contain at least one lowercase letter, one uppercase letter, and one number";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    // Check if username or email already exists
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $errors[] = "Username or email already exists";
        }
        $stmt->close();
    }
    
    // If no errors, hash password and insert user
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            $success_message = "Registration successful! You can now login.";
        } else {
            $errors[] = "Registration failed. Please try again.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Registration - CampusConnect</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Override hero positioning */
        .hero {
            position: relative;
            height: auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        
        .hero-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 60px 20px;
        }
        
        /* Secure registration at the very bottom */
        .secure-registration-section {
            background: #f8f9fa;
            padding: 60px 20px;
            margin-top: auto;
            width: 100%;
            position: relative;
            z-index: 1;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .section-title {
            color: #1a1a1a;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .section-subtitle {
            color: #666;
            font-size: 18px;
        }
        
        .registration-form {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(63, 136, 197, 0.15);
            padding: 40px;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            flex: 1;
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #1a1a1a;
            font-weight: 600;
            font-size: 14px;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fff;
            box-sizing: border-box;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3F88C5;
            box-shadow: 0 0 0 3px rgba(63, 136, 197, 0.1);
        }
        
        .error-box {
            background: #fff2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
        }
        
        .error-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .error-item {
            color: #dc2626;
            margin-bottom: 6px;
            font-size: 14px;
        }
        
        .success-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            color: #166534;
            font-weight: 600;
            text-align: center;
        }
        
        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .info-title {
            color: #1a1a1a;
            font-weight: 600;
            margin-bottom: 12px;
            font-size: 16px;
        }
        
        .info-list {
            margin-left: 20px;
            color: #64748b;
        }
        
        .info-list li {
            margin-bottom: 6px;
            font-size: 14px;
        }
        
        .submit-button {
            width: 100%;
            background: linear-gradient(135deg, #3F88C5 0%, #3182CE 100%);
            color: white;
            padding: 16px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .submit-button:hover {
            background: linear-gradient(135deg, #2c5282 0%, #2b6cb0 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(63, 136, 197, 0.4);
        }
        
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        
        .nav-link {
            color: #3F88C5;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background: #e6f2ff;
            text-decoration: none;
        }
        
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .secure-registration-section {
                padding: 40px 15px;
            }
            
            .registration-form {
                padding: 30px 20px;
            }
            
            .section-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <h2>CampusConnect</h2>
        </div>
        <ul class="navbar-nav">
            <li><a href="index.html">Home</a></li>
            <li><a href="dashboard.html">Dashboard</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to CampusConnect</h1>
            <p>Your gateway to campus life and connections</p>
        </div>
        
        <!-- Secure registration section moved to the bottom -->
        <div class="secure-registration-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">🔒 Secure Registration</h2>
                    <p class="section-subtitle">Join CampusConnect with advanced security features</p>
                </div>
                
                <div class="registration-form">
                    <?php if (!empty($errors)): ?>
                        <div class="error-box">
                            <ul class="error-list">
                                <?php foreach ($errors as $error): ?>
                                    <li class="error-item">⚠️ <?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($success_message)): ?>
                        <div class="success-box">
                            ✅ <?php echo htmlspecialchars($success_message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="info-box">
                        <h4 class="info-title">🛡️ Enhanced Security Features:</h4>
                        <ul class="info-list">
                            <li><strong>Input Validation:</strong> Username (3+ chars, alphanumeric), email format validation</li>
                            <li><strong>Strong Passwords:</strong> 6+ characters with uppercase, lowercase, and numbers</li>
                            <li><strong>Data Sanitization:</strong> All inputs are cleaned and validated</li>
                            <li><strong>Secure Storage:</strong> Passwords are hashed with bcrypt (never stored as plain text)</li>
                            <li><strong>Duplicate Prevention:</strong> Checks for existing username/email</li>
                        </ul>
                    </div>
                    
                    <form method="POST" action="">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="username">👤 Username</label>
                                <input type="text" id="username" name="username" class="form-input"
                                       value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" 
                                       placeholder="Enter your username" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">📧 Email Address</label>
                                <input type="email" id="email" name="email" class="form-input"
                                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                       placeholder="Enter your email" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">🔒 Password</label>
                                <input type="password" id="password" name="password" class="form-input"
                                       placeholder="Create a strong password" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm_password">🔐 Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-input"
                                       placeholder="Confirm your password" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="submit-button">
                            🚀 Create Secure Account
                        </button>
                    </form>
                    
                    <div class="nav-links">
                        <a href="login.php" class="nav-link">← Back to Login</a>
                        <a href="dashboard.html" class="nav-link">Go to Dashboard →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>