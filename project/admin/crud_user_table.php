<?php
// Include database connection file
include "../user_register/connection.php";

// Function to fetch users
function fetchUsers($con, $searchTerm = "") {
    $output = '';
    
    // Construct base query
    $query = "SELECT * FROM users";
    
    // Add WHERE clause if search term is provided
    if (!empty($searchTerm)) {
        $query .= " WHERE name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";
    }
    
    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $output .= "<table border='1'>";
        $output .= "<tr><th>User_id</th><th>Password</th><th>Name</th><th>Last Name</th><th>Email</th><th>Interests</th><th>Skills</th><th>Education</th></tr>";


        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr>";
            $output .= "<td>" . $row['user_id'] . "</td>";
            $output .= "<td>" . $row['password'] . "</td>";
            $output .= "<td>" . $row['name'] . "</td>";
            $output .= "<td>" . $row['lastName'] . "</td>";
            $output .= "<td>" . $row['email'] . "</td>";
            $output .= "<td>" . $row['skill'] . "</td>";
            $output .= "<td>" . $row['interests'] . "</td>";
            $output .= "<td>" . $row['education'] . "</td>";
            $output .= "<td>";
            $output .= "<a href='CRUD/edit_user.php?id=" . $row['user_id'] . "'>Edit</a> | ";
            $output .= "<a href='CRUD/delete_user.php?id=" . $row['user_id'] . "'>Delete</a>";
            $output .= "</td>";
            $output .= "</tr>";
        }
        
        $output .= "</table>";
    } else {
        $output .= "No users found.";
    }
    
    return $output;
}

// Display users
echo "<h2>User Table</h2>";

// Check if search term is provided
$searchTerm = isset($_GET['search']) ? $_GET['search'] : "";

if (!empty($searchTerm)) {
    // Fetch and display detailed information of the searched user
    $query = "SELECT * FROM users WHERE name LIKE '%$searchTerm%'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<h3>Search Result</h3>";
        echo "<table border='1'>";
        echo "<tr><th>User_id</th><th>Password</th><th>Name</th><th>Last Name</th><th>Email</th><th>Interests</th><th>Skills</th><th>Education</th></tr>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['lastName'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['skill'] . "</td>";
            echo "<td>" . $row['interests'] . "</td>";
            echo "<td>" . $row['education'] . "</td>";
            echo "<td>";
            echo "<a href='CRUD/edit_user.php?id=" . $row['user_id'] . "'>Edit</a> | ";
            echo "<a href='CRUD/delete_user.php?id=" . $row['user_id'] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "User not found.";
    }
} else {
    // Display table of users
    echo "<form method='GET'>";
    echo "<input type='text' name='search' value='$searchTerm' placeholder='Search by name or email'>";
    echo "<input type='submit' value='Search'>";
    echo "</form>";
    echo fetchUsers($con, $searchTerm);
}
?>
