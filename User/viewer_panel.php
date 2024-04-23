<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../User/login.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>movieCard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/details.css?v=<?php echo time(); ?>">
</head>
<body>
<h1 class="my-5">Hello <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, welcome to <b><span class="uth">Uthflix</span></b>.</h1>
<h2 class="text-center">Available Series</h2>
<div class="container mt-5">

	<div class="row justify-content-center">

    <?php
            require_once "../Configs/uthflix_config.php";
    
            $sql = "SELECT * FROM series";
    
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){	
			            echo '<div class="card movie_card">';
		                echo '    <img src="'. $row["url"] .'" class="card-img-top" alt="...">';
		                echo '    <div class="card-body">';
						echo '        <a class="fas fa-play play_button" href="../Series/series_selection.php?id='. $row["id"] .'" title="Learn more"></a>';
		                echo '        <h4 class="card-title">'. $row["name"] .'</h4>';
                        echo '	    <span class="movie_info">'. $row["year"] .'</span>';
		   	            echo '	    <span class="movie_info float-right"><i class="fas fa-star"></i> 9 / 10</span>';
		                echo '    </div>';
		                echo '</div>';
                    }
                }
            }
    ?>
    
	</div>
</div>
<br><br>    
<h2 class="text-center">Available Movies</h2>
<div class="container mt-5">

	<div class="row justify-content-center">

    <?php
            require_once "../Configs/uthflix_config.php";
    
            $sql = "SELECT * FROM movies";
    
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){	
			            echo '<div class="card movie_card">';
		                echo '    <img src="'. $row["url"] .'" class="card-img-top" alt="...">';
		                echo '    <div class="card-body">';
						echo '        <a class="fas fa-play play_button" href="../Movie/movie_selection.php?id='. $row["id"] .'" title="Learn more"></a>';
		                echo '        <h4 class="card-title">'. $row["name"] .'</h4>';
                        echo '	    <span class="movie_info">'. $row["year"] .'</span>';
		   	            echo '	    <span class="movie_info float-right"><i class="fas fa-star"></i> 9 / 10</span>';
		                echo '    </div>';
		                echo '</div>';
                    }
                }
            }
    ?>

</div>
</div>
<br>
<a href="../User/logout.php" class="btn btn-danger  center">Sign Out of Your Account</a>
<br>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<script>
		$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})
	</script>

</body>
</html>