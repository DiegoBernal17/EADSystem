<?php
$settings['logged'] = true;
$settings['page_id'] = 'plans';
$settings['title'] = 'Planificación';
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
            <b style="font-size: 2rem;">Planificaciones</b>
            <div class="col s3 l2 right">
              <select name="">
                <option value="<?php echo date('Y') ?>" selected><?php echo date('Y') ?></option>
              </select>
            </div>
            <div class="divider"></div>
            <?php $Planning->showAll($pageno); ?>
          </div>
        </div>
      </div>
      <div class="col s1"></div>
  </div>
</div>
<?php
require 'components/footer.php';
?>