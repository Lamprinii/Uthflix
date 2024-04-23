<?php
require_once "../Configs/uthflix_config.php";
 
function filter_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$company = $name = $url = $trailer = $duration = $year = $genre = $desc = "";
$company_err = $name_err = $url_err = $trailer_err = $duration_err = $year_err = $genre_err = $desc_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_company = trim($_POST["company"]);
    if(empty($input_company)){
        $company_err = "Please enter the company's name.";
    } elseif(!filter_var($input_company, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s\d+]+$/")))){
        $company_err = "Please enter a valid company name.";
    } else{
        $company = $input_company;
    }

    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a movie name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s\d+]+$/")))){
        $name_err = "Please enter a valid movie name.";
    } else{
        $name = $input_name;
    }

    $input_url = trim($_POST["url"]);
    if(empty($input_url)){
        $url_err = "Please enter a url for the movie thumbnail.";
    } elseif(!filter_var($input_url, FILTER_SANITIZE_URL)){
        $url_err = "Please enter a valid url for the movie thumbnail.";
    } else{
        $url = $input_url;
    }

    $input_trailer = trim($_POST["trailer"]);
    if(empty($input_trailer)){
        $trailer_err = "Please enter a url for the movie trailer.";
    } elseif(!filter_var($input_trailer, FILTER_SANITIZE_URL)){
        $trailer_err = "Please enter a valid url for the movie trailer.";
    } else{
        $trailer = $input_trailer;
    }
    
    $input_duration = trim($_POST["duration"]);
    if(empty($input_duration)){
        $duration_err = "Please enter the duration of the movie.";     
    } elseif(!ctype_digit($input_duration)){
        $duration_err = "Please enter a valid movie duration (only integers).";
    } else{
        $duration = $input_duration;
    }

    $input_year = trim($_POST["year"]);
    if(empty($input_year)){
        $year_err = "Please enter the year of the movie.";     
    } elseif(!ctype_digit($input_year)){
        $year_err = "Please enter a valid movie year (only integers).";
    } else{
        $year = $input_year;
    }

    $input_genre = trim($_POST["genre"]);
    if(empty($input_genre)){
        $genre_err = "Please enter an address.";     
    } elseif(!filter_var($input_genre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z-\s]+$/")))){
        $genre_err = "Please enter a valid movie genre.";
    } else{
        $genre = $input_genre;
    }

    $input_desc = trim($_POST["description"]);
    if(empty($input_desc)){
        $desc_err = "Please enter a movie description.";
    } else{
        $desc = filter_data($input_desc);
    }
    
    if(empty($company_err) && empty($name_err) && empty($url_err) && empty($trailer_err) && empty($duration_err) && empty($year_err) && empty($genre_err) && empty($desc_err)){

        $sql = "INSERT INTO movies (company, name, url, trailer, duration, year, genre, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
 
        if($stmt = $link->prepare($sql)){

            $stmt->bind_param("ssssiiss", $param_company, $param_name, $param_url, $param_trailer, $param_duration, $param_year, $param_genre, $param_desc);
            

            $param_company = $company;
            $param_name = $name;
            $param_url = $url;
            $param_trailer = $trailer;
            $param_duration = $duration;
            $param_year = $year;
            $param_genre = $genre;
            $param_desc = $desc;

            if($stmt->execute()){

                header("location: ../User/company_panel.php");
                exit;

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         

        $stmt->close();
    }
    

    $link->close();
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add a movie record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                            <label>Company name</label>
                            <input type="text" name="company" class="form-control <?php echo (!empty($company_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $company; ?>">
                            <span class="invalid-feedback"><?php echo $company_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Movie name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Movie thumbnail</label>
                            <input type="text" name="url" class="form-control <?php echo (!empty($url_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $url; ?>">
                            <span class="invalid-feedback"><?php echo $url_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Movie trailer</label>
                            <input type="text" name="trailer" class="form-control <?php echo (!empty($trailer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $trailer; ?>">
                            <span class="invalid-feedback"><?php echo $trailer_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Duration</label>
                            <input name="duration" class="form-control <?php echo (!empty($duration_err)) ? 'is-invalid' : ''; ?>"><?php echo $duration; ?></input>
                            <span class="invalid-feedback"><?php echo $duration_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <input name="year" class="form-control <?php echo (!empty($year_err)) ? 'is-invalid' : ''; ?>"><?php echo $year; ?></input>
                            <span class="invalid-feedback"><?php echo $year_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Genre</label>
                            <input type="text" name="genre" class="form-control <?php echo (!empty($genre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $genre; ?>">
                            <span class="invalid-feedback"><?php echo $genre_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea style="width: 570px;" name="description" class="form-control <?php echo (!empty($desc_err)) ? 'is-invalid' : ''; ?>"><?php echo $desc; ?></textarea> <br />
                            <span class="invalid-feedback"><?php echo $desc_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../User/company_panel.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>