<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

if(isset($_SESSION["username"])) {
   
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

    <link rel="stylesheet" href="signup.css">
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                     <?php
                        if(isset($_GET["error"])){?>
                         <div class="alert alert-danger">
                            le nom d'utilisateur est déja utilisé
                        </div>
                        <?php }?>
                     
                        <p>Inscription</p>
                        <div class="alert alert-danger hide hidden-alert">
                            les mot de passe ne sont pas identiques
                        </div>
                        <div class="col-md-9 ">
                            <?php
                            include("signupForm.php");
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
      document.querySelector(".signup").addEventListener("submit",(e)=>{
           
            console.log("fired"); 
            const password = document.querySelector(".password");
            const passwordConfirmation = document.querySelector(".confirmation-password");
            if (password.value !== passwordConfirmation.value) {
                document.querySelector(".hidden-alert").classList.remove("hide");
                e.preventDefault(); //pour stoper le submit
                return false;
                
            }
            return true;
        
      })
        
        

    </script>
</body>

</html>
