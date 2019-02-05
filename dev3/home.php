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
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    </head>
    <body>
    
    <style>
    <?php
        include("home.css");
    ?>    
    </style>
    <?php
    
    include("navbar.php");    
    ?> 
    <div class="container wrapper">
        <div class="jumbotron container-fluid">
          
        
          
           <h3>bienvenue dans votre espace personnel <?php  echo $_SESSION["prenom"]." ".$_SESSION["nom"]  ?></h3>
            <hr/>
             <?php
                if($_SESSION["gestionnaire"]==1){?>
                 
                   <ul>
                       
                     <li> <a href="disponibilit%C3%A9s.php">Disponibilités</a>:permet d'afficher les disponibilités des terrains </li>  
                       <li> <a href="reservation.php">reservation</a>:permet de faire une reservation de terrain</li>
                       <li><a href="annulation.php">annulation</a>:permet d'annuler une reservation d'un terrain</li>
                       <li><a href="listeDesReservations.php">historique</a>:permet d'afficher l'historique des reservations</li>
                       <li><a href="listJoueurs.php">liste des joueur</a>:affiche la liste de tous les joueurs du club</li>
                       <li><a href="listTerrainReserve.php">terrains reservés</a>:permet d'afficher la liste des terains reservés</li>
                       <li><a href="listeTerrainDispo.php">terrains disponible</a>:permet d'afficher la liste des terrains disponible</li>
                     </ul>
                    <?php
                }else{
                    ?>
                    <ul>
                            <li> <a href="disponibilit%C3%A9s.php">Disponibilités</a>:permet d'afficher les disponibilités des terrains </li>  
                           <li> <a href="reservation.php">reservation</a>:permet de faire une reservation de terrain</li>
                           <li><a href="annulation.php">annulation</a>:permet d'annuler une reservation d'un terrain</li>
                           <li><a href="listeDesReservations.php">historique</a>:permet d'afficher l'historique des reservations</li>
                      </ul>
                   <?php
                    }
                    ?>
              
            
        
        
        </div>  
    </div>
        
        
        
        
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    </body>
</html>