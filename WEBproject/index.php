<?php
ob_start();
session_start();
require_once 'dbconnect.php';

$res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hello,<?php echo $userRow['email']; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/index.css" type="text/css"/>
    <link rel="stylesheet" href="register.css">

</head>
<body>

<div class="container">
    <!-- Jumbotron-->
    <div class="jumbotron">
        <h1>Hello, <?php echo $userRow['username']; ?></h1>
        <p>You have successfully registered for the job interview!<br><br>Thank you for your interest in our company.<br><br>An email will be sent to your registerd email-id regarding the further process.
           <br> Kindly check your email regularly for any updates from us. </p>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2>NOTE</h2>
            <p>If you miss the interview , your application will be rejected.</p>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
