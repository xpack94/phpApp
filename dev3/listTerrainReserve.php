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

        <link rel="stylesheet" href="home.css">
        <!------ Include the above in your HEAD tag ---------->
        <style>
            select {
                border: 1px solid #ccc;
                width: 120px;
                border-radius: 3px;
                overflow: hidden;
                background: #fafafa url("img/icon-select.png") no-repeat 90% 50%;
                padding: 5px 8px;
            }
            
            label {
                margin-right: 5px;
            }
            
            input[type="submit"] {
                margin-left: 5px;
            }
            
            select[name="terrain"] {
                margin-left: 7px;
            }
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
                    <h2>liste des terrains reservé dans la journée en cours</h2>
                    <hr/>
                   
                    <div class="form-group">
                        <form class="signup" action="listTerrainReserve.php" method="post" onsubmit="return validateOptions();">
                            <div class="form-group">
                                <label>Heure de debut</label>
                                <select name="debut" class="debut">
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

                                <label>Heure de debut</label>
                                <select name="fin" class="fin">
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
                            <option value='21'>21h</option> 
                    </select>

                                <select name="terrain">
                        <option value="1">Terrain1</option>
                        <option value="2">Terrain2</option>
                        <option value="3">Terrain3</option>
                        <option value="4">Terrain4</option>
                        <option value="5">Terrain5</option>
                    </select>

                                <input type="submit" class="btn btn-default" value="afficher">
                            </div>





                        </form>
                    </div>
                    <?php
           if(isset($_POST["debut"]) and isset($_POST["fin"]) and isset($_POST["terrain"])){
               $heureDebut=$_POST["debut"];
               $heureFin=$_POST["fin"];
               $terrain=$_POST["terrain"];
               date_default_timezone_set('America/Montreal');
               $aujourdhui = date_create('today'); 
               $jour = date_format($aujourdhui, 'Y-m-d');
               $debut="".$jour." ".$heureDebut.":00:00";
               $fin="".$jour." ".$heureFin.":00:00";
                
               include("connectdb.php");
               $query="
                SELECT joueur_id,nom,prenom,login,DATE_FORMAT(date_reservation, '%Y-%m-%d') as date,DATE_FORMAT(date_reservation,'%H:%i:%s') as  time
                from reservation
                inner join joueur
                on reservation.joueur_id=joueur.id
                where reservation.date_reservation between '".$debut."' and '".$fin."' and terrain_id='".$terrain."' 
                order by date_reservation ASC ; ";
                $result=mysqli_query($conn,$query);
                
                if(mysqli_num_rows($result)==0){
                    echo '<div class="alert alert-warning">
                            aucune reservation n\'a été faite de '.$heureDebut.'h a '.$heureFin.'h pour le terrain '.$terrain.'
                          </div>';
                   
                }else{
                    echo "<table class='table'><tr>
                        <th></th>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>nom usager</th>
                        </tr>" ;
                    while($row=mysqli_fetch_assoc($result)){
                    echo "<tr><td>".substr($row["time"],0,-6)."h-".((int)substr($row["time"],0,-6)+1)."h</td>";
                    echo "<td>".$row["nom"]."</td>";
                    echo "<td>".$row["prenom"]."</td>";
                    echo "<td>".$row["login"]."</td>";
                    echo "</tr>";
                }    
                }
                
               echo "</table>";
           }else{
               echo  '<div class="alert alert-info">
                          veuillez choisir les heures de debut et de fin ainsi que le terrain
                        </div>';
           }
           
        ?>
                </div>


            </div>



          <script src="script.js"></script>
    </body>


</html>
