<?php
ob_start();
session_start();
include_once 'dbconnect.php';

if (isset($_POST['signup'])) {

    $uname = trim($_POST['uname']);
    $email = trim($_POST['email']);
    $post = trim($_POST['post']);

    $stmt = $conn->prepare("SELECT email FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $count = $result->num_rows;

    if ($count == 0) { 


        $stmts = $conn->prepare("INSERT INTO users(username,email,post) VALUES(?, ?, ?)");
        $stmts->bind_param("sss", $uname, $email, $post);
        $res = $stmts->execute();
        $stmts->close();

        $user_id = mysqli_insert_id($conn);
        if ($user_id > 0) {
            $_SESSION['user'] = $user_id; 
            if (isset($_SESSION['user'])) {
                print_r($_SESSION);
                header("Location: index.php");
                exit;
            }

        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again";
        }

    } else {
        $errTyp = "warning";
        $errMSG = "Email is already used";
        print_r($errMSG);
    }

}
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
    <style>
        body{
            background-image:url('images/reg1.webp');
        }

        .container{
            margin-top:10%;
        }
    </style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>

<div class="container" style="width:600px;">

    <div id="reg-form" style="padding:30px;">
        <form method="post" autocomplete="off">

            <div class="col-md-12">

                <div class="form-group" style="text-align:center;">
                    <h2 class="" style="margin-bottom:5%;">Apply for job</h2>
                </div>

                <div class="form-group" style="margin:2%;">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="uname" class="form-control" placeholder="Full Name" required/>
                    </div>
                </div>

                <div class="form-group"style="margin:2%;">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Email" required/>
                    </div>
                </div>

                <div class="form-group"style="margin:2%;">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="text" name="post" class="form-control" placeholder="Job Post" required/>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn    btn-block btn-primary" name="signup" id="reg" style="margin-top:2%; margin-left:40%;">Register</button>
                </div>

            </div>

        </form>
    </div>

</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/tos.js"></script>

</body>
</html>
