<?php
// Start the session to access session variables
session_start();

include "../user_register/connection.php";
include "admin_function.php";

// Check if the admin is logged in, if not, redirect to the login page
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php"); // Redirect to login page
    exit;
}

$user_data = check_login($con);

// Set username session variable
$_SESSION['username'] = $user_data['username'];

// Function to fetch users and professors along with registration dates
function getUsersAndProfessors($con) {
    $output = '';
    
    // Fetch users
    $query_users = "SELECT * FROM users";
    $result_users = mysqli_query($con, $query_users);
    
    $output .= "<h2>Users</h2>";
    $output .= "<table border='1'>";
    $output .= "<tr><th>Username</th><th>Email</th><th>Registration Date</th></tr>";
    
    while ($row_users = mysqli_fetch_assoc($result_users)) {
        $output .= "<tr>";
        $output .= "<td>" . $row_users['username'] . "</td>";
        $output .= "<td>" . $row_users['email'] . "</td>";
        $output .= "<td>" . $row_users['registration_date'] . "</td>";
        $output .= "</tr>";
    }
    
    $output .= "</table>";
    
    // Fetch professors
    $query_professors = "SELECT * FROM professors";
    $result_professors = mysqli_query($con, $query_professors);
    
    $output .= "<h2>Professors</h2>";
    $output .= "<table border='1'>";
    $output .= "<tr><th>Name</th><th>Email</th><th>Registration Date</th></tr>";
    
    while ($row_professors = mysqli_fetch_assoc($result_professors)) {
        $output .= "<tr>";
        $output .= "<td>" . $row_professors['name'] . "</td>";
        $output .= "<td>" . $row_professors['email'] . "</td>";
        $output .= "<td>" . $row_professors['registration_date'] . "</td>";
        $output .= "</tr>";
    }
    
    $output .= "</table>";
    
    return $output;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include any CSS stylesheets or meta tags -->
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>This is the admin dashboard. You can manage your tasks here.</p>
    <!-- Add more content as needed -->
    
    <!-- Button to show users and professors -->
    <button onclick="showUsersAndProfessors()">Prikazi nove korisnike</button>
    
    <div id="usersAndProfessorsContainer"></div>
    
    <script>
    function showUsersAndProfessors() {
        // Ajax request to fetch users and professors
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("usersAndProfessorsContainer").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "fetch_users_and_professors.php", true);
        xhttp.send();
    }
    
    function closeTable(tableId) {
        var table = document.getElementById(tableId);
        table.style.display = "none";
    }

    // Move removeUser and removeProfessor outside showUsersAndProfessors function
    function removeUser(userId) {
        if (confirm("Are you sure you want to remove this user?")) {
            // Send AJAX request to remove user
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Reload the page to reflect changes
                    location.reload();
                }
            };
            xhttp.open("POST", "remove_user.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("userId=" + userId);
        }
    }

    function removeProfessor(professorId) {
        if (confirm("Are you sure you want to remove this professor?")) {
            // Send AJAX request to remove professor
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Reload the page to reflect changes
                    location.reload();
                }
            };
            xhttp.open("POST", "remove_professor.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("professorId=" + professorId);
        }
        }
    </script>
    <br><br>
    <a href="crud_user_table.php">CRUD Table of users</a>
    <br>
    <a href="crud_professor_table.php">CRUD Table of professors</a>

    <br><br>
    <a href="admin_logout.php">Logout</a> <!-- Link to logout page -->
</body>
</html>

