<?php
include('db.php');

$name=$_POST['pname'];
$email=$_POST['pemail'];
$password=$_POST['ppass'];
$role=$_POST['prole'];

$hashed_password= password_hash($password ,PASSWORD_BCRYPT);
$sql=$db->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,?) ");
$sql->bind_param("ssss", $name, $email, $hashed_password,$role);
if ($sql->execute()) {
 $data = 1;
 
  
} else {
    $data = 0;    
}

// Close the statement and connection
$sql->close();
$db->close();

?>
