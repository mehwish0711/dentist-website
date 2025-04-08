<?php
// Include database configuration file
include('../config/db.php');
include('../db.php');
session_start();
if(!isset($_SESSION['user_logged_in']) || $_SESSION['usersrole'] !== 'admin'){
    header('Location: ../login.php');
    echo "login first";
    exit;
}





try {
    // Preparing the query with JOIN, including appointments.id
    $showrecords = $pdo->prepare("
        SELECT 
            appointments.id,  -- Adding the id column
            appointments.patient_name, 
            appointments.patient_email, 
            appointments.patient_phone, 
            appointments.appointment_date, 
            appointments.status, 
            dentists.name AS doctor_name 
        FROM appointments INNER JOIN dentists 
        ON appointments.dentist_id = dentists.id
    ");
    $showrecords->execute();

    // Fetching records
    $records = $showrecords->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
          *{
           box-sizing:border-box;
           padding:0;
           margin:0;
        }

        html,body{
            width: 100%;
            height: 100%; 
         
        }
        h1, h2, h3, p {
    font-family: Arial, sans-serif;
    margin-bottom: 15px; 
}
#container{
    width:100%;
    height:auto;
  
    display:flex;
    justify-content:center;
   
}
.left-box{
    width:25%;
    height:auto;
    background-color:black;
}
.left-box h2{
 padding:10px;

 text-align:center;
 font-family:;
 color:#f2f2f2;

}
.left-box-ul{
 padding:0px;
 margin:0; 
}
.left-box-ul li{
list-style-type:none;

}
.left-box-ul li a{
color:#f2f2f2;
text-decoration:none;
display:block;
padding:10px;
font-size:22px;
}
.left-box-ul li:hover{
    background-color:#f9f9f9;
    
}
.left-box-ul li a:hover{
  color:black;
    
}


.right-box{
    width:75%;
    height:auto;
    background-color:;
}

        table {
            border-collapse: collapse;
            width: 900px;
            margin-top: 20px;
            margin:0 ;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }
        .btn-edit {
            background-color: #4CAF50;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .app-btn {
            padding: 15px 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }
        .modalbox{
            width:100%;
            height:100vh;
            background-color:rgba(0,0,0,0.7);
            top:0;
            left:0;
            position:fixed;
            display:none;
        }
        .modalbox #form{
            width:800px;
            height:auto;
            position:absolute;
            background-color:#f7f7f7;
            top:0;
            left:25%;
        }
       
       

.closebtn {
    font-size: 30px;
    color: #333;
    position: absolute;
    top: 10px;
    right: 20px;
    cursor: pointer;
   
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    font-size: 14px;
    color: #555;
}

input, select {
    width: 100%;
    padding: 10px;
    margin: 8px 0 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#save-data {
    width: 100%;
    padding: 10px;
    background: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

#save-data:hover {
    background: #45a049;
}



    </style>
</head>

<body>
    <h1 style="text-align:center;margin-top:15px;">Manage Appointment Section</h1>
<div id="container" >
    <div class="left-box">
<h2>Admin Panel</h2>
<ul class= "left-box-ul">
    <li><a href="admin_dashboard">Show Records</a></li>
    <li><a href="add_doctors">Add Doctors</a></li>
    <li><a href="add_services">Add Services</a></li>
    <li><a href="add_users">Add Users</a></li>
    </ul>
    </div><!--end left box-->
    <div class="right-box">
       
    <table id="table">
        <thead>
            <tr>
            <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PHONE NO</th>
                <th>DOCTOR NAME</th>
                <th>APPOINTMENT DATE</th>
                <th>STATUS</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>
            <?php    
            // Check if records exist
            if (!empty($records)) {
                foreach ($records as $record) {
                    echo "<tr>
                        <td>" . htmlspecialchars($record['id']) . "</td>
                        <td>" . htmlspecialchars($record['patient_name']) . "</td>
                        <td>" . htmlspecialchars($record['patient_email']) . "</td>
                        <td>" . htmlspecialchars($record['patient_phone']) . "</td>
                        <td>" . htmlspecialchars($record['doctor_name']) . "</td>
                        <td>" . htmlspecialchars($record['appointment_date']) . "</td>
                        <td>" . htmlspecialchars($record['status']) . "</td>
                        <td><button data-eid= ".$record['id']." class='btn btn-edit' >Edit</button></td>
                        <td><a href='# data-did=".($record['id']) . "' class='btn btn-delete'>Delete</a></td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found</td></tr>";
            }
            
            ?>
        </tbody>
    </table>
        </div><!---end right box--->
        </div><!---end container section--->
      <div class="app-btn">  <button>Add Appointment</button></div>
        <!----MODALOVERLAY--->

        <div id="modalOverlay" class="modalbox">
            <div id="form">
                <span class="closebtn close">&times;</span>
                <h2>Update form</h2>
                <table width="100%" cellpadding="10px" cellspacing="0px">
                
                
             </table>
        </div>

      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
   $(document).ready(function () {
    $(document).on("click", ".btn",function (e) {
        e.preventDefault();
        $("#modalOverlay").fadeIn();
        var id = $(this).data("eid"); // Fetch the ID from the button"s data attribute

       $.ajax({
             url:"get_update_data.php",
             type:"POST",
             data:{id:id},
             success:function(data){
            $("#form table").html(data);
             }

       });
    });
    $(".close").on("click", function () {
        $("#modalOverlay").fadeOut();
    });
});
</script>