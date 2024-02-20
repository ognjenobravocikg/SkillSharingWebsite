<?php 
session_start();

include("user_register/connection.php");
include("user_register/functions.php");
include("user_functions.php");

$user_data = check_login($con);

$skill_search_results = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $category = $_POST['category']; // Assuming category is provided via POST
    $skill_search_results = search_skills($con, $category);
}

// Function to get professor's name and last name by professor_id
function getProfessorNameById($con, $professor_id) {
    $query = "SELECT name, lastName FROM professors WHERE professor_id = '$professor_id'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $professor = mysqli_fetch_assoc($result);
        return $professor['name'] . ' ' . $professor['lastName'];
    } else {
        return "N/A";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Skills</title>
</head>
<body>
    <!-- Search form for skills -->
    <form method="post">
        <label for="category">Kategorija:</label>
        <input type="text" name="category" id="category" placeholder="Uneti kategoriju">
        <button type="submit">Pretraži vestinu</button>
    </form>

    <!-- Display search results -->
    <?php if (!empty($skill_search_results)): ?>
        <h2>Rezultati pretrage:</h2>
        <ul>
            <?php foreach ($skill_search_results as $skill): ?>
                <li>
                    <strong>Title:</strong> <?php echo $skill['title']; ?><br>
                    <strong>Description:</strong> <?php echo $skill['description']; ?><br>
                    <strong>Professor:</strong> <?php echo getProfessorNameById($con, $skill['professor_id']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <a href="user_index.php">Vrati se</a>
</body>
</html>
