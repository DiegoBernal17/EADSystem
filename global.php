<?php
define('URL', "http://localhost:8080/sistemaEAD/");

session_start();
require 'classes/Connection.php';
require 'classes/Teacher.php';
require 'classes/User.php';
require 'classes/Specialty.php';
require 'classes/Subject.php';
require 'classes/Planning.php';

$Conn = new Connection();
$Teacher = new Teacher();
$User = new User();
$Specialty = new Specialty();
$Subject = new Subject();
$Planning = new Planning();

if(isset($_SESSION['NAME'])) {
  define('NAME', $_SESSION['NAME']);
}
if(isset($_SESSION['USER_ID'])) {
  define('USER_ID', $_SESSION['USER_ID']);
}
if($settings['logged'] && !isset($_SESSION['USER_ID'])) {
  header("Location: index.php");
}
if(($settings['page_id'] == "index" || $settings['page_id'] == "register") && isset($_SESSION['USER_ID'])){
  header("Location: home.php");
}
?>