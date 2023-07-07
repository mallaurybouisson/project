<?php 
session_start();

$page_title = "Password Reset Form";
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <?php require_once('flashmessage.php'); ?>

                <div class="card">
                    <div class="card-header">
                        <h5>Réinitialiser le mot de passe</h5>
                    </div>
                    <div class="card-body p-4">

                        <form action="password-reset-code.php" method="POST">

                            <div class="form-group mb-3">
                                <label>Adresse email</label>
                                <input type="text" name="email" class="form-control" placeholder="Saisir l'adresse électronique">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="password_reset_link" class="btn btn-primary">Envoyer le lien de réinitialisation du mot de passe</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>