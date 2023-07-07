<?php
session_start();
include('config/functions.php');
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name,$get_email,$token)
{
    include('config/email_config.php');
    
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "$g_host";
    $mail->Username = "$domain_email";
    $mail->Password = "$domain_password";

    $mail->SMTPSecure = "$g_secure";
    $mail->Port = $g_port;

    $mail->setFrom("$domain_email",$get_name);
    $mail->addAddress($get_email);

    $mail->isHTML(true);
    $mail->Subject = "Notification de réinitialisation du mot de passe";

    $email_template = "
        <h2>Bonjour</h2>
        <h3>Vous recevez cet e-mail parce que nous avons reçu une demande de réinitialisation du mot de passe de votre compte..</h3>
        <br/><br/>
        <a href='$domain_name/password-change.php?token=$token&email=$get_email'> Cliquez ici </a>
    ";
    
    $mail->Body = $email_template;
    $mail->send();
}


if(isset($_POST['password_reset_link']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $token = md5(rand());

    if(!empty(trim($email)))
    {
        $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1";
        $check_email_run = mysqli_query($con, $check_email);

        // Vérifier si l'enregistrement du courrier électronique existe ou non
        if(mysqli_num_rows($check_email_run) > 0)
        {
            $row = mysqli_fetch_array($check_email_run);
            $get_name = $row['name'];
            $get_email = $row['email'];

            $update_token = "UPDATE users SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
            $update_token_run = mysqli_query($con, $update_token);

            // Envoi du lien de réinitialisation du mot de passe à votre adresse électronique
            if($update_token_run)
            {
                send_password_reset($get_name,$get_email,$token);
                redirect("password-reset.php", "Nous avons envoyé un mail de réinitialisation de mot de passe");
            }
            else
            {
                redirect("password-reset.php", "Quelque chose s'est mal passé");
            }
        }
        else
        {
            redirect("password-reset.php", "Email non trouvé");
        }
    }
    else
    {
        redirect("password-reset.php", "Veuillez inserer votre adresse email");
    }
}



if(isset($_POST['password_update']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    $token = mysqli_real_escape_string($con, $_POST['password_token']);

    if(!empty($token))
    {
        if(!empty($email) && !empty($new_password) && !empty($confirm_password))
        {
            // Checking Token is Valid or not 
            $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1";
            $check_token_run = mysqli_query($con, $check_token);

            if(mysqli_num_rows($check_token_run) > 0)
            {
                if($new_password == $confirm_password)
                {
                    $update_password = "UPDATE users SET password='$new_password' WHERE verify_token='$token' LIMIT 1";
                    $update_password_run = mysqli_query($con, $update_password);

                    if($update_password_run)
                    {
                        $new_token = md5(rand());
                        $update_to_new_token = "UPDATE users SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1";
                        $update_to_new_token_run = mysqli_query($con, $update_to_new_token);

                        redirect("login.php", "Nouveau mot de passe mis à jour avec succès");
                    }
                    else
                    {
                        redirect("password-change.php?token=$token&email=$email", "Le mot de passe n'a pas été mis à jour. Quelque chose s'est mal passé");
                    }
                }
                else
                {
                    redirect("password-change.php?token=$token&email=$email", "les champs mot de passe ne correspondent pas");
                }
            }
            else
            {
                redirect("password-change.php?token=$token&email=$email", "token non valide");

            }
        }
        else
        {
            redirect("password-change.php?token=$token&email=$email", "Tous les champs sont obligatoires");
        }
    }
    else
    {
        redirect("password-change.php", "Pas de token disponible");
    }
}


?>

