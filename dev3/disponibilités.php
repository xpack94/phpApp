
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
             Disponibilités et reservations des terrains pour demain
         </h3>
         <hr/>
         <?php
            date_default_timezone_set('America/Montreal');
            $dateTime = new DateTime('tomorrow');
            date_modify($dateTime, '+6 hour');
            $timeOfDay=$dateTime->format('Y-m-d H:i:s');
            $table_name="terrain";
            $terrainQuery="SELECT id FROM $table_name ";
            include('connectdb.php');
            $terrainResults=mysqli_query($conn,$terrainQuery);
            echo '<table class="table table-responsive table-bordered">';
            echo '<tr>
                  <th></th>
                  <th>6h-7h</th>
                  <th>7h-8h</th>
                  <th>8h-9h</th>
                  <th>9h-10h</th>
                  <th>10h-11h</th>
                  <th>11h-12h</th>
                  <th>12h-13h</th>
                  <th>13h-14h</th>
                  <th>14h-15h</th>
                  <th>15h-16h</th>
                  <th>16h-17h</th>
                  <th>17h-18h</th>
                  <th>18h-19h</th>
                  <th>19h-20h</th>
                  <th>20h-21h</th>
                  </tr>';
            $table="reservation";
            $timeOfDayCopy=$timeOfDay;
            while($row=mysqli_fetch_assoc($terrainResults)){
                echo '<tr><td>Terrain'.$row["id"].'</td>';
                for ($i=0;$i<15;$i++){
                     $query="SELECT * FROM $table WHERE date_reservation='".$timeOfDayCopy."' and terrain_id='".$row["id"]."'";
                    $result=mysqli_query($conn,$query);
                    if(mysqli_num_rows($result)==0){
                        echo '<td class="alert-success"> Disponible</td>';
                    }else{
                        echo '<td class="alert-danger"> Reservé</td>';
                    }
                    $timeOfDayCopy=new DateTime($timeOfDayCopy);
                    date_modify($timeOfDayCopy, '+1 hour');
                    $timeOfDayCopy=$timeOfDayCopy->format('Y-m-d H:i:s');
                }
                 echo '</tr>';
                 $timeOfDayCopy=$timeOfDay;
               
            }
            echo '</table>';
            

        
            
        ?>
            
        </div>  
    </div>
        
        
        
        
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
    </body>
</html>