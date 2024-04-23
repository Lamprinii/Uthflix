<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

    require_once "../Configs/uthflix_config.php";
    
 
    $sql = "SELECT * FROM series WHERE id = ?";
    
    if($stmt = $link->prepare($sql)){

        $stmt->bind_param("i", $param_id);
        

        $param_id = trim($_GET["id"]);
        

        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){

                $row = $result->fetch_array(MYSQLI_ASSOC);
                
            } else{

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
                        <label>Company name</label>
                        <p><b><?php echo $row["company"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $row["name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Thumbnail URL</label>
                        <p><b><?php echo $row["url"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Trailer URL</label>
                        <p><b><?php echo $row["trailer"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Number of seasons</label>
                        <p><b><?php echo $row["seasons"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Number of episodes</label>
                        <p><b><?php echo $row["episodes"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Year of release</label>
                        <p><b><?php echo $row["year"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Genre</label>
                        <p><b><?php echo $row["genre"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $row["description"]; ?></b></p>
                    </div>
                    <p><a href="../Series/show_series.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>