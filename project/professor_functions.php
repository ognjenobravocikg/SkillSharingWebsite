<?php

function fetch_professor_student($con, $professor_id) {
    $requests = array();
    
    $query = "SELECT professor_student.request_id, users.user_id, users.name AS student_name
              FROM professor_student
              JOIN users ON professor_student.student_id = users.user_id
              WHERE professor_student.professor_id = ? AND professor_student.request_id = 1";
    
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("i", $professor_id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $requests[] = $row;
            }
        } else {
            // Handle execution error
            error_log("Error executing query: " . $stmt->error);
        }
        $stmt->close();
    } else {
        // Handle preparation error
        error_log("Error preparing query: " . $con->error);
    }
    
    return $requests;
}


// Function to fetch followers for a professor
function fetch_professor_followers($con, $professor_id) {
    $followers = array();
    
    $query = "SELECT users.user_id, users.name AS student_name
              FROM professor_student
              JOIN users ON professor_student.student_id = users.user_id
              WHERE professor_student.professor_id = ? AND professor_student.request_id = 2";
    
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("i", $professor_id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $followers[] = $row;
            }
        } else {
            // Handle execution error
            error_log("Error executing query: " . $stmt->error);
        }
        $stmt->close();
    } else {
        // Handle preparation error
        error_log("Error preparing query: " . $con->error);
    }
    
    return $followers;
}

?>



