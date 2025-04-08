<?php
include('../db.php');

// Check if 'id' is provided

    $id = $_POST['id'];

   $sql="SELECT * FROM appointments WHERE id= '{$id}'";
   $result=mysqli_query($db,$sql);
   $output="";
  if(mysqli_num_rows($result) > 0){

while($rows=mysqli_fetch_assoc($result)){
                $output="<tr>
                    <td>name</td>
                    <td><input type='text'id='edit-name'value='{$rows["patient_name"]}'></td>
                </tr>
                <tr>
                    <td>email</td>
                    <td><input type='email'id='edit-email' value='{$rows["patient_email"]}'></td>
                </tr>
                <tr>
                    <td>phone</td>
                    <td><input type='number'id='edit-phone' value='{$rows["patient_phone"]}'></td>
                </tr>
                    <tr>
                    <td>doctor</td>
                    <td><input type='text'id='edit-doctor' value='{$rows["appointment_doctor"]}'></td>
                </tr>
                 <tr>
                    <td>Appointment Date</td>
                    <td><input type='text'id='edit-date' value='{$rows["appointment_date"]}'></td>
                </tr>
                <tr><td> <button type='submit' id='save-data'>Submit</button></td></tr>";
}
echo $output;

  }
    