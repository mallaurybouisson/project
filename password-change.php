<?php 
session_start();

$page_title = "Mise à jour du changement de mot de passe";
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
                        <h5>Changer le mot de passe</h5>
                    </div>
                    <div class="card-body p-4">

                        <form action="password-reset-code.php" method="POST">
                            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">

                            <div class="form-group mb-3">
                                <label>Adresse mail</label>
                                <input type="text" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" class="form-control" placeholder="Enter Email Address">
                            </div>
                            <div class="form-group mb-3">
                                <label>Nouveau mot de passe</label>
                                <input type="text" name="new_password" class="form-control" placeholder="Entrer mot de passe">
                            </div>
                            <div class="form-group mb-3">
                                <label>Confirmation  mot de passe </label>
                                <input type="text" name="confirm_password" class="form-control" placeholder="Confirmer mot de passe">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="password_update" class="btn btn-success w-100">Mise à jour mot de passe</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>