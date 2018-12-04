<?php
class Teacher {
  private $conn;
  public $id;
  public $name;

  public function __construct(){
    global $Conn;
    $this->conn = $Conn;
  }

  public function get() {
    if(!empty($this->id)) {
      $result = $this->conn->query("SELECT maestroNombre FROM maestro WHERE idMaestro = '".$this->id."'");
      $data = $result->fetch_array();
      $this->name = $data['maestroNombre'];
    }
  }

  public function getOne() {
    if(!empty($this->id)) {
      $result = $this->conn->query("SELECT * FROM maestro WHERE idMaestro = '".$this->id."'");
      return $result->fetch_array();
    }
  }

  public function showAll($pageno) {
    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page;
    $count = $this->conn->query("SELECT COUNT(*) FROM maestro");
    $total_rows = $count->fetch_array()[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $result = $this->conn->query("SELECT * FROM maestro LIMIT $offset, $no_of_records_per_page");
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
              <td>'.$row['idMaestro'].'</td>
              <td>'.$row['maestroNombre'].'</td>
              <td>
                <a href="'.URL.'teacher.php?edit='.$row['idMaestro'].'" class="grey-text text-darken-1">
                  <i class="material-icons right">edit</i>
                </a>
                <a href="#" onclick="deleteItem(2, '.$row['idMaestro'].')" class="grey-text text-darken-1">
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
      $this->conn->query("INSERT INTO maestro VALUES (NULL, '".$this->name."')");
      return true;
    }
    return false;
  }

  public function update(){
    if(!empty($this->id)) {
      return $this->conn->query("UPDATE maestro SET maestroNombre = '".$this->name."' WHERE idMaestro = ".$this->id);
    }
    return false;
  }

  public function delete() {
    if(!empty($this->id)) {
      return $this->conn->query("DELETE FROM maestro WHERE idMaestro = ".$this->id);
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