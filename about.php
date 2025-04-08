<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
       
        </style>

</head>
<body>
    <div class="icons">
       <h2 class="heading">TEAM</h2> 
       <div class="icon-div">
    <i class="fa-solid fa-arrow-left" id="left"></i>
    <i class="fa-solid fa-arrow-right" id="right"></i>
    </div>
</div>
<div id="container">
    <div class="left" style="background-image:url('images/doc.jpg');">
        
    </div>
    <div class="right">
    <h1>About Us</h1>
    <strong>Our doctors have years of experience!</strong>
    <div class="paragraph">
    <p>
      Welcome to [Doctor's Name] Clinic! We are committed to providing exceptional healthcare services 
      with a personalized touch. Our team of experienced medical professionals ensures that you and 
      your family receive the best care possible. Trust us for a healthier tomorrow!
    </p>
    <button onclick="location.href='contact.php'">Contact Us</button>

    </div>
 
     
    </div>
</div>

<!-- Assurity Section Start -->
<div class="assurity-section">
  <h2>Our Assured Dental Instruments</h2>
  <p>We only use top-quality dental instruments to ensure the highest level of care and precision for our patients.</p>
  
  <div class="instrument-cards">
    <div class="card">
      <img src="images/teeth3.jpg" alt="Dental Tool 1">
      <h3>Precision Tools</h3>
      <p>Our precision tools ensure accurate procedures for every treatment.</p>
    </div>
    
    <div class="card">
      <img src="images/teeth.jpg" alt="Dental Tool 2">
      <h3>Hygienic Equipment</h3>
      <p>All our instruments are sterilized and ready for safe use in every session.</p>
    </div>
    
    <div class="card">
      <img src="images/teeth2.jpg" alt="Dental Tool 3">
      <h3>Durability Assured</h3>
      <p>Our tools are built to last, offering long-term reliability for various treatments.</p>
    </div>
  </div>
  
  <button class="assurity-btn">Learn More About Our Patients</button>
</div>
<!-- Assurity Section End -->
 <?php include('footer.php');?>

    
</body>
</html>