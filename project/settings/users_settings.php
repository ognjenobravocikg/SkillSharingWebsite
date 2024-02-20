<?php 
session_start();

include("../user_register/connection.php");
include("../user_register/functions.php");

$users_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $new_password = $_POST['password']; // Password input
    $new_password1 = $_POST['new_password1'];
    $new_password2 = $_POST['new_password2'];

    // Verify if the entered password matches the current password
    if (password_verify($new_password, $users_data['password'])) {
        // Check if new passwords match
        if ($new_password1 === $new_password2) {
            // Update professor information in the database
            $hashed_password = password_hash($new_password1, PASSWORD_DEFAULT);
            $query = "UPDATE users SET name = '$new_name', email = '$new_email', password = '$new_password1' WHERE user_id = {$users_data['user_id']}";
            mysqli_query($con, $query);

            // Redirect to the settings page after updating information
            header("Location: settings.php");
            exit;
        } else {
            echo "Passwords do not match!";
        }
    } else {
        echo "Incorrect password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Podešavanja</title>
    <script>
        function showChangeInput(inputName) {
            var inputs = document.querySelectorAll('input[name^="new_"]');
            inputs.forEach(function(input) {
                if (input.name === inputName) {
                    input.style.display = 'inline-block';
                } else {
                    input.style.display = 'none';
                }
            });
        }
    </script>
</head>
<body>

    <a href="../user_register/logout.php">Odjavi se</a>
    <h1>Podešavanja</h1>

    <form method="post">
        <label for="new_name">Novo ime:</label>
        <input type="text" name="new_name" value="<?php echo $users_data['name']; ?>" required><br><br>

        <label for="password">Trenutna šifra:</label>
        <input type="password" name="password" required><br><br>
        
        <label for="new_password1">Nova šifra:</label>
        <input type="password" name="new_password1" style="display: none;"><br><br>

        <label for="new_password2">Potvrdi šifru:</label>
        <input type="password" name="new_password2" style="display: none;"><br><br>

        <label for="new_interest">Imaš nova interesovanja?</label>
        <input type="text" name="new_interest" style="display: none;"><br><br>

        <button type="button" onclick="showChangeInput('new_name')">Promeni ime</button>
        <button type="button" onclick="showChangeInput('new_password1')">Promeni šifru</button>
        <button type="button" onclick="showChangeInput('new_interest')">Dodaj interesovanje</button>

        <button type="submit">Sačuvaj promene</button><br><br>
        <a href="../user_index.php">Vrati se na pocetnu stranu</a>
    </form>

</body>
</html>
