<?php

function search_professors($con, $search_query) {
    // Sanitize search query
    $search_query = mysqli_real_escape_string($con, $search_query);

    // Perform search query
    $query = "SELECT * FROM professors WHERE skill LIKE '%$search_query%' OR lastName LIKE '%$search_query%'";
    $result = mysqli_query($con, $query);

    $professors = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $professors[] = $row;
        }
    }

    return $professors;
}

?>
