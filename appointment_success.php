<?php
include("db.php");
session_start();

// Fetch user_id from session
$user_id = $_SESSION['user_id'];
echo "<p class='welcome'>Hello User " . htmlspecialchars($_SESSION['username']) . "</p>";

// Prepare SQL query
$sql = "SELECT * FROM appointments WHERE user_id = '$user_id'"; // Direct query for simplicity
$result = $db->query($sql);

// Check if any row is returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pname = $row['patient_name'];
    $pemail = $row['patient_email'];
    $pphone = $row['patient_phone'];
    $doctor = $row['dentist_id'];
    $date = $row['appointment_date'];
} else {
    echo "<p class='error'>No appointment found for this patient.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <link rel="stylesheet" href="css/style.css">
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.welcome {
    text-align: center;
    margin: 10px 0;
    font-size: 18px;
    color: #4caf50;
}

.confirmation-message {
    text-align: center;
    padding: 20px;
}

.confirmation-message h2 {
    color: #4caf50;
    margin-bottom: 20px;
}

.confirmation-message ul {
    list-style: none;
    padding: 0;
}

.confirmation-message ul li {
    background: #f4f4f4;
    margin: 10px 0;
    padding: 10px;
    border-radius: 5px;
    text-align: left;
    font-size: 16px;
}

.confirmation-message p {
    margin-top: 20px;
    font-size: 16px;
    color: #666;
}

.error {
    text-align: center;
    color: red;
    font-size: 18px;
    margin-top: 50px;
}

    </style>

</head>
<body>
<div class="container">
    <div class="confirmation-message">
        <h2>Your Appointment has been Successfully Booked!</h2>
        <p>Details:</p>
        <ul>
            <li>Patient Name: <?php echo htmlspecialchars($pname); ?></li>
            <li>Email: <?php echo htmlspecialchars($pemail); ?></li>
            <li>Phone: <?php echo htmlspecialchars($pphone); ?></li>
            <li>Doctor: <?php echo htmlspecialchars($doctor); ?></li>
            <li>Appointment Date: <?php echo htmlspecialchars($date); ?></li>
        </ul>
        <p>Thank you for booking an appointment with us!</p>
    </div>
</div>
</body>
</html>
