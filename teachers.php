<?php
$settings['logged'] = true;
$settings['page_id'] = 'teachers';
$settings['title'] = 'Maestros';
require 'components/header.php';
require 'components/menu.php';

if (isset($_GET['page'])) {
  $pageno = $_GET['page'];
} else {
  $pageno = 1;
}
?>
<div class="container">
  <div class="row">
      <div class="col s1 l2"></div>
      <div class="col s10 l8">
        <div class="card">
          <div class="card-content">
            <b style="font-size: 2rem;">Maestros</b>
            <a href="<?php echo URL ?>teacher.php" class="btn right green">
              <span class="hide-on-small-only">Nuevo maestro</span>
              <i class="material-icons right">add</i>
            </a>
            <div class="divider"></div>
            <?php $Teacher->showAll($pageno); ?>
          </div>
        </div>
      </div>
      <div class="s1 l2"></div>
  </div>
</div>
<?php
require 'components/footer.php';
?>