<?php

require_once '../Configs/config.php';
 

$name = $salary = "";
$name_err = $salary_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
    

    $input_name = trim($_POST["username"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    

    if(empty($name_err)){

        $sql = "UPDATE users SET username=? WHERE id=?";
 
        if($stmt = $link->prepare($sql)){

            $stmt->bind_param("si", $param_name, $param_id);
            

            $param_name = $name;
            $param_id = $id;
            

            if($stmt->execute()){

                header("location: ../User/show_users.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         

        $stmt->close();
    }
    

    $link->close();
} else{

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        $id =  trim($_GET["id"]);
        

        $sql = "SELECT * FROM users WHERE id = ?";
        if($stmt = $link->prepare($sql)){

            $stmt->bind_param("i", $param_id);
            

            $param_id = $id;
            

            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){

                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    $name = $row["username"];
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
    }  else{

        header("location: ../User/error.php");
        exit();
    }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../User/show_users.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>