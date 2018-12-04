<?php
$settings['logged'] = false;
$settings['page_id'] = "";
require '../global.php';

$name = $Conn->real_escape_string($_POST['name']);
$email = $Conn->real_escape_string($_POST['email']);
$password = $Conn->real_escape_string($_POST['password']);
$repassword = $Conn->real_escape_string($_POST['repassword']);

if(!empty($name) && !empty($email) && !empty($password) && !empty($repassword)) {
  if($password == $repassword) {
    $User->name = $name;
    $User->email = $email;
    $User->password = $password;
    if(!$User->existEmail()) {
      $User->add();
      $User->login();
      header("Location: ".URL."home.php");
    } else {
      $_SESSION['error'] = "El correo ya existe";
      header("Location: ".URL."register.php");
    }
  } else {
    $_SESSION['error'] = "Las contraseñas introducidas no coinciden";
    header("Location: ".URL."register.php");
  }
} else {
  $_SESSION['error'] = "No dejes campos vacios";
  header("Location: ".URL."register.php");
}
?>