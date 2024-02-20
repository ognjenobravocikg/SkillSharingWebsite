<?php
// Include database connection file
include "../../user_register/connection.php";

// Check if user_id is provided
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    // Fetch user details
    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $lastName= $row['lastName'];
        $email= $row['email'];
        $password= $row['password'];
        $skill= $row['skill'];
        $interests= $row['interests'];
        $education= $row['education'];
        // Add more fields as needed
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "User ID not provided.";
    exit;
}

// Update user details
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $new_name = $_POST['name'];
    $new_lastName=$_POST['lastName'];
    $new_email = $_POST['email'];
    $new_password=$_POST['password'];
    $new_skill=$_POST['skill'];
    $new_interests=$_POST['interests'];
    $new_education=$_POST['education'];
    // Add more fields as needed

    $update_query = "UPDATE users SET name = '$new_name', lastName='$new_lastName', email = '$new_email', password='$new_password', skill='$new_skill', interests='$new_interests', education='$new_education' WHERE user_id = '$user_id'";
    
    if (mysqli_query($con, $update_query)) {
        header("Location: ../crud_user_table.php"); // Redirect to user table after updating
        exit;
    } else {
        echo "Error updating user: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>
        <label for="lastName">Last Name:</label><br>
        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
        <label for="password">Password:</label><br>
        <input type="text" id="password" name="password" value="<?php echo $password; ?>"><br>
        <label for="skill">Skill:</label><br>
        <input type="text" id="skill" name="skill" value="<?php echo $skill; ?>"><br>
        <label for="interests">Interests:</label><br>
        <input type="text" id="interests" name="interests" value="<?php echo $interests; ?>"><br>
        <label for="education">Education:</label><br>
        <input type="text" id="education" name="education" value="<?php echo $education; ?>"><br>
        <!-- Add more fields as needed -->
        <br>
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>

