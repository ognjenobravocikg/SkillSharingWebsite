<?php 
session_start();
include("../user_register/connection.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $name = $_POST['name'];
    $password = $_POST['password'];

    if(!empty($name) && !empty($password)) {
        // Prepare a SQL statement
        $query = "SELECT * FROM admins WHERE username = ?";
        $stmt = mysqli_prepare($con, $query);

        if($stmt === false) {
            die("Error in preparing statement: " . mysqli_error($con));
        }

        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            
            // Verify the password
            if($user_data['password'] === $password) {
                $_SESSION['admin_id'] = $user_data['admin_id'];
                header("Location: admin_index.php");
                exit; // Ensure script stops executing after redirect
            }
        }
    }
    
    echo "Wrong username or password!";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
</head>

<body>
    <div class="wrapper">
        <h1>Prijava</h1>
        <form method="post">
            <div class="input-box">
                <input type="text" name="name" placeholder="Admin ime" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Šifra" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" name="remember"> Zapamti me</label>
            </div>
            <input class="btn" type="submit" value="Prijavi se"><br>
        </form>
    </div>
</body>
</html>
