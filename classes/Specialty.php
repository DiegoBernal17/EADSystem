<?php
class Specialty {
  private $conn;
  public $id;
  public $name;

  public function __construct(){
    global $Conn;
    $this->conn = $Conn;
  }

  public function get() {
    if(!empty($this->id)) {
      $result = $this->conn->query("SELECT especialidad FROM especialidad WHERE idEspecialidad = '".$this->id."'");
      $data = $result->fetch_array();
      $this->name = $data['especialidad'];
    }
  }

  public function getOne() {
    if(!empty($this->id)) {
      $result = $this->conn->query("SELECT * FROM especialidad WHERE idEspecialidad = '".$this->id."'");
      return $result->fetch_array();
    }
  }

  public function showAll($pageno) {
    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page;
    $count = $this->conn->query("SELECT COUNT(*) FROM especialidad");
    $total_rows = $count->fetch_array()[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $result = $this->conn->query("SELECT * FROM especialidad LIMIT $offset, $no_of_records_per_page");
    echo '<table class="striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody>';
    while($row = $result->fetch_assoc()) {
      echo '<tr>
              <td>'.$row['idEspecialidad'].'</td>
              <td>'.$row['especialidad'].'</td>
              <td>
                <a href="'.URL.'specialty.php?edit='.$row['idEspecialidad'].'" class="grey-text text-darken-1">
                  <i class="material-icons right">edit</i>
                </a>
                <a href="#" onclick="deleteItem(1, '.$row['idEspecialidad'].')" class="grey-text text-darken-1">
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
    if(!empty($this->name)) {
      return $this->conn->query("INSERT INTO especialidad VALUES (NULL, '".$this->name."')");
    }
    return false;
  }

  public function update(){
    if(!empty($this->id)) {
      return $this->conn->query("UPDATE especialidad SET especialidad = '".$this->name."' WHERE idEspecialidad = ".$this->id);
    }
    return false;
  }

  public function delete() {
    if(!empty($this->id)) {
      return $this->conn->query("DELETE FROM especialidad WHERE idEspecialidad = ".$this->id);
    }
    return false;
  }

  public function setID($id) {
    $this->id = $this->conn->real_escape_string($id);
  }

  public function setName($name) {
    $this->name = $this->conn->real_escape_string($name);
  }
}
?>