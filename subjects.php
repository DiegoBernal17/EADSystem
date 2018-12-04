<?php
$settings['logged'] = true;
$settings['page_id'] = 'subjects';
$settings['title'] = 'Materias';
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
      <div class="col s1"></div>
      <div class="col s12 m10">
        <div class="card">
          <div class="card-content">
            <b style="font-size: 2rem;">Materias</b>
            <a href="<?php echo URL ?>subject.php" class="btn right green">
              <span class="hide-on-small-only">Nueva materia</span>
              <i class="material-icons right">add</i>
            </a>
            <div class="divider"></div>
            <?php $Subject->showAll($pageno); ?>
          </div>
        </div>
      </div>
      <div class="col s1"></div>
  </div>
</div>
<?php
require 'components/footer.php';
?>