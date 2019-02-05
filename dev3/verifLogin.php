<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>


<?php

include('connectdb.php');
$username=$_POST["username"];
$password=$_POST["password"];
$table_name="joueur";
$query="SELECT * FROM ".$table_name." WHERE login='".$username."' AND password='".$password."'";
$res=mysqli_query($conn,$query);
if($row=mysqli_fetch_assoc ( $res)){
    session_start();
    $_SESSION["username"]=$username;
    $_SESSION["nom"]=$row["nom"];
    $_SESSION["prenom"]=$row["prenom"];
    $_SESSION["gestionnaire"]=$row["gestionnaire"];
    $_SESSION["id"]=$row["id"];
    header("Location: home.php");
}else{
    header("location:login.php?incorrect");
}


?>