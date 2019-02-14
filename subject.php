<?php
$settings['logged'] = true;
$settings['page_id'] = 'subject';
if(isset($_GET['edit'])) {
  $settings['title'] = 'Editar materia';
} else {
  $settings['title'] = 'Agregar materia';
}
require 'components/header.php';
require 'components/menu.php';

if(isset($_GET['edit'])) {
  $Subject->setID($_GET['edit']);
  $Subject->get();
}

$sqlSpeacilty = $Conn->query("SELECT * FROM especialidad");

$msg = "";
if(isset($_POST['name'])) {
  $Subject->setKey($_POST['key']);
  $Subject->setName($_POST['name']);
  $Subject->setHours_theory($_POST['hours_theory']);
  $Subject->setHours_practice($_POST['hours_practice']);
  $Subject->setCredits($_POST['credits']);
  $Subject->setInternal_subject($_POST['internal_subject']);
  $Subject->setSpecialty($_POST['specialty']);

  if(isset($_GET['edit'])) {
    if($Subject->update()) {
      $msg = '<div class="notif green">Se ha modificado la materia</div>';
    } else {
      $msg = '<div class="notif red">Error al modificar la materia</div>';
    }
  } else {
    if($Subject->add()) {
      $msg = '<div class="notif green">Se ha agreagado la materia</div>';
    } else {
      $msg = '<div class="notif red">Error al agregar la materia</div>';
    }
  }
}
?>
<div class="container">
  <div class="row">
      <div class="col s1 l2"></div>
      <div class="col s10 l8">
        <div class="card">
          <div class="card-content">
            <b style="font-size: 2rem;">Materias</b>
            <div class="divider"></div>
            <?php echo $msg; ?>
            <form method="POST" action="#" lass="col s12">
              <div class="row">
                <div class="input-field col s6">
                  <input id="key" type="text" class="validate" name="key" value="<?php echo $Subject->key ?>" required>
                  <label for="key">Clave</label>
                </div>
                <div class="input-field col s12">
                  <input id="name" type="text" class="validate" name="name" value="<?php echo $Subject->name ?>" required>
                  <label for="name">Nombre de la materia</label>
                </div>
                <div class="input-field col s6">
                  <input id="hours_theory" type="number" class="validate" name="hours_theory" value="<?php echo $Subject->hours_theory ?>" required>
                  <label for="hours_theory">Horas teoría</label>
                </div>
                <div class="input-field col s6">
                  <input id="hours_practice" type="text" class="number" name="hours_practice" value="<?php echo $Subject->hours_practice ?>" required>
                  <label for="hours_practice">Horas práctica</label>
                </div>
                <div class="input-field col s6">
                  <input id="credits" type="number" class="validate" name="credits" value="<?php echo $Subject->credits ?>" required>
                  <label for="credits">Créditos</label>
                </div>
                <div class="input-field col s6">
                  <input id="internal_subject" type="text" class="number" name="internal_subject" value="<?php echo $Subject->id_internal_subject ?>" required>
                  <label for="internal_subject">ID interno materia</label>
                </div>
                <div class="input-field col s12">
                  <select name="specialty">
                    <option value="" disabled selected></option>
                    <?php while($specialty = $sqlSpeacilty->fetch_array()) {
                      echo '<option value="'.$specialty['idEspecialidad'].'" ';
                      if($specialty['idEspecialidad'] == $Subject->id_specialty) { echo 'selected'; }
                      echo '>'.$specialty['especialidad'].'</option>';
                    } ?>
                  </select>
                  <label>Especialidad</label>
                </div>
              </div>
              <div class="row">
              
              <a class="btn blue lighten-1" href="<?php echo URL; ?>subjects.php">Regresar</a>
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
