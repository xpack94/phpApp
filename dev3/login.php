<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
if( isset($_SESSION["username"])){
    header("location:home.php");
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
    
<link rel="stylesheet" href="login.css">
<!------ Include the above in your HEAD tag ---------->
</head>
<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <body>
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <?php
             if(isset($_GET["incorrect"])){?>
                <div class="alert alert-danger">
                           nom d'utilisateur ou mot de pass incorrecte
                        </div>
             <?php }?>
            
            <img id="profile-img" class="profile-img-card" src="https://kooledge.com/assets/default_medium_avatar-57d58da4fc778fbd688dcbc4cbc47e14ac79839a9801187e42a796cbd6569847.png"/>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="verifLogin.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" class="form-control" placeholder="nom d'utilisateur" name="username" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="mot de pass" name="password" required>
                <div id="no-account" >
                    <label>
                        <a href="signup.php">s'inscrir</a>
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">se connecter</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/show_products.js" ></script>
    
    
    </body>
</html>