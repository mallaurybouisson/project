<?php 
session_start();

$page_title = "Login Form";
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
                        <h5>Renvoi de l'e-mail de vérification</h5>
                    </div>
                    <div class="card-body">

                        <form action="resend-code.php" method="POST">
                            <div class="form-group mb-3">
                                <label> Adresse électronique</label>
                                <input type="text" name="email" class="form-control" placeholder="Saisir l'adresse électronique">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="resend_email_verify_btn" class="btn btn-primary">Soumettre</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>