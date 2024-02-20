<?php
// Include database connection file
include "../user_register/connection.php";

// Function to fetch professors
function fetchProfessors($con, $searchTerm = "") {
    $output = '';
    
    // Construct base query
    $query = "SELECT * FROM professors";
    
    // Add WHERE clause if search term is provided
    if (!empty($searchTerm)) {
        $query .= " WHERE name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";
    }
    
    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $output .= "<table border='1'>";
        $output .= "<tr><th>Professor id</th><th>Password</th><th>Name</th><th>Last Name</th><th>Email</th><th>Interests</th><th>Available on</th><th>Registration date</th></tr>";        
        
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<tr>";
            $output .= "<td>" . $row['professor_id'] . "</td>";
            $output .= "<td>" . $row['password'] . "</td>";
            $output .= "<td>" . $row['name'] . "</td>";
            $output .= "<td>" . $row['lastName'] . "</td>";
            $output .= "<td>" . $row['email'] . "</td>";
            $output .= "<td>" . $row['skill'] . "</td>";
            $output .= "<td>" . $row['freeTime'] . "</td>";
            $output .= "<td>" . $row['registration_date'] . "</td>";
            $output .= "<td>";
            $output .= "<a href='CRUD/edit_professor.php?id=" . $row['professor_id'] . "'>Edit</a> | ";
            $output .= "<a href='CRUD/delete_professor.php?id=" . $row['professor_id'] . "'>Delete</a>";
            $output .= "</td>";
            $output .= "</tr>";
        }
        
        $output .= "</table>";
    } else {
        $output .= "No professors found.";
    }
    
    return $output;
}

// Display professors
echo "<h2>Professor Table</h2>";

// Check if search term is provided
$searchTerm = isset($_GET['search']) ? $_GET['search'] : "";

if (!empty($searchTerm)) {
    // Fetch and display detailed information of the searched professor
    $query = "SELECT * FROM professors WHERE name LIKE '%$searchTerm%'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<h3>Search Result</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Professor id</th><th>Password</th><th>Name</th><th>Last Name</th><th>Email</th><th>Interests</th><th>Available on</th><th>Registration date</th></tr>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['professor_id'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['lastName'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['skill'] . "</td>";
            echo "<td>" . $row['freeTime'] . "</td>";
            echo "<td>" . $row['registration_date'] . "</td>";
            echo "<td>";
            echo "<a href='CRUD/edit_professor.php?id=" . $row['professor_id'] . "'>Edit</a> | ";
            echo "<a href='CRUD/delete_professor.php?id=" . $row['professor_id'] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Professor not found.";
    }
} else {
    // Display table of professors
    echo "<form method='GET'>";
    echo "<input type='text' name='search' value='$searchTerm' placeholder='Search by name or email'>";
    echo "<input type='submit' value='Search'>";
    echo "</form>";
    echo fetchProfessors($con, $searchTerm);
}
?>
