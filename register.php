<?php 
session_start();

$page_title = "Registration Form";
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
                        <h5>Formulaire d'inscription avec vérification de l'adresse électronique</h5>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Nom</label>
                                <input type="text" name="name" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Numeros de téléphone </label>
                                <input type="text" name="phone" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Adresse email</label>
                                <input type="text" name="email" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Mot de passe</label>
                                <input type="text" name="password" class="form-control" >
                            </div>
                            <div class="form-group">
                                <button type="submit" name="register_btn" class="btn btn-primary">S'inscrire</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>