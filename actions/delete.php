<?php
$settings['logged'] = true;
$settings['page_id'] = "";
require '../global.php';

$page = $_POST['page'];
$id = $_POST['id'];

if(!empty($page) && !empty($id)) {
  switch($page) {
    case 1:
      $Specialty->setID($id);
      if(!$Specialty->delete()) {
        header('HTTP/1.1 500 Internal Server Booboo');
      }
    break;
    case 2:
      $Teacher->setID($id);
      if(!$Teacher->delete()) {
        header('HTTP/1.1 500 Internal Server Booboo');
      }
    break;
    case 3:
      $Subject->setID($id);
      if(!$Subject->delete()) {
        header('HTTP/1.1 500 Internal Server Booboo');
      }
    break;
    case 4:
      $Planning->setID($id);
      if(!$Planning->delete()) {
        header('HTTP/1.1 500 Internal Server Booboo');
      }
    break;
    default: 
        header('HTTP/1.1 500 Internal Server Booboo');
  }
} else  {
  header('HTTP/1.1 500 Internal Server Booboo');
}
?>