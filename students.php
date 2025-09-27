<?php
// students.php - Store and retrieve student data from MySQL
require 'db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $course = $conn->real_escape_string($_POST['course']);
    $conn->query("INSERT INTO students (name, email, course) VALUES ('$name', '$email', '$course')");
}

// Fetch all students
$students = [];
$result = $conn->query('SELECT * FROM students ORDER BY id DESC');
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Data | CampusConnect</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8fafc; }
        .container { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #6c63ff22; padding: 32px; }
        h2 { text-align: center; color: #3F88C5; margin-bottom: 24px; }
        form { margin-bottom: 32px; }
        input, select { width: 100%; padding: 10px; margin-bottom: 16px; border-radius: 8px; border: 1px solid #b3b8f7; }
        button { background: linear-gradient(135deg, #6c63ff, #48c6ef); color: #fff; border: none; border-radius: 8px; padding: 12px 0; width: 100%; font-weight: 700; font-size: 1rem; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 24px; }
        th, td { padding: 10px; border-bottom: 1px solid #e0e7ff; text-align: left; }
        th { background: #f0f4ff; color: #3F88C5; }
        tr:last-child td { border-bottom: none; }
    </style>
</head>
<body>
<div class="container">
    <h2>Student Data</h2>
    <form method="POST" autocomplete="off">
        <input type="text" name="name" placeholder="Student Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="course" placeholder="Course" required>
        <button type="submit">Add Student</button>
    </form>
    <h3>All Students</h3>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th></tr>
        <?php foreach ($students as $stu): ?>
            <tr>
                <td><?php echo $stu['id']; ?></td>
                <td><?php echo htmlspecialchars($stu['name']); ?></td>
                <td><?php echo htmlspecialchars($stu['email']); ?></td>
                <td><?php echo htmlspecialchars($stu['course']); ?></td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($students)): ?>
            <tr><td colspan="4" style="text-align:center; color:#888;">No students found.</td></tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>
