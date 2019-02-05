<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>




<?php
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$username=$_POST["username"];
$password=$_POST["password"];
$table_name="joueur";
include("connectdb.php");

$doesnExist="SELECT * FROM $table_name WHERE login='$username';";

$resultIfExists=mysqli_query($conn,$doesnExist);
if(mysqli_num_rows($resultIfExists)>0){
    $msg="error";
   header("Location:signup.php?$msg");
}else{
    $query="INSERT INTO $table_name (nom,prenom,login,password,gestionnaire) values('$nom','$prenom','$username','$password',false) ;";


    $result=mysqli_query($conn,$query);
   
    if($result===TRUE){
        session_start();
        $_SESSION["username"]=$username;
        $_SESSION["nom"]=$_POST["nom"];
        $_SESSION["prenom"]=$_POST["prenom"];
        $_SESSION["gestionnaire"]=0;
        $_SESSION["id"]=mysqli_insert_id($conn);
        header("Location: home.php");
    }

}






?>
