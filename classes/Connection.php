<?php

class Connection extends mysqli {

  private static $host = "localhost";
  private static $username = "root";
  private static $password = "";
  private static $database = "sistemamateriasdb";

  public function __construct() {
    parent::__construct(self::$host, self::$username, self::$password, self::$database);
   // parent::__construct("localhost", "root", "", "sistemamateriasdb");

    if (mysqli_connect_error()) {
      die('Error de Conexión (' . mysqli_connect_errno() . ') '
              . mysqli_connect_error());
    }
  }

  public function getNameSemester($semester = "") {
    switch($semester) {
      case 1:
        return "Enero-Junio";
      case 2:
        return "Agosto-Diciembre";
      case "":
        return $this->getNameSemester($this->getSemester());
    }
    return "";
  }

  public function getSemester() {
    $mes = date('m');
    if($mes < 7) {
      return 1;
    } else {
      return 2;
    }
  }

  public function getBimester() {
    $mes = date('m');
    if($mes <= 3 || ($mes >= 7 && $mes <= 9)) {
      return 1;
    } else {
      return 2;
    }
  }
}
?>