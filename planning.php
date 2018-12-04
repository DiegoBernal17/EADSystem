<?php
$settings['logged'] = true;
$settings['page_id'] = 'planning';
if(isset($_GET['edit'])) {
  $settings['title'] = 'Editar planificación';
} else {
  $settings['title'] = 'Agregar planificación';
}
require 'components/header.php';
require 'components/menu.php';

if(isset($_GET['edit'])) {
  $Planning->setID($_GET['edit']);
  $Planning->get();
} else {
  $Planning->year = date('Y');
  $Planning->semester = $Conn->getSemester();
  $Planning->bimester = $Conn->getBimester();
}

$sqlTeachers = $Conn->query("SELECT * FROM maestro");
$sqlSubjects = $Conn->query("SELECT * FROM materias");

$msg = "";
if(isset($_POST['action'])) {
  $Planning->setYear($_POST['year']);
  $Planning->setSemester($_POST['semester']);
  $Planning->setBimester($_POST['bimester']);
  $Planning->setTeacher($_POST['teacher']);
  $Planning->setSubject($_POST['subject']);
  $hour = substr($_POST['hour'].':00', 0, 8);
  $Planning->setHour($hour);
  $Planning->setClassroom($_POST['classroom']);

  if(isset($_GET['edit'])) {
    $msg = $Planning->update();
  } else {
    $msg = $Planning->add();
  }
}
?>
<div class="container">
  <div class="row">
      <div class="col s1 l2"></div>
      <div class="col s10 l8">
        <div class="card">
          <div class="card-content">
            <b style="font-size: 2rem;">Planificación</b>
            <div class="divider"></div>
            <?php echo $msg; ?>
            <form method="POST" action="#" lass="col s12">
              <div class="row">
                <div class="input-field col s4">
                  <input id="year" type="number" class="validate" name="year" value="<?php echo $Planning->year ?>" min="2010" max="2030" required>
                  <label for="year">Año</label>
                </div>
                <div class="input-field col s6 m5">
                  <select name="semester">
                    <?php 
                    $selected1 = "";
                    $selected2 = "";
                    if($Conn->getSemester() == 1 || $Planning->semester == 1) {
                      $selected1 = "selected";
                    } else {
                      $selected2 = "selected";
                    } ?>
                    <option value="1" <?php echo $selected1; ?>><?php echo $Conn->getNameSemester(1); ?></option>
                    <option value="2" <?php echo $selected2; ?>><?php echo $Conn->getNameSemester(2); ?></option>
                  </select>
                  <label>Semestre</label>
                </div>
                <div class="input-field col s2 m3">
                  <select name="bimester">
                    <?php 
                    $selected1 = "";
                    $selected2 = "";
                    if($Conn->getBimester() == 1 || $Planning->bimester == 1) {
                      $selected1 = "selected";
                    } else {
                      $selected2 = "selected";
                    } ?>
                    <option value="1" <?php echo $selected1; ?>>1</option>
                    <option value="2" <?php echo $selected2; ?>>2</option>
                  </select>
                  <label>Bimestre</label>
                </div>
                <div class="input-field col s12">
                  <select name="teacher" class="validate" required>
                    <option value="" disabled selected></option>
                    <?php while($teacher = $sqlTeachers->fetch_array()) {
                      echo '<option value="'.$teacher['idMaestro'].'" ';
                      if($teacher['idMaestro'] == $Planning->teacher) { echo 'selected'; }
                      echo '>'.$teacher['maestroNombre'].'</option>';
                    } ?>
                  </select>
                  <label>Maestro</label>
                </div>
                <div class="input-field col s12">
                  <select name="subject" class="validate" required>
                    <option value="" disabled selected></option>
                    <?php while($subject = $sqlSubjects->fetch_array()) {
                      echo '<option value="'.$subject['idMateria'].'" ';
                      if($subject['idMateria'] == $Planning->subject) { echo 'selected'; }
                      echo '>'.$subject['nombreMateria'].'</option>';
                    } ?>
                  </select>
                  <label>Materia</label>
                </div>
                <div class="col s12">
                  <p>Deja uno o los dos campos de abajo en blanco y se asignarán aleatoriamente</p>
                </div>
                <div class="input-field col s6">
                  <input type="time" id="hour" class="validate" name="hour" step="3600" min="07:00" max="20:00" value="<?php echo $Planning->hour; ?>">
                  <label for="hour">Hora</label>
                </div>
                <div class="input-field col s6">
                  <select name="classroom">
                    <option value="" selected></option>
                    <?php for($i=1; $i<=50; $i++) {
                      echo '<option value="EAD'.$i.'" ';
                      if($Planning->classroom == "EAD".$i) { echo 'selected'; }
                      echo '>EAD'.$i.'</option>';
                    } ?>
                  </select>
                  <label>Salón</label>
                </div>
              </div>
              <div class="row">
                <a class="btn blue lighten-1" href="<?php echo URL; ?>plans.php">Regresar</a>
                <button class="btn waves-effect waves-light" type="submit" name="action">
                  <?php echo $settings['title']; ?>
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="s1 l2"></div>
  </div>
</div>
<?php
require 'components/footer.php';
?>