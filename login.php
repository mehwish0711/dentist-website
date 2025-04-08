<?php
// Start session
session_start();
include('db.php'); // Database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // SQL Query to fetch user
    $stmt = $db->prepare("SELECT id, email, password , role FROM users WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
 
    if ($result->num_rows > 0) {
        $row=$result->fetch_assoc();
        if(password_verify($password, $row['password'])) {
            // Login successful
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id'] =$row['id']; // Fetch user_id from the result
            $_SESSION['username'] =$row['email']; 
            $_SESSION['usersrole']=$row['role']; 
            // Store the email in session
            
            // Redirect to appointment page
            if ($_SESSION['usersrole'] == 'admin') {
                // Redirect to admin dashboard
                header("Location: admin_panel/admin_dashboard.php");
            } elseif ($_SESSION['usersrole'] == 'user') {
                // Redirect to user dashboard (front-end)
                header("Location: book_appointment.php");
            } else {
                echo "Invalid role!";
            }
            exit; // Make sure script stops after redirection
        } else {
            echo "<script>alert('Invalid email or password.');</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }
}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="login-form">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!-- No need to store user_id in hidden input as it's not needed for login -->
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <a href="home.php" style="text-decoration:none;padding:10px;display:block;">I am not Registered</a>
    </form>
</div>
</body>
</html>
