<?php
class Subject {
  private $conn;
  public $id;
  public $key;
  public $name;
  public $hours_theory;
  public $hours_practice;
  public $credits;
  public $id_internal_subject;
  public $id_specialty;

  public function __construct(){
    global $Conn;
    $this->conn = $Conn;
  }

  public function get() {
    if(!empty($this->id)) {
      $result = $this->conn->query("SELECT * FROM materias WHERE idMateria = '".$this->id."'");
      $data = $result->fetch_array();
      $this->key = $data['clave'];
      $this->name = $data['nombreMateria'];
      $this->hours_theory = $data['hrsTeoria'];
      $this->hours_practice = $data['hrsPractica'];
      $this->credits = $data['creditos'];
      $this->id_internal_subject = $data['idMateriaInterna'];
      $this->id_specialty = $data['idEspecialidad'];
    }
  }

  public function getOne() {
    if(!empty($this->id)) {
      $result = $this->conn->query("SELECT * FROM materias WHERE idMateria = '".$this->id."'");
      return $result->fetch_array();
    }
  }

  public function showAll($pageno) {
    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page;
    $count = $this->conn->query("SELECT COUNT(*) FROM materias");
    $total_rows = $count->fetch_array()[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $result = $this->conn->query("SELECT m.*, e.especialidad FROM materias m
                                  INNER JOIN especialidad e ON e.idEspecialidad = m.idEspecialidad
                                  LIMIT $offset, $no_of_records_per_page");
    echo '<table class="striped responsive-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Horas<br>Teoría</th>
                <th>Horas<br>Práctica</th>
                <th>Créditos</th>
                <th>Especialidad</th>
              </tr>
            </thead>
            <tbody>';
    while($row = $result->fetch_assoc()) {
      echo '<tr>
              <td>'.$row['idMateria'].'</td>
              <td>'.$row['clave'].'</td>
              <td>'.$row['nombreMateria'].'</td>
              <td>'.$row['hrsTeoria'].'</td>
              <td>'.$row['hrsPractica'].'</td>
              <td>'.$row['creditos'].'</td>
              <td>'.$row['especialidad'].'</td>
              <td>
                <a href="'.URL.'subject.php?edit='.$row['idMateria'].'" class="grey-text text-darken-1">
                  <i class="material-icons right">edit</i>
                </a>
                <a href="#" onclick="deleteItem(3, '.$row['idMateria'].')" class="grey-text text-darken-1">
                  <i class="material-icons right">delete</i>
                </a>
              </td>
            </tr>';
    }
    echo '</tbody></table>';
    echo '
      <ul class="pagination center">
        <li class="';
    if($pageno <= 1){ echo 'disabled'; } else { 'waves-effect'; }
    echo '"><a href="';
    if($pageno <= 1){ echo '#'; } else { echo "?page=".($pageno - 1); }
    echo '"><i class="material-icons">chevron_left</i></a></li>';
    echo '<li class="active"><a href="#">'.$pageno.'</a></li>';

    echo '<li class="';
    if($pageno >= $total_pages){ echo ' disabled'; } else { 'waves-effect'; }
    echo '"><a href="'; 
    if($pageno >= $total_pages){ echo '#'; } else { echo "?page=".($pageno + 1);}
    echo '"><i class="material-icons">chevron_right</i></a></li></ul>';
  }

  public function add() {
    if(!empty($this->key)
      && !empty($this->name)
      && !empty($this->hours_theory)
      && !empty($this->hours_practice)
      && !empty($this->credits)
      && !empty($this->id_internal_subject)
      && !empty($this->id_specialty)) {

      return $this->conn->query("INSERT INTO materias VALUES 
        (NULL, '".$this->key."' , '".$this->name."', '".$this->hours_theory."',
         '".$this->hours_practice."', '".$this->credits."', '".$this->id_internal_subject."', 
         '".$this->id_specialty."')");
    }
    return false;
  }

  public function update(){
    if(!empty($this->id)) {
      return $this->conn->query("UPDATE materias 
                                SET clave = '".$this->key."',
                                    nombreMateria = '".$this->name."',
                                    hrsTeoria = '".$this->hours_theory."', 
                                    hrsPractica = '".$this->hours_practice."', 
                                    creditos = '".$this->credits."', 
                                    idMateriaInterna = '".$this->id_internal_subject."', 
                                    idEspecialidad = '".$this->id_specialty."' 
                                WHERE idMateria = ".$this->id);
    }
    return false;
  }

  public function delete() {
    if(!empty($this->id)) {
      return $this->conn->query("DELETE FROM materias WHERE idMateria = ".$this->id);
    }
    return false;
  }

  public function setID($id) {
    $this->id = $this->conn->real_escape_string($id);
  }

  public function setKey($key) {
    $this->key = $this->conn->real_escape_string($key);
  }

  public function setName($name) {
    $this->name = $this->conn->real_escape_string($name);
  }

  public function setHours_theory($hours_theory) {
    $this->hours_theory = $this->conn->real_escape_string($hours_theory);
  }
  
  public function setHours_practice($hours_practice) {
    $this->hours_practice = $this->conn->real_escape_string($hours_practice);
  }

  public function setCredits($credits) {
    $this->credits = $this->conn->real_escape_string($credits);
  }

  public function setInternal_subject($id_internal_subject) {
    $this->id_internal_subject = $this->conn->real_escape_string($id_internal_subject);
  }

  public function setSpecialty($id_specialty) {
    $this->id_specialty = $this->conn->real_escape_string($id_specialty);
  }
}
?>