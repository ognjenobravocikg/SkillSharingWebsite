<?php 
session_start();

include("user_register/connection.php");
include("user_register/functions.php");
include("user_functions.php");

$user_data = check_login($con);

// Initialize variables
$search_results = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $search_query = $_POST['search_query'];
    // Perform search
    $search_results = search_professors($con, $search_query);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Moj sajt</title>
</head>
<body>

    <a href="user_register/logout.php">Odjavi se</a>
    <h1>Dobrodošli</h1>

    <br>
    Zdravo, <?php echo $user_data['name']; ?> <br> <br>

    <!-- Search form -->
    <form method="post">
        <label for="search_query">Pretraži:</label>
        <input type="text" name="search_query" id="search_query" placeholder="Uneti veštinu">
        <button type="submit">Pretraži</button>
    </form>

    <!-- Display search results -->
    <?php if (!empty($search_results)): ?>
        <h2>Rezultati pretrage:</h2>
        <ul>
            <?php foreach ($search_results as $professor): ?>
                <li>
                    <a href="profile.php?professor_id=<?php echo $professor['professor_id']; ?>">
                        <?php echo $professor['name'] . ' ' . $professor['lastName']; ?>
                    </a>
                    <button onclick="openChatWindow('<?php echo $professor['email']; ?>')">Chat</button>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- JavaScript function to open chat window -->
    <script>
        function openChatWindow(professorEmail) {
            // Redirect to chat window with professor's email as a parameter
            window.open('chat.php?professor_email=' + professorEmail, '_blank', 'width=600,height=400');
        }
    </script>

</body>
</html>
