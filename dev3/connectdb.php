<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php 

/*
 * code: create-unigram.php
 * author: felipe
 * objet: illustrer les operations de base 
 */

include('dbInformation.php');



$conn = mysqli_connect($db_host, $db_user, $db_password,$db_name);


if (!$conn) 
  die("probleme de connection ");

?>