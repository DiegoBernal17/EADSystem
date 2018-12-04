<?php
$settings['logged'] = true;
$settings['page_id'] = "";
require '../global.php';
unset($_SESSION);
session_destroy();
header('Location: '.URL);
?>