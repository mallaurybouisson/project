<?php 
session_start();
if(isset($_SESSION['authenticated']))
{
    $_SESSION['status'] = "You are already Logged In";
    header('Location: dashboard.php');
    exit(0);
}

$page_title = "Login Form";
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <?php require_once('flashmessage.php'); ?>

                <div class="card shadow">
                    <div class="card-header">
                        <h5>Formulaire d'enregistrement</h5>
                    </div>
                    <div class="card-body">

                        <form action="logincode.php" method="POST">

                            <div class="form-group mb-3">
                                <label for="">Adresse electronique</label>
                                <input type="text" name="email" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Votre de passe</label>
                                <input type="text" name="password" class="form-control" >
                            </div>

                            <div class="form-group">
                                <button type="submit" name="login_now_btn" class="btn btn-primary">Connexion</button>
                                <a href="password-reset.php" class="float-end">Vous avez oublié votre mot de passe?</a>
                            </div>

                        </form>

                        <hr>
                        <h5>
                             Vous n'avez pas reçu d'email ?
                            <a href="resend-email-verification.php">Renvoyer</a>
                        </h5>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>