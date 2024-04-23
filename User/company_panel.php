<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../User/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the company administration panel.</h1>
    <a href="../Movie/create_movie.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Movie</a>
    <a href="../Series/create_series.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Series</a>
    <a href="../User/logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</body>
</html>
