<?php
include("config/db.php");
session_start();


$page = basename($_SERVER['PHP_SELF']); 



// Set banner image based on the current page
if ($page === 'home.php') {
    $bannerImage = "images/banner2.jpg";
    $head="Welcome to Our Dental Clinic"; // Home page banner
} elseif ($page === 'appointment_success.php') {
    $bannerImage = "images/dentalimg.jpeg";
    $head="Your Appointment"; // Appointment success page banner
} elseif ($page === 'about.php') {
    $bannerImage = "images/about.avif"; // About page banner
    $head="Welcome to About Us";
} else {
    $bannerImage = "images/default-banner.jpg"; // Default banner
}

// Fetch dentists from the database to display in the booking form
$query = $pdo->query("SELECT * FROM dentists");
$dentists = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="css/style.css">
    <link rel ="stylesheet" href="css/homestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>home_page</title>
    <style>
        /*modal box setting*/  
        .modalOverlay {
            background-color: rgba(0, 0, 0, 0.7);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 1000;
        }

        .modalBox {
            background-color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); 
            width: 450px;
        }

        .cbtn {
            color: white;
            width: 35px;
            font-size: 22px;
            text-align: center;
            cursor: pointer;
        }

        span {
            background-color: #008CBA;
            width: 40px;
            position: absolute;
            right: 0;
            top: 0;
        }

        .cta-button {
            padding: 15px 30px;
            background-color: #008CBA;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        #cta-button {
            padding: 15px 30px;
            background-color: #008CBA;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        #cta-button:hover {
            background-color: #005f72;
        }
    </style>
</head>
<body>
<div class="social-links" style="justify-content: space-around; display: flex; align-items: center;">
    <ul>
        <li><a href="https://facebook.com" target="_blank">Facebook</a></li>
        <li><a href="https://twitter.com" target="_blank">Twitter</a></li>
        <li><a href="https://instagram.com" target="_blank">Instagram</a></li>
    </ul>
    <div><a href="tel:+923002195473" style="color: #008CBA;">Phone: +92300-2195473</a></div>
</div>

<nav>
    <div><h1>Bright Smile Dental</h1></div>
    <ul class="primary-ul">
        <li><a href="home.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        
    </ul>
    
    
    <div class="abtn">
    <a href="" id="modalbtn">Register</a>

    <?php 
if (!isset($_SESSION['username'])) {
    echo '<a href="login.php">Login</a>';
} else {
    echo '<a href="logout.php">Logout</a>';
}
?>

   
    </div>
</nav>

<div class="hero-section" style="background-image: url('<?php echo $bannerImage ?>');">>
    <div class="hero-content">
        <h1><?php echo $head ?></h1>
        <p>Your health is our priority. Book an appointment now!</p>
        <a href="book_appointment.php" class="bookBtn" id="cta-button">Book Appointment</a>
    </div>
</div>

<div class="modalOverlay" style="display: none;">
    <div class="modalBox">
        <span class="close cbtn">&times;</span>
        <h1 class="bh1">REGISTRATION FORM</h1>
        <div id="form">
            <form id="appointmentForm">
                <label>Patient Name</label>
                <input type="text" id="pname">

                <label>Patient Email</label>
                <input type="email" id="pemail">

                <label>Password</label>
                <input type="PASSWORD" id="ppass">

                <label>Password</label>
                <input type="PASSWORD" id="cpass">

                
                <label>enter role</label>
                <input type="text" id="role">               

                

                <input type="submit" value="REGISTRATION" id="save-button" class="cta-button">
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        // Open modal
        $('#modalbtn').on('click', function (e) {
            e.preventDefault();
            $('.modalOverlay').fadeIn();
        });

        // Close modal
        $('.close').on('click', function () {
            $('.modalOverlay').fadeOut();
        });

        // AJAX Form Submission
        $('#save-button').on('click', function (e) {
            e.preventDefault();

            var p_name = $("#pname").val();
            var p_email = $("#pemail").val();
            var p_pass = $("#ppass").val();
            var p_role = $("#role").val();
             // Validate inputs
    if (p_name === "") {
        alert("Name is required.");
        return;
    }
    if (p_email === "" || !/^\S+@\S+\.\S+$/.test(p_email)) {
        alert("Please enter a valid email address.");
        return;
    }
    if (p_pass === "" || p_pass.length < 8 || !/[A-Z]/.test(p_pass) || !/[0-9]/.test(p_pass)) {
        alert("Password must be at least 8 characters long, include a number and an uppercase letter.");
        return;
    }

            
        

            $.ajax({
                url: 'register_query.php',
                type: 'POST',
                data: {
                    pname: p_name,
                    pemail: p_email,
                    ppass: p_pass,
                    prole: p_role,
                   
                },
                success: function (data) {
               
                    alert('You Are Registered successfully!');
                  //  $('#appointmentForm')[0].reset();  // Reset the form
                  //  $('.modalOverlay').fadeOut();  // Hide the modal (if any)
                    window.location.href = "home.php";  // Redirect to success page
               
            }
               
            });
        });
    });
</script>
</body>
</html>


