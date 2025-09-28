<?php
// filepath: d:\Programming\WebDevelopment\HTML\CampusConnect\admin_dashboard.php
session_start();
require_once 'db.php';

// Simple admin authentication (you can enhance this)
$admin_logged_in = isset($_SESSION['admin']) && $_SESSION['admin'] === true;

// Admin login handling
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
    $admin_username = $_POST['admin_username'] ?? '';
    $admin_password = $_POST['admin_password'] ?? '';
    
    // Simple admin credentials (you can make this more secure)
    if ($admin_username === 'admin' && $admin_password === 'admin123') {
        $_SESSION['admin'] = true;
        $admin_logged_in = true;
    } else {
        $login_error = "Invalid admin credentials!";
    }
}

// Admin logout
if (isset($_GET['logout'])) {
    unset($_SESSION['admin']);
    header("Location: admin_dashboard.php");
    exit();
}

// Handle user management actions
$message = '';
if ($admin_logged_in && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_user'])) {
        $user_id = intval($_POST['user_id']);
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $message = "User deleted successfully!";
        } else {
            $message = "Error deleting user.";
        }
        $stmt->close();
    }
    
    if (isset($_POST['update_user'])) {
        $user_id = intval($_POST['user_id']);
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $email, $user_id);
        if ($stmt->execute()) {
            $message = "User updated successfully!";
        } else {
            $message = "Error updating user.";
        }
        $stmt->close();
    }
}

// Fetch all users
$users = [];
if ($admin_logged_in) {
    $sql = "SELECT id, username, email, created_at FROM users ORDER BY created_at DESC";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CampusConnect</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(63, 136, 197, 0.15);
            margin-top: 40px;
        }
        
        .admin-header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px 0;
            background: linear-gradient(135deg, #3F88C5 0%, #3182CE 100%);
            color: white;
            border-radius: 12px;
        }
        
        .admin-title {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .admin-subtitle {
            font-size: 18px;
            opacity: 0.9;
        }
        
        .login-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 40px;
            background: #f8f9fa;
            border-radius: 12px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #1a1a1a;
            font-weight: 600;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3F88C5;
            box-shadow: 0 0 0 3px rgba(63, 136, 197, 0.1);
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3F88C5 0%, #3182CE 100%);
            color: white;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #2c5282 0%, #2b6cb0 100%);
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        
        .btn-danger:hover {
            background: #c82333;
        }
        
        .btn-warning {
            background: #ffc107;
            color: #212529;
        }
        
        .btn-warning:hover {
            background: #e0a800;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #545b62;
        }
        
        .users-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .users-table th,
        .users-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }
        
        .users-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #1a1a1a;
        }
        
        .users-table tr:hover {
            background: #f8f9ff;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #3F88C5;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #3F88C5;
            margin-bottom: 8px;
        }
        
        .stat-label {
            color: #666;
            font-size: 14px;
            font-weight: 500;
        }
        
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .edit-form {
            display: none;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
        }
        
        .edit-form.active {
            display: block;
        }
        
        .logout-link {
            position: absolute;
            top: 20px;
            right: 20px;
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
        
        .logout-link:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .admin-container {
                margin: 20px 10px;
                padding: 15px;
            }
            
            .users-table {
                font-size: 14px;
            }
            
            .users-table th,
            .users-table td {
                padding: 10px 8px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                text-align: center;
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

    <div class="admin-container">
        <?php if (!$admin_logged_in): ?>
            <!-- Admin Login Form -->
            <div class="admin-header">
                <h1 class="admin-title">Admin Login</h1>
                <p class="admin-subtitle">Access the CampusConnect Admin Dashboard</p>
            </div>
            
            <?php if (isset($login_error)): ?>
                <div class="message error">
                     <?php echo htmlspecialchars($login_error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" class="login-form">
                <div class="form-group">
                    <label for="admin_username"> Admin Username</label>
                    <input type="text" id="admin_username" name="admin_username" class="form-input" 
                           placeholder="Enter admin username" required>
                </div>
                
                <div class="form-group">
                    <label for="admin_password"> Admin Password</label>
                    <input type="password" id="admin_password" name="admin_password" class="form-input" 
                           placeholder="Enter admin password" required>
                </div>
                
                <button type="submit" name="admin_login" class="btn btn-primary" style="width: 100%;">
                    Login to Admin Dashboard
                </button>
                
                <div style="text-align: center; margin-top: 20px; font-size: 14px; color: #666;">
                    Demo credentials: admin / admin123
                </div>
            </form>
            
        <?php else: ?>
            <!-- Admin Dashboard -->
            <div class="admin-header" style="position: relative;">
                <h1 class="admin-title">Admin Dashboard</h1>
                <p class="admin-subtitle">Manage CampusConnect Users</p>
                <a href="?logout=1" class="logout-link">Logout</a>
            </div>
            
            <?php if (!empty($message)): ?>
                <div class="message success">
                     <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number"><?php echo count($users); ?></div>
                    <div class="stat-label">Total Users</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo count(array_filter($users, function($user) { return strtotime($user['created_at']) > strtotime('-7 days'); })); ?></div>
                    <div class="stat-label">New This Week</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo count(array_filter($users, function($user) { return strtotime($user['created_at']) > strtotime('-30 days'); })); ?></div>
                    <div class="stat-label">New This Month</div>
                </div>
            </div>
            
            <!-- Users Management -->
            <h2 style="color: #1a1a1a; margin-bottom: 20px;">User Management</h2>
            
            <?php if (count($users) > 0): ?>
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars(date('M d, Y', strtotime($user['created_at']))); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <button onclick="toggleEdit(<?php echo $user['id']; ?>)" class="btn btn-warning">
                                             Edit
                                        </button>
                                        <form method="POST" style="display: inline;" 
                                              onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <button type="submit" name="delete_user" class="btn btn-danger">
                                                 Delete
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <!-- Edit Form (Hidden by default) -->
                                    <div id="edit-form-<?php echo $user['id']; ?>" class="edit-form">
                                        <form method="POST">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <div style="display: flex; gap: 10px; align-items: end;">
                                                <div style="flex: 1;">
                                                    <label>Username:</label>
                                                    <input type="text" name="username" class="form-input" 
                                                           value="<?php echo htmlspecialchars($user['username']); ?>" required>
                                                </div>
                                                <div style="flex: 1;">
                                                    <label>Email:</label>
                                                    <input type="email" name="email" class="form-input" 
                                                           value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                                </div>
                                                <div>
                                                    <button type="submit" name="update_user" class="btn btn-primary">
                                                        Save
                                                    </button>
                                                    <button type="button" onclick="toggleEdit(<?php echo $user['id']; ?>)" class="btn btn-secondary">
                                                         Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div style="text-align: center; padding: 40px; color: #666;">
                    <h3>No Users Found</h3>
                    <p>No users have registered yet.</p>
                </div>
            <?php endif; ?>
            
        <?php endif; ?>
    </div>

    <script>
        function toggleEdit(userId) {
            const editForm = document.getElementById('edit-form-' + userId);
            editForm.classList.toggle('active');
        }
    </script>
</body>
</html>