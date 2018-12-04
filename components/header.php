<?php
require './global.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $settings['title']; ?></title>
  <link rel="shortcut icon" href="<?php echo URL; ?>resources/favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?php echo URL; ?>resources/favicon.ico" type="image/x-icon">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <!--Import styles-->
  <?php if($settings['page_id'] != 'index' && $settings['page_id'] != 'register') { ?>
  <link rel="stylesheet" href="<?php echo URL; ?>resources/css/materialize.min.css">
  <link rel="stylesheet" href="<?php echo URL; ?>resources/css/style.css">
  <?php } else { ?>
  <link rel="stylesheet" href="<?php echo URL; ?>resources/css/index.css">
  <?php } ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
</head>
<body style="background-color: ghostwhite;">