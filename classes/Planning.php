<?php
class Planning {
  private $conn;
  public $id;
  public $year;
  public $semester;
  public $bimester;
  public $teacher;
  public $subject;
  public $section;
  public $hour;
  public $classroom;

  public function __construct(){
    global $Conn;
    $this->conn = $Conn;
  }

  public function get() {
    if(!empty($this->id)) {
      $result = $this->conn->query("SELECT * FROM planeacionsemestral WHERE idCarga = '".$this->id."'");
      $data = $result->fetch_array();
      $this->year = $data['anio'];
      $this->semester = $data['semestre'];
      $this->bimester = $data['bimestre'];
      $this->teacher = $data['idMaestro'];
      $this->subject = $data['idMateria'];
      $this->section = $data['seccion'];
      $this->hour = $data['hora'];
      $this->classroom = $data['salon'];
    }
  }

  public function getOne() {
    if(!empty($this->id)) {
      $result = $this->conn->query("SELECT * FROM planeacionsemestral WHERE idCarga = '".$this->id."'");
      return $result->fetch_array();
    }
  }

  public function showAll($pageno) {
    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page;
    $count = $this->conn->query("SELECT COUNT(*) FROM planeacionsemestral");
    $total_rows = $count->fetch_array()[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $result = $this->conn->query("SELECT p.*, m.maestroNombre, mt.nombreMateria
                                  FROM planeacionsemestral p
                                  INNER JOIN maestro m ON m.idMaestro = p.idMaestro
                                  INNER JOIN materias mt ON mt.idMateria = p.idMateria
                                  WHERE anio = '".date('Y')."'
                                  LIMIT $offset, $no_of_records_per_page");
    echo '<table class="striped responsive-table">
            <thead>
              <tr>
                <th>Año</th>
                <th>Sem.</th>
                <th>Bim.</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Hora</th>
                <th>Salón</th>
              </tr>
            </thead>
            <tbody>';
    while($row = $result->fetch_assoc()) {
      echo '<tr>
              <td>'.$row['anio'].'</td>
              <td>'.$row['semestre'].'</td>
              <td>'.$row['bimestre'].'</td>
              <td>'.$row['maestroNombre'].'</td>
              <td>'.$row['nombreMateria'].'</td>
              <td>'.substr($row['hora'], 0, -3).'</td>
              <td>'.$row['salon'].'</td>
              <td>
                <a href="'.URL.'planning.php?edit='.$row['idCarga'].'" class="grey-text text-darken-1">
                  <i class="material-icons right">edit</i>
                </a>
                <a href="#" onclick="deleteItem(4, '.$row['idCarga'].')" class="grey-text text-darken-1">
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

  private function generateSection() {
    $result = $this->conn->query("SELECT COUNT(*) 
                                  FROM planeacionsemestral 
                                  WHERE anio = '".$this->year."' 
                                  AND semestre = '$this->semester' 
                                  AND idMateria = '".$this->subject."'");
    $count = $result->fetch_array()[0];
    $this->section = chr(65+$count);
  }
  
  private function generateHour($count = 0) {
    if($count >= 80)
      return '<div class="notif red">El maestro ya no tiene 2 horas libres este semestre</div>';

    $hour = rand(7,20).':00';
    if($this->availableHour($hour)){
      $this->hour = $hour;
      return "";
    } else {
      return $this->generateHour(++$count);
    }
  }

  private function generateClassroom($count = 0) {
    if($count >= 300)
    return '<div class="notif red">Todos los salones ocupados a esa hora o haz tenido mala suerte.</div>';

    $classroom = "EAD".rand(1,50);
    if($this->availableClassroom($classroom)){
      $this->classroom = $classroom;
      return "";
    } else {
      return $this->generateClassroom(++$count);
    }
  }

  public function availableHour($hour = "") {
    if(empty($hour)) {
      $hour = $this->hour;
    }
    $start_hour = date('H:i', strtotime($hour.' - 1 hour'));
    $finish_hour = date('H:i', strtotime($hour.' + 1 hour'));
    $result = $this->conn->query("SELECT COUNT(*)
                                  FROM planeacionsemestral
                                  WHERE idMaestro = '".$this->teacher."'
                                  AND semestre = '".$this->semester."' AND
                                  hora BETWEEN CAST('".$start_hour."' AS TIME) AND CAST('".$finish_hour."' AS TIME)");
    $count = $result->fetch_array();
    return ($count[0] == 0);
  }

  public function availableClassroom($classroom = "") {
    if(empty($classroom)) {
      $classroom = $this->classroom;
    }
    $start_hour = date('H:i', strtotime($this->hour.' - 1 hour'));
    $finish_hour = date('H:i', strtotime($this->hour.' + 1 hour'));
    $result = $this->conn->query("SELECT COUNT(*) 
                                  FROM planeacionsemestral 
                                  WHERE salon = '".$classroom."'
                                  AND semestre = '".$this->semester."' AND
                                  hora BETWEEN CAST('".$start_hour."' AS TIME) AND CAST('".$finish_hour."' AS TIME)");
    $count = $result->fetch_array()[0];
    return ($count == 0);
  }

  public function add() {
    if(!empty($this->year)
      && !empty($this->semester)
      && !empty($this->bimester)
      && !empty($this->teacher)
      && !empty($this->subject)) {
      if(empty($this->hour)) {
        $msg = $this->generateHour();
        if(!empty($msg)) {
          return $msg;
        }
      } else {
        if(!$this->availableHour()) {
          return '<div class="notif red">El maestro no puede dar clase a esa hora</div>';
        }
      }
      if(empty($this->classroom)){
        $msg = $this->generateClassroom();
        if(!empty($msg)) {
          return $msg;
        }
      } else {
        if(!$this->availableClassroom()) {
          return '<div class="notif red">El salón no se encuentra disponible</div>';
        }
      }
      $this->generateSection();

      if($this->conn->query("INSERT INTO planeacionsemestral VALUES 
        (NULL, '".$this->year."' , '".$this->semester."', '".$this->bimester."',
         '".$this->teacher."', '".$this->subject."', '".$this->section."',
         '".$this->hour."', '".$this->classroom."')"))
         {
           return '<div class="notif green">Se ha agreagado la planificación</div>';
         }
    }
    return '<div class="notif red"></div>';
  }

  public function update(){
    $planning = $this->getOne();
    if($planning['hora'] != $this->hour) {
      if(!$this->availableHour()) {
        return '<div class="notif red">El maestro no puede dar clase a esa hora</div>';
      }
    }

    if($planning['salon'] != $this->classroom) {
      if(!$this->availableClassroom()) {
        return '<div class="notif red">El salón no se encuentra disponible</div>';
      }
    }
    
    if($this->conn->query("UPDATE planeacionsemestral 
                          SET anio = '".$this->year."',
                          semestre = '".$this->semester."',
                          bimestre = '".$this->bimester."',
                          idMaestro = '".$this->teacher."',
                          idMateria = '".$this->subject."',
                          seccion = '".$this->section."',
                          hora = '".$this->hour."',
                          salon = '".$this->classroom."'
                          WHERE idCarga = ".$this->id))
    {
      return '<div class="notif green">Se ha modificado la planificación</div>';
    }
    return '<div class="notif red">Error al modificar la planificación</div>';
  }

  public function delete() {
    if(!empty($this->id)) {
      return $this->conn->query("DELETE FROM planeacionsemestral WHERE idCarga = ".$this->id);
    }
    return false;
  }

  public function setID($id) {
    $this->id = $this->conn->real_escape_string($id);
  }

  public function setYear($year) {
    $this->year = $this->conn->real_escape_string($year);
  }

  public function setSemester($semester) {
    $this->semester = $this->conn->real_escape_string($semester);
  }

  public function setBimester($bimester) {
    $this->bimester = $this->conn->real_escape_string($bimester);
  }

  public function setTeacher($teacher) {
    $this->teacher = $this->conn->real_escape_string($teacher);
  }

  public function setSubject($subject) {
    $this->subject = $this->conn->real_escape_string($subject);
  }

  public function setSection($section) {
    $this->section = $this->conn->real_escape_string($section);
  }

  public function setHour($hour) {
    $this->hour = $this->conn->real_escape_string($hour);
  }

  public function setClassroom($classroom) {
    $this->classroom = $this->conn->real_escape_string($classroom);
  }
}
?>