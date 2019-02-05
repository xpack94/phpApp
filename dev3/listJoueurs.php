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
        <h2>Liste des joueurs du club</h2>
        <hr/>
        <?php
            include("connectdb.php");
            $table_name="joueur";
            $query=("SELECT * FROM $table_name ");

            $res=mysqli_query($conn,$query);

             echo '<table class="table">    
                    <tr>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>nom usager</th>
                    </tr>';
                      
            while($row=mysqli_fetch_assoc($res)){
              
                echo' 
                    <tr> <td>'
                    
                    .$row["nom"]
                    .'</td><td>'
                    .$row["prenom"]
                    .'</td><td>'
                    .$row["login"]
                    .'</td></tr>';
                  
            }
            echo '</table>';
        ?>
       
        </div>
    </div>
  
    

    
    
</body>
</html>



