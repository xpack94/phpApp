<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
 <?php
  if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php
echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
       
      <a class="navbar-brand" href="#">'.($_SESSION["gestionnaire"]==1?'club de sport(gestionnaire)':'club de sport').'</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown" style="flex-direction: row-reverse;">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Accueil <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="disponibilités.php" >Disponibilités</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reservation.php">Reservations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">déconnexion</a>
          </li>
          
        </ul>
      </div>
      </div>
    </nav> ';

?>