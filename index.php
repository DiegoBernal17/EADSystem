<?php
$settings['logged'] = false;
$settings['page_id'] = 'index';
$settings['title'] = 'Inicia sesión';
require 'components/header.php';
?>
  <div class="center">
    <div class="boxLogin">
      <h1>Bienvenido</h1>
      <div class="error">
        <?php 
        if(isset($_SESSION['error'])) {
          echo $_SESSION['error'];
          unset($_SESSION['error']);
        } ?>
      </div>
      <form method="POST" action="actions/login.php">
        <input type="text" name="email" placeholder="Correo" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <input type="submit" value="INGRESAR">
      </form>
      <a href="register.php">Regístrate aquí</a>
    </div>
  </div>
</body>
</html>