<?php

// Include the database connection file
include('db.php');
session_start();

if(!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true){
    echo  "<script> alert('Please login first');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}

$sql = $db->prepare("SELECT * FROM dentists");
$sql->execute();
$result = $sql->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

<div class="login-form">
    <h2 class="bh1">Book an Appointment with a Dentist</h2>
    <div>
        <form>
            <label>Patient Name</label>
            <input type="text" id="pname" >

            <label>Patient Email</label>
            <input type="email" id="pemail" >

            <label>Patient Phone</label>
            <input type="text" id="pphone">

            <label>Doctor</label>
            <select id="doctor" >
                <?php
                if ($result->num_rows > 0) {
                    while ($dentist = $result->fetch_assoc()) { ?>
                        <option value="<?php echo $dentist['id']; ?>">
                            <?php echo $dentist['name']; ?> - <?php echo $dentist['specialization']; ?>
                        </option>
                    <?php }
                }
                ?>
            </select>

            <label>Select date</label>
            <input type="date" id="date" >

            <button type="submit" id="save-data">Submit</button>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $("#save-data").on("click",function(e){
            e.preventDefault();
            var name= $("#pname").val();
            var email= $("#pemail").val();
            var phone= $("#pphone").val();
            var doctor= $("#doctor").val();
            var date= $("#date").val();

            $.ajax({

                url: 'book_query.php',
                type: 'POST',
                data:{pname:name,pemail:email,pphone:phone,doctor:doctor,date:date},
                success:function(result){
                    alert ('your appointment is successfully booked');
                    window.location.href = 'appointment_success.php';
                } 


            });      
        });
    });
    </script>
</body>
</html>
