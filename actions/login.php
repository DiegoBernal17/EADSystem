<?php
$settings['logged'] = false;
$settings['page_id'] = "";
require '../global.php';

$email = $Conn->real_escape_string($_POST['email']);
$password = $Conn->real_escape_string($_POST['password']);

if(!empty($email) && !empty($password)) {
  $User->email = $email;
  $User->password = $password;
  if($User->existEmail()) {
    if($User->passwordVerify()) {
      $User->login();
      header("Location: ".URL."home.php");
    } else {
      $_SESSION['error'] = "Contraseña incorrecta.";
      header("Location: ".URL."index.php");
    }
  } else {
    $_SESSION['error'] = "El correo no existe";
    header("Location: ".URL."index.php");
  }
} else {
  $_SESSION['error'] = "No dejes campos vacios";
  header("Location: ".URL."index.php");
}
?>