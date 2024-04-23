<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>"">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>

</head>
<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

    require_once '../Configs/uthflix_config.php';

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

  <body>
  <div class="container">
        <?php
        echo '<h1 class="heading">' . $row["name"] . ' </h1>';
        echo '<img class="thumbnail" src="'. $row["url"] .'" width = 340 height = 500 alt="'. $row["name"] .'" />';
        echo '<iframe class="vid" width="760" height="500" src="'. $row["trailer"].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        echo '<h2 class="second-header">Series info</h2>';
        echo '<div class="info">';
            echo '<span class="desc">' . $row["description"] .' </span></div>';
            echo '<br>';
            echo '<div class="spec">';
            echo '<h4>Year: <span> '. $row["year"] .' </span></h4>';
            echo '<h4>Genre: <span>'. $row["genre"] .' </span></h4>';
            echo '<h4>Seasons: <span>'. $row["seasons"] .' </span></h4>';
            echo '<h4>Episodes: <span>'. $row["episodes"] .' </span></h4>';
                echo '<br><br>';
            echo '</div>';
        echo '</div>';
        ?>
    </div>
  </body>
</html>
