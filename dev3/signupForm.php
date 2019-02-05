<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php
        echo  '<div class="form-group">
            <form class="signup" action="signupVerif.php" method="POST" >
                <div class="form-group">
                    <input type="text" class="form-control" name="nom" placeholder="nom" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="prenom" placeholder="prenom" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control username" name="username" placeholder="nom usager" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control password" name="password" placeholder="mot de passe" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control confirmation-password" placeholder="confirmation du mot de passe" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success signup " value="inscription" >
                </div>
            </form>


        </div>';
?>

