<?php
$settings['logged'] = true;
$settings['page_id'] = 'teacher';
if(isset($_GET['edit'])) {
  $settings['title'] = 'Editar Maestro';
} else {
  $settings['title'] = 'Agregar Maestro';
}
require 'components/header.php';
require 'components/menu.php';

if(isset($_GET['edit'])) {
  $Teacher->setID($_GET['edit']);
  $Teacher->get();
}

$msg = "";
if(isset($_POST['teacher'])) {
  $Teacher->setName($_POST['teacher']);

  if(isset($_GET['edit'])) {
    if($Teacher->update()) {
      $msg = '<div class="notif green">Se ha modificado el maestro</div>';
    } else {
      $msg = '<div class="notif red">Error al modificar el maestro</div>';
    }
  } else {
    if($Teacher->add()) {
      $msg = '<div class="notif green">Se ha agreagado el maestro</div>';
    } else {
      $msg = '<div class="notif red">Error al agregar el maestro</div>';
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
            <b style="font-size: 2rem;">Maestros</b><hr>
            <?php echo $msg; ?>
            <form method="POST" action="#">
              <div class="input-field">
                <input id="teacher" type="text" class="validate" name="teacher" value="<?php echo $Teacher->name ?>" required>
                <label for="teacher">Nombre del maestro</label>
              </div>
              <a class="btn blue lighten-1" href="<?php echo URL; ?>teachers.php">Regresar</a>
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