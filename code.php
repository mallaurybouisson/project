<?php
session_start();
include('config/functions.php');
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($name,$email,$verify_token)
{
    include('config/email_config.php');
    $mail = new PHPMailer(true);
    
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "$g_host";
    $mail->Username = "$domain_email";
    $mail->Password = "$domain_password";

    $mail->SMTPSecure = "$g_secure";
    $mail->Port = $g_port; 

    $mail->setFrom("$domain_email",$name);
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Email de Verification";

    $email_template = 
        "<h2>Mail de vérification</h2>
        <h3>Vérifiez votre adresse e-mail pour vous connecter à l'aide du lien ci-dessous.</h3>
        <br/><br/>
        <a href='$domain_name/verify-email.php?token=$verify_token'> Cliquez ici </a>
    ";
    
    $mail->Body = $email_template;
    $mail->send();
   

}


if(isset($_POST['register_btn']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $verify_token = md5(rand());

    if(!empty(trim($name)) && !empty(trim($phone)) && !empty(trim($email)) && !empty(trim($password)))
    {
        
        $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
        $check_email_query_run = mysqli_query($con, $check_email_query);

        if(mysqli_num_rows($check_email_query_run) > 0)
        {
            redirect("register.php", "L'adresse électronique existe déjà est enregistrée");
        }
        else
        {
            
            $query = "INSERT INTO users (name,phone,email,password,verify_token) VALUES ('$name','$phone','$email','$password','$verify_token')";
            $query_run = mysqli_query($con, $query);

            if($query_run)
            {
                sendemail_verify("$name","$email","$verify_token");
                redirect("register.php", "enregistrement effectué.! Veuillez vérifier votre adresse électronique.");
            }
            else
            {
                redirect("register.php", "Échec de l'enregistrement.");
            }
        }
    }
    else
    {
        redirect("register.php", "Tous les champs sont obligatoires");
    }
}

?>
