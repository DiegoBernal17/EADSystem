<?php
$settings['logged'] = true;
$settings['page_id'] = 'home';
$settings['title'] = 'Inicio';
require 'components/header.php';
require 'components/menu.php';
?>

<div class="container">
  <div class="row">
      <div class="col s1 l2"></div>
      <div class="col s10 l8">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Bienvenido <?php echo NAME; ?></span>
            <p>Selecciona una opción del menú para continuar.</p>
          </div>
        </div>
      </div>
      <div class="s1 l2"></div>
  </div>
  <div class="row">
      <div class="col s1 l2"></div>
      <div class="col s10 l8">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Información</span>
            <p>Semestre actual: <?php echo $Conn->getNameSemester(); ?></p>
            <p>Bimestre actual: <?php echo $Conn->getBimester(); ?></p>
          </div>
        </div>
      </div>
      <div class="s1 l2"></div>
  </div>
</div>
<?php
require 'components/footer.php';
?>