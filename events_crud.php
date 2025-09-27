<?php
// events_crud.php - Full CRUD for managing events
require 'db.php';

// Handle Create
if (isset($_POST['add'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $event_date = $conn->real_escape_string($_POST['event_date']);
    $conn->query("INSERT INTO events (title, description, event_date) VALUES ('$title', '$description', '$event_date')");
}

// Handle Update
if (isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $event_date = $conn->real_escape_string($_POST['event_date']);
    $conn->query("UPDATE events SET title='$title', description='$description', event_date='$event_date' WHERE id=$id");
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM events WHERE id=$id");
}

// Fetch all events
$events = [];
$result = $conn->query('SELECT * FROM events ORDER BY event_date DESC');
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

// For editing
$edit_event = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $res = $conn->query("SELECT * FROM events WHERE id=$id");
    if ($res && $res->num_rows === 1) {
        $edit_event = $res->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Events | CampusConnect</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8fafc; }
        .container { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #6c63ff22; padding: 32px; }
        h2 { text-align: center; color: #3F88C5; margin-bottom: 24px; }
        form { margin-bottom: 32px; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 16px; border-radius: 8px; border: 1px solid #b3b8f7; }
        button { background: linear-gradient(135deg, #6c63ff, #48c6ef); color: #fff; border: none; border-radius: 8px; padding: 12px 0; width: 100%; font-weight: 700; font-size: 1rem; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 24px; }
        th, td { padding: 10px; border-bottom: 1px solid #e0e7ff; text-align: left; }
        th { background: #f0f4ff; color: #3F88C5; }
        tr:last-child td { border-bottom: none; }
        .actions a { margin-right: 8px; color: #3F88C5; text-decoration: underline; }
        .actions a.delete { color: #e74c3c; }
    </style>
</head>
<body>
<div class="container">
    <h2>Manage Events</h2>
    <form method="POST" autocomplete="off">
        <?php if ($edit_event): ?>
            <input type="hidden" name="id" value="<?php echo $edit_event['id']; ?>">
        <?php endif; ?>
        <input type="text" name="title" placeholder="Event Title" required value="<?php echo $edit_event ? htmlspecialchars($edit_event['title']) : ''; ?>">
        <textarea name="description" placeholder="Description" required><?php echo $edit_event ? htmlspecialchars($edit_event['description']) : ''; ?></textarea>
        <input type="date" name="event_date" required value="<?php echo $edit_event ? htmlspecialchars($edit_event['event_date']) : ''; ?>">
        <?php if ($edit_event): ?>
            <button type="submit" name="update">Update Event</button>
            <a href="events_crud.php" style="display:inline-block;margin-top:10px;color:#888;text-decoration:underline;">Cancel</a>
        <?php else: ?>
            <button type="submit" name="add">Add Event</button>
        <?php endif; ?>
    </form>
    <h3>All Events</h3>
    <table>
        <tr><th>ID</th><th>Title</th><th>Date</th><th>Description</th><th>Actions</th></tr>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?php echo $event['id']; ?></td>
                <td><?php echo htmlspecialchars($event['title']); ?></td>
                <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                <td><?php echo htmlspecialchars($event['description']); ?></td>
                <td class="actions">
                    <a href="events_crud.php?edit=<?php echo $event['id']; ?>">Edit</a>
                    <a href="events_crud.php?delete=<?php echo $event['id']; ?>" class="delete" onclick="return confirm('Delete this event?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($events)): ?>
            <tr><td colspan="5" style="text-align:center; color:#888;">No events found.</td></tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>