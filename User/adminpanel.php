<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ 
    header("location: ../User/login.php");
    exit;
}

require_once '../Configs/config.php';

    $mysqli = mysqli_connect("localhost","root","","demo");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $id = $_SESSION['id'];

    $sql = "SELECT user_type
            FROM users
            WHERE id=$id";


    $result = mysqli_query($mysqli, $sql);


    $user = mysqli_fetch_array($result);

    $type = $user['user_type'];

    if($type == NULL){
        header("location: ../User/viewer_panel.php");
        exit;
    }
    if($type == 'company'){
        header("location: ../User/company_panel.php");
        exit;
    }
    mysqli_free_result($result);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the administration panel.</h1>
    <p>
        <a href="../Movie/show_movies.php" class="btn btn-warning ml-3">Movies</a>
        <a href="../Series/show_series.php" class="btn btn-warning ml-3">Series</a>
        <a href="../User/show_users.php" class="btn btn-warning ml-3">Users</a>
        <a href="../User/logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>
