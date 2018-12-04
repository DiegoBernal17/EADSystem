<?php
class User {
  private $conn;
  public $id;
  public $name;
  public $email;
  public $password;

  public function __construct(){
    global $Conn;
    $this->conn = $Conn;
  }

  public function get() {
    if(!empty($this->id)) {
      $result = $this->conn->query("SELECT nombreUsuario, email FROM usuario WHERE idUsuario = '".$this->id."'");
      $data = $result->fetch_array();
      $this->name = $data['nombreUsuario'];
      $this->email = $data['email'];
    }
  }

  public function getByEmail() {
    if(!empty($this->email)) {
      $result = $this->conn->query("SELECT * FROM usuario WHERE email = '".$this->email."' LIMIT 1");
      $data = $result->fetch_array();
      $this->id = $data['idUsuario'];
      $this->name = $data['nombreUsuario'];
    }
  }

  public function getOne() {
    if(!empty($this->id)) {
      $result = $this->conn->query("SELECT * FROM usuario WHERE idUsuario = '".$this->id."'");
      return $result->fetch_array();
    }
  }

  public function getOneByEmail() {
    if(!empty($this->email)) {
      $result = $this->conn->query("SELECT * FROM usuario WHERE email = '".$this->email."' LIMIT 1");
      return $result->fetch_array();
    }
  }

  public function showAll($pageno) {
    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page;
    $count = $this->conn->query("SELECT COUNT(*) FROM usuario");
    $total_rows = $count->fetch_array()[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $result = $this->conn->query("SELECT * FROM usuario LIMIT $offset, $no_of_records_per_page");
    echo '<table class="striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
              </tr>
            </thead>
            <tbody>';
    while($row = $result->fetch_assoc()) {
      echo '<tr>
              <td>'.$row['idUsuario'].'</td>
              <td>'.$row['nombreUsuario'].'</td>
              <td>'.$row['email'].'</td>
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
    if(!empty($this->name) && !empty($this->email) && !empty($this->password)) {
      $encrypt = password_hash($this->password, PASSWORD_BCRYPT);
      $this->conn->query("INSERT INTO usuario VALUES (NULL, '".$this->name."', '".$this->email."', '".$encrypt."', NOW())");
    }
  }

  public function existEmail() {
    $result = $this->conn->query("SELECT email FROM usuario WHERE email = '{$this->email}'");
		$count = $result->num_rows;
    return ($count > 0) ;
  }

  public function passwordVerify() {
    $data = $this->getOneByEmail();
    return password_verify($this->password, $data['password']);
  }

  public function login() {
    if(empty($this->id)) {
      $this->getByEmail();
    }
    $_SESSION['USER_ID'] = $this->id;
    if(empty($this->name)) {
      $this->get();
    }
    $_SESSION['NAME'] = $this->name;
  }
}
?>