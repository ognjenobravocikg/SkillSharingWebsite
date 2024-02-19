<?php 
session_start();
include("../professor_register/connection.php");
include("../professor_register/functions.php");

$professor_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $new_name = $_POST['new_name'];
    $new_email = $_POST['new_email'];
    $new_password1 = $_POST['new_password1'];
    $new_password2 = $_POST['new_password2'];

    // Check if new passwords match
    if ($new_password1 === $new_password2) {
        // Update professor information in the database
        $hashed_password = password_hash($new_password1, PASSWORD_DEFAULT);
        $query = "UPDATE professors SET name = '$new_name', email = '$new_email', password = '$hashed_password' WHERE professor_id = {$professor_data['professor_id']}";
        mysqli_query($con, $query);

        // Redirect to the settings page after updating information
        header("Location: settings.php");
        exit;
    } else {
        echo "Passwords do not match!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Podešavanja</title>
</head>
<body>

    <a href="logout.php">Odjavi se</a>
    <h1>Podešavanja</h1>

    <form method="post">
        <label for="new_name">Novo ime:</label>
        <input type="text" name="new_name" value="<?php echo $professor_data['name']; ?>" required><br><br>
        
        <label for="new_password1">Nova šifra:</label>
        <input type="password" name="new_password1" required><br><br>

        <label for="new_password2">Potvrdi šifra:</label>
        <input type="password" name="new_password2" required><br><br>

        <button type="submit">Sačuvaj promene</button>
    </form>

</body>
</html>
