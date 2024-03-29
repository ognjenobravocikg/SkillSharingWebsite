<?php 

include("user_register/connection.php");
include("user_register/functions.php");
include("user_functions.php");

$skill_search_results = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $category = $_POST['category']; // Assuming category is provided via POST
    $skill_search_results = search_skills($con, $category);
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
    <h1>Dobrodosli</h1>
    <h3>Trenutno niste prijavljeni</h3>
    <br><a href="user_register/login.php">Prijavite se</a>
    <br><br>
    
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
                    <strong>Professor ID:</strong> <?php echo $skill['professor_id']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>