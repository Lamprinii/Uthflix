<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">User Details</h2>
                    </div>
                    <?php 

                    require_once '../Configs/config.php'; 


                    $mysqli = mysqli_connect("localhost","root","","demo");

                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }



     $sql = "SELECT * FROM USERS";
     if($result = mysqli_query($mysqli, $sql)){
         if(mysqli_num_rows($result) > 0){
             echo '<table class="table table-bordered table-striped">';
                 echo "<thead>";
                     echo "<tr>";
                         echo "<th>#</th>";
                         echo "<th>Username</th>";
                         echo "<th>Password</th>";
                         echo "<th>Creation date</th>";
                     echo "</tr>";
                 echo "</thead>";
                 echo "<tbody>";
                 while($row = mysqli_fetch_array($result)){
                     echo "<tr>";
                         echo "<td>" . $row['id'] . "</td>";
                         echo "<td>" . $row['username'] . "</td>";
                         echo "<td>" . $row['password'] . "</td>";
                         echo "<td>" . $row['created_at'] . "</td>";
                         echo "<td>";
                             echo '<a href="read_users.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                             echo '<a href="update_users.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                             echo '<a href="delete_users.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                         echo "</td>";
                     echo "</tr>";
                 }
                 echo "</tbody>";                            
             echo "</table>";

             mysqli_free_result($result);

         } else{
             echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
         }
     } else{
         echo "Oops! Something went wrong. Please try again later.";
     }
    

     mysqli_close($mysqli);
?>
                </div>
                <a href="../User/adminpanel.php" class="btn btn-warning ml-3">Back to admin panel</a>
            </div>        
        </div>
    </div>
</body>
</html>