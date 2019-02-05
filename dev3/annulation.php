<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>

<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
if(!isset($_SESSION["username"])) {
   
    header("location:login.php");
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>login</title>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
         <style>
            <?php
                include("home.css");
            ?>    
        </style>
        
    </head>

    <body>

        <?php
    include("navbar.php");    
    ?>
            <div class="container wrapper">
                <div class="jumbotron container-fluid">
                    <h3>
                        Annulation d'une Reservation
                    </h3>
                    <hr/>


                    <?php
                    include("connectdb.php");
                    if(isset($_POST["id"])){
                        $query="DELETE FROM reservation WHERE id='".$_POST["id"]."';";
                        if(mysqli_query($conn,$query)==TRUE){
                            echo '<div class="alert alert-success">
                                       votre reservation a été annulée avec succès 
                                    </div>';
                        }else{
                            echo '<div class="alert alert-danger">
                                        votre reservation n\'a pas pu etre annuler 
                                    </div>';
                        }
                        
                         
                    }else{
                        
                    
                    
                         
                         date_default_timezone_set('America/Montreal');
                         $date = date_create('tomorrow'); 
                         $demain = date_format($date, 'Y-m-d');
                         $query="SELECT id,terrain_id,DATE_FORMAT(date_reservation, '%Y-%m-%d') as date,DATE_FORMAT(date_reservation,'%H:%i:%s') as  time FROM reservation
                         WHERE date_reservation BETWEEN '".$demain." 06:00:00' AND '".$demain." 21:00:00';";
                         $results=mysqli_query($conn,$query);
                         if(mysqli_num_rows($results)==0){
                             echo '<div class="alert alert-danger">
                                       vous n\'avez fait aucune reservation pour demain
                                    </div>';
                         }else{
                             while($row=mysqli_fetch_assoc($results)){
                                 echo '<div class="form-group">
                                            <form  action="annulation.php" method="post">
                                        <div class="form-group">
                                        <table class="table table-responsive table-bordered">
                                        <tr>
                                        <th>terrain</th>
                                        <th>heure</th>
                                        <th>date</th>
                                        </tr>
                                        <tr><td>Terrain'.$row["terrain_id"].
                                        '</td>
                                        <td>'.$row["time"].'</td>
                                        <td>'.$row["date"].'</td>
                                        <td><input type="submit" value="annuler Reservation"/>
                                        <input type="text" name="id" hidden value="'.$row["id"].'"/>
                                        </tr>
                                        </table>

                                        ';


                         }
                         }
                    }
                        
                     ?>

                </div>
            </div>





            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

    </html>
