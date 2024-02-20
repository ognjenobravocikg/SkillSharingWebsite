<?php
session_start();

include("professor_register/connection.php");
include("professor_register/functions.php");
include("professor_functions.php");

$user_data = check_login($con);

// Fetch connection requests for the current professor
$professor_id = $user_data['professor_id'];

// Check if the form for updating time frame is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_time_frame'])) {
    $skill_id = $_POST['skill_id'];
    $new_time_frame = $_POST['time_frame'];

    // Update the time frame in the database
    $update_query = "UPDATE skills SET time_frame = '$new_time_frame' WHERE skill_id = '$skill_id'";
    $update_result = mysqli_query($con, $update_query);

    if ($update_result) {
        echo "Vreme promenjeno uspesno!";
    } else {
        echo "Error updating time frame: " . mysqli_error($con);
    }
}

// Fetch skills associated with the current professor
$query = "SELECT skill_id, title, description,category, image, time_frame FROM skills WHERE professor_id = '$professor_id'";
$result = mysqli_query($con, $query);

// Check if query executed successfully
if ($result) {
    // Fetch and display skills data
    echo "<h2>Your Skills:</h2>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>" . $row['category'] . "</p>";
        echo "<p>Time Frame: " . $row['time_frame'] . "</p>";
        echo "<img src='uploads/" . $row['image'] . "' alt='Skill Image' width='100' height='100'>"; // Adjust width and height as needed

        // Form to update time frame
        echo "<form method='POST'>";
        echo "<input type='hidden' name='skill_id' value='" . $row['skill_id'] . "'>";
        echo "<label for='new_time_frame'>New Time Frame:</label>";
        echo "<input type='text' name='time_frame' id='new_time_frame'>";
        echo "<button type='submit' name='update_time_frame'>Update Time Frame</button>";
        echo "</form>";

        echo "</div>";
    }
} else {
    echo "Error fetching skills: " . mysqli_error($skills_con);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My website</title>
</head>
<body>

    <a href="professor_index.php">Vrati se</a>
    
</body>
</html>

