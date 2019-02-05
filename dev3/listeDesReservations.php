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
        <!------ Include the above in your HEAD tag ---------->
    </head>

    <body>
        <?php
    include("navbar.php");
?>

            <div class="container wrapper">
                <div class="jumbotron container-fluid">
                    <h3>affichage de l'historique des reservations</h3>
                    <hr/>
                    <form class="" action="listeDesReservations.php" method="get">
                        <div class="form-group">
                            <label>Mois</label>
                            <select name="month">
                                    <option value="01">Janvier</option>
                                    <option value="02">Fevrier</option>
                                    <option value="03">Mars</option>
                                    <option value="04">Avril</option>
                                    <option value="05">Mai</option>
                                    <option value="06">Juin</option>
                                    <option value="07">Juillet</option>
                                    <option value="08">Aout</option>
                                    <option value="09">Septembre</option>
                                    <option value="10">Octobre</option>
                                    <option value="11">Novembre</option>
                                    <option value="12">Decembre</option>
                                    
                                </select>
                            <label>années</label>
                            <input type="number" name="year" value="2018" />
                            <input type="submit" class="btn btn-default" value="afficher" />

                        </div>
                    </form>

                    <?php
                    if(isset($_GET["month"]) and isset($_GET["year"])){
                        $month=$_GET["month"];
                        $year=$_GET["year"];
                        $chosenDate="$year-$month";
                        include("connectdb.php");
                        $query=("
                        SELECT terrain_id,DATE_FORMAT(date_reservation, '%Y-%m-%d') as date,DATE_FORMAT(date_reservation,'%H:%i:%s') as  time
                        FROM reservation 
                        WHERE joueur_id='".$_SESSION["id"]."' AND date_reservation BETWEEN '".$chosenDate."-00' AND '".$chosenDate."-31';");
                        $results=mysqli_query($conn,$query);
                        if(mysqli_num_rows($results)!=0){
                            
                            echo '<table class="table  table-bordered"><tr><th>terrain reservé</th><th>heure</th><th>date</th></tr>';
                            while($row=mysqli_fetch_assoc($results)){
                                echo '<tr><td>';
                                echo 'Terrain'.$row["terrain_id"].'</td>';
                                echo '<td>'.$row["time"].'</td>';
                                echo '<td>'.$row["date"].'</td>';
                                echo '</tr>';

                            }
                            echo '</table>';
                        }else{
                            echo '<div class="alert alert-danger">
                                   aucune reservation n\'a etait faite pour la periode donnée 
                                </div>';
                        }
                    }else{
                       echo '<div class="alert alert-info">
                           veulliez entrer une date
                        </div>';
                    }
                        
                        
        
                    ?>

                </div>
            </div>



    </body>

</html>
