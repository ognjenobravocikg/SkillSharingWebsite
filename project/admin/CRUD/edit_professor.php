<?php
// Include database connection file
include "../../user_register/connection.php";

// Check if professor_id is provided
if (isset($_GET['id'])) {
    $professor_id = $_GET['id'];
    
    // Fetch professor details
    $query = "SELECT * FROM professors WHERE professor_id = '$professor_id'";
    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $lastName = $row['lastName'];
        $email = $row['email'];
        $password = $row['password'];
        $freeTime = $row['freeTime'];
        // Add more fields as needed
    } else {
        echo "Professor not found.";
        exit;
    }
} else {
    echo "Professor ID not provided.";
    exit;
}

// Update professor details
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $new_name = $_POST['name'];
    $new_lastName = $_POST['lastName'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];
    $new_freeTime = $_POST['freeTime'];
    // Add more fields as needed

    $update_query = "UPDATE professors SET name = '$new_name', lastName = '$new_lastName', email = '$new_email', password = '$new_password', freeTime = '$new_freeTime' WHERE professor_id = '$professor_id'";
    
    if (mysqli_query($con, $update_query)) {
        header("Location: ../crud_professor_table.php"); // Redirect to professor table after updating
        exit;
    } else {
        echo "Error updating professor: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Professor</title>
</head>
<body>
    <h2>Edit Professor</h2>
    <form method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>
        <label for="lastName">Last Name:</label><br>
        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
        <label for="password">Password:</label><br>
        <input type="text" id="password" name="password" value="<?php echo $password; ?>"><br>
        <label for="freeTime">Free time:</label><br>
        <input type="time" id="freeTime" name="freeTime" value="<?php echo $freeTime; ?>"><br>
        <!-- Add more fields as needed -->
        <br>
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
