<?php
session_start();

include("professor_register/connection.php");
include("professor_register/functions.php");
include("professor_functions.php");

$user_data = check_login($con);

// Fetch connection requests for the current professor
$professor_id = $user_data['professor_id'];
$connection_requests = fetch_professor_student($con, $professor_id);
$followers = fetch_professor_followers($con, $professor_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My website</title>
</head>
<body>

    <a href="professor_register/logout.php">Odjavi se</a>
    <h1>Dobrodošli</h1>

    <br>
    Zdravo, <?php echo $user_data['name']; ?>
    <br>
    <br>
    <a href="settings/professors_settings.php">Podešavanja</a>

    <!-- Display connection requests -->
    <?php if (!empty($connection_requests)): ?>
        <h2>Connection Requests:</h2>
        <ul>
            <?php foreach ($connection_requests as $request): ?>
                <li>
                    Student: <?php echo $request['student_name']; ?>
                    <input type="hidden" class="student-id" value="<?php echo $request['user_id']; ?>"> <!-- Add hidden input for student_id -->
                    <button class="accept-req-btn">Accept</button>
                    <button class="deny-req-btn">Deny</button>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No connection requests at the moment.</p>
    <?php endif; ?>
    <!-- Display followers -->
    <?php if (!empty($followers)): ?>
        <h2>Followers:</h2>
        <ul>
            <?php foreach ($followers as $follower): ?>
                <li>
                    Follower: <?php echo $follower['student_name']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No followers at the moment.</p>
    <?php endif; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.accept-req-btn').click(function(){
                var studentId = $(this).siblings('.student-id').val(); // Retrieve student_id from hidden input field
                var professorId = <?php echo $professor_id; ?>; // Get professor_id from PHP variable
                sendAction('acceptReq', studentId, professorId); // Pass professor_id to the sendAction function
            });

            $('.deny-req-btn').click(function(){
                var studentId = $(this).siblings('.student-id').val(); // Retrieve student_id from hidden input field
                var professorId = <?php echo $professor_id; ?>; // Get professor_id from PHP variable
                sendAction('denyReq', studentId, professorId); // Pass professor_id to the sendAction function
            });
        });

        function sendAction(action, studentId, professorId){
            $.post('handler/action.php', { action: action, user_id: studentId, professor_id: professorId }, function(response){
                alert(response);
                // You may want to refresh the page or update the UI to reflect the changes
            });
        }
    </script>

</body>
</html>


