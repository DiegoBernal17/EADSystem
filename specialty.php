<?php
$settings['logged'] = true;
$settings['page_id'] = 'specialty';
if(isset($_GET['edit'])) {
  $settings['title'] = 'Editar especialidad';
} else {
  $settings['title'] = 'Agregar especialidad';
}
require 'components/header.php';
require 'components/menu.php';

if(isset($_GET['edit'])) {
  $Specialty->setID($_GET['edit']);
  $Specialty->get();
}

$msg = "";
if(isset($_POST['specialty'])) {
  $Specialty->setName($_POST['specialty']);

  if(isset($_GET['edit'])) {
    if($Specialty->update()) {
      $msg = '<div class="notif green">Se ha modificado la especialidad</div>';
    } else {
      $msg = '<div class="notif red">Error al modificar la especialidad</div>';
    }
  } else {
    if($Specialty->add()) {
      $msg = '<div class="notif green">Se ha agreagado la especialidad</div>';
    } else {
      $msg = '<div class="notif red">Error al agregar la especialidad</div>';
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
            <b style="font-size: 2rem;">Especialidades</b><hr>
            <?php echo $msg; ?>
            <form method="POST" action="#">
              <div class="input-field">
                <input id="specialty" type="text" class="validate" name="specialty" value="<?php echo $Specialty->name ?>" required>
                <label for="specialty">Nombre de la especialidad</label>
              </div>
              <a class="btn blue lighten-1" href="<?php echo URL; ?>specialties.php">Regresar</a>
              <button class="btn waves-effect waves-light" type="submit" name="action">
                <?php echo $settings['title']; ?>
                <i class="material-icons right">send</i>
              </button>
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