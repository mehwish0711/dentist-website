<?php
include('db.php'); // Database connection include
session_start();
// User input ko fetch karte hain
$pname = $_POST['pname'];
$pemail = $_POST['pemail'];
$pphone = $_POST['pphone'];
$doctor = $_POST['doctor'];
$date = $_POST['date'];
$user_id=$_SESSION['user_id']; 



// Query ko prepare karte hain
$sql = "INSERT INTO appointments (patient_name, patient_email, patient_phone, dentist_id, appointment_date,user_id) 
        VALUES (?, ?, ?, ?, ?,?)";

if ($stmt = mysqli_prepare($db, $sql)) {
    // Parameters bind karte hain
    mysqli_stmt_bind_param($stmt, "sssisi", $pname, $pemail, $pphone, $doctor, $date,$user_id);

    // Query execute karte hain
    if (mysqli_stmt_execute($stmt)) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // Statement close karte hain
    mysqli_stmt_close($stmt);
} else {
    echo "Error: Unable to prepare statement.";
}

// Database connection close karte hain
mysqli_close($db);
?>
