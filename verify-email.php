<?php
session_start();
include('config/functions.php');
include('dbcon.php');

if(isset($_GET['token']))
{
    $token = mysqli_real_escape_string($con, $_GET['token']);
    $verify_query = "SELECT verify_token,verify_status FROM users WHERE verify_token='$token' LIMIT 1";
    $verify_query_run = mysqli_query($con, $verify_query);

    // New Random Generated Token
    $new_gen_token = md5(rand());

    // regarder si mon token existe
    if(mysqli_num_rows($verify_query_run) > 0)
    {
        $row = mysqli_fetch_array($verify_query_run);
        if($row['verify_status'] == "0")
        {
            $clicked_token = $row['verify_token'];
            
            // /Une fois la vérification effectuée, il mettra à jour le statut de vérification à 1 et modifiera la valeur du token .
            $update_query = "UPDATE users SET verify_status='1', verify_token='$new_gen_token' WHERE verify_token='$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($con, $update_query);

            if($update_query_run)
            {
                redirect("login.php", "Votre compte a été vérifié avec succès");
            }
            else
            {
                redirect("login.php", "Échec de la vérification");
            }
        }
        else
        {
            redirect("login.php", "Email déjà vérifié. Veuillez vous connecter");
        }
    }
    else
    {
        redirect("login.php", "Ce token n'existe pas");
    }
}
else
{
    redirect("login.php", "Non autorisé");
}

?>