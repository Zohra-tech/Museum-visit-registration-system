<?php
require_once __DIR__ . '/config/database.php';

$stmt = $pdo->query(
    "SELECT * FROM registrations ORDER BY created_at DESC"
);
$registrations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Registrations</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <h1>Visitor Registrations</h1>

    <?php if (isset($_GET['success'])): ?>
        <p class="success">Registration saved successfully!</p>
    <?php endif; ?>

    <p>
        <a href="index.php">Register Another Visit</a>
    </p>

    <?php if (!$registrations): ?>
        <p>No registrations found.</p>
    <?php else: ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Visitor</th>
                        <th>Email</th>
                        <th>Visitors</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($registrations as $row): ?>
                    <tr>
                        <td><?= (int)$row['id'] ?></td>
                        <td><?= htmlspecialchars($row['visitor_name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= (int)$row['number_of_visitors'] ?></td>
                        <td><?= htmlspecialchars($row['visit_date']) ?></td>
                        <td><?= htmlspecialchars(substr($row['visit_time'], 0, 5)) ?></td>
                        <td>
                            <a href="edit.php?id=<?= (int)$row['id'] ?>">Edit</a>
                            |
                            <form action="delete.php" method="POST"
                                  onsubmit="return confirm('Delete this registration?');"
                                  style="display:inline">
                                <input type="hidden" name="id"
                                       value="<?= (int)$row['id'] ?>">
                                <button type="submit"
                                        style="width:auto;margin:0;padding:5px">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
