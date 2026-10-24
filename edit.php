<?php
require_once __DIR__ . '/config/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit('Invalid registration ID.');
}

$stmt = $pdo->prepare("SELECT * FROM registrations WHERE id = ?");
$stmt->execute([$id]);
$record = $stmt->fetch();

if (!$record) {
    http_response_code(404);
    exit('Registration not found.');
}

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Registration</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <h1>Edit Registration</h1>

    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?= (int)$record['id'] ?>">

        <label for="visitor_name">Visitor Name</label>
        <input id="visitor_name" name="visitor_name" maxlength="100"
               value="<?= e($record['visitor_name']) ?>" required>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" maxlength="150"
               value="<?= e($record['email']) ?>" required>

        <label for="number_of_visitors">Number of Visitors</label>
        <input type="number" id="number_of_visitors"
               name="number_of_visitors" min="1" max="100"
               value="<?= (int)$record['number_of_visitors'] ?>" required>

        <label for="visit_date">Visit Date</label>
        <input type="date" id="visit_date" name="visit_date"
               min="<?= date('Y-m-d') ?>"
               value="<?= e($record['visit_date']) ?>" required>

        
<label for="visit_time">Visit Time</label>
<input
    type="time"
    id="visit_time"
    name="visit_time"
    min="09:00"
    max="17:00"
    value="<?= e(substr($record['visit_time'], 0, 5)) ?>"
    required
>

<small id="office-hours-message"
       style="display: none; color: red; margin-top: 5px;">
    Office hours are from 9:00 AM to 5:00 PM.
</small>

<script>
    const visitTime = document.getElementById("visit_time");
    const officeMessage = document.getElementById("office-hours-message");

    function validateOfficeHours() {
        const time = visitTime.value;

        if (time && (time < "09:00" || time > "17:00")) {
            officeMessage.style.display = "block";
            visitTime.style.border = "2px solid red";
            visitTime.setCustomValidity(
                "Office hours are from 9:00 AM to 5:00 PM."
            );
        } else {
            officeMessage.style.display = "none";
            visitTime.style.border = "";
            visitTime.setCustomValidity("");
        }
    }

    visitTime.addEventListener("input", validateOfficeHours);
    visitTime.addEventListener("change", validateOfficeHours);
</script>

        <button type="submit">Update Registration</button>
    </form>
</div>
</body>
</html>
