<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

    require_once '../Configs/config.php';
    

    $sql = "SELECT * FROM users WHERE id = ?";
    
    if($stmt = $link->prepare($sql)){

        $stmt->bind_param("i", $param_id);
        

        $param_id = trim($_GET["id"]);
        

        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){

                $row = $result->fetch_array(MYSQLI_ASSOC);
                

                $name = $row["username"];
                $address = $row["password"];
                $salary = $row["created_at"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: ../User/error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    $stmt->close();
    
    $link->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: ../User/error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Username</label>
                        <p><b><?php echo $row["username"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <p><b><?php echo $row["password"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Creation date</label>
                        <p><b><?php echo $row["created_at"]; ?></b></p>
                    </div>
                    <p><a href="../User/show_users.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>