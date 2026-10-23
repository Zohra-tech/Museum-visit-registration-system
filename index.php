<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museum Visit Registration</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">
    <h1>Museum Visit Registration</h1>
    <p>Register below to plan your museum visit.</p>

    <form action="register.php" method="POST">
        <label for="visitor_name">Visitor Name</label>
        <input
            type="text"
            id="visitor_name"
            name="visitor_name"
            maxlength="100"
            required
        >

        <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            maxlength="150"
            required
        >

        <label for="number_of_visitors">Number of Visitors</label>
        <input
            type="number"
            id="number_of_visitors"
            name="number_of_visitors"
            min="1"
            max="100"
            required
        >

        <label for="visit_date">Visit Date</label>
        <input
            type="date"
            id="visit_date"
            name="visit_date"
            min="<?php echo date('Y-m-d'); ?>"
            required
        >

        <label for="visit_time">Visit Time</label>
        <input
            type="time"
            id="visit_time"
            name="visit_time"
            required
        >

        <button type="submit">Register Visit</button>
    </form>

    <a class="view-link" href="view.php">
        View All Registrations
    </a>
</div>

</body>
</html>
