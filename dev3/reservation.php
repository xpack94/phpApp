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
                        Reservations d'un terrain pour demain
                    </h3>
                    <hr/>
                    <div class="form-group">
                        <form class="" action="reservation.php" method="post">
                            <div class="form-group">
                                <label>Heure de reservation</label>
                                <select name="heureReservation" class="heure">
                                    <option value='06'>06h</option> 
                                    <option value='07'>07h</option> 
                                    <option value='08'>08h</option> 
                                    <option value='09'>09h</option> 
                                    <option value='10'>10h</option> 
                                    <option value='11'>11h</option> 
                                    <option value='12'>12h</option> 
                                    <option value='13'>13h</option> 
                                    <option value='14'>14h</option> 
                                    <option value='15'>15h</option> 
                                    <option value='16'>16h</option> 
                                    <option value='17'>17h</option> 
                                    <option value='18'>18h</option> 
                                    <option value='19'>19h</option> 
                                    <option value='20'>20h</option> 
                                </select>

                                <select name="terrain">
                                    <option value="1">Terrain1</option>
                                    <option value="2">Terrain2</option>
                                    <option value="3">Terrain3</option>
                                    <option value="4">Terrain4</option>
                                    <option value="5">Terrain5</option>
                                </select>
                                <input type="submit" class="btn btn-default" value="reserver" />
                            </div>
                        </form>


                        <?php
                             if(isset($_POST["heureReservation"])){
                                
                                $heureDeReservation=$_POST["heureReservation"];
                                $terrain=$_POST["terrain"];
                                date_default_timezone_set('America/Montreal');
                                $date = date_create('tomorrow'); 
                                $demain = date_format($date, 'Y-m-d');
                                include("connectdb.php");
                                $AvailableQuery="SELECT * FROM reservation 
                                                    WHERE  terrain_id='".$terrain."' AND date_reservation='".$demain." ".$heureDeReservation.":00:00';";
                                 
                                 $availabilityResults=mysqli_query($conn,$AvailableQuery);
                                 if(mysqli_num_rows($availabilityResults)!=0){
                                      echo "<div class='alert alert-danger'>
                                               le terrain $terrain est deja reservé a ".$heureDeReservation."h
                                            </div>";
                                 }else{
                                     $alreadyBooked="SELECT * FROM reservation 
                                     WHERE joueur_id='".$_SESSION["id"]."' and date_reservation between 
                                     '".$demain." 06:00:00' AND '".$demain." 21:00:00';";
                                     $alreadyBookedResult=mysqli_query($conn,$alreadyBooked);
                                     if(mysqli_num_rows($alreadyBookedResult)!=0){
                                          echo "<div class='alert alert-danger'>
                                               vous ne pouvez pas faire deux reservation la meme journée 
                                            </div>";
                                     }else{
                                          $query="INSERT INTO reservation (joueur_id,terrain_id,date_reservation) 
                                         values(".$_SESSION["id"].",".$terrain.",'".$demain." ".$heureDeReservation.":00:00' );";
                                         $results=mysqli_query($conn,$query);
                                         if($results===TRUE){
                                              echo "<div class='alert alert-success'>
                                                    le terrain $terrain est maintenant réservé a ".$heureDeReservation."h
                                                </div>";
                                     }
                                     }
                                    
                                 }
                                 
                                 
                                
                                 
                             }else{
                                 echo '<div class="alert alert-info">
                                        veulliez choisir l\'heure de reservation ainsi que le terrain
                                       </div>';
                            }
                            ?>

                    </div>
                </div>




                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

    </html>
