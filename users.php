<?php
$settings['logged'] = true;
$settings['page_id'] = 'users';
$settings['title'] = 'Usuarios';
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
            <b style="font-size: 2rem;">Usuarios</b>
            <div class="divider"></div>
            <?php $User->showAll($pageno); ?>
          </div>
        </div>
      </div>
      <div class="s1 l2"></div>
  </div>
</div>
<?php
require 'components/footer.php';
?>