<?php
$settings['logged'] = false;
$settings['page_id'] = 'register';
$settings['title'] = 'Regístrate';
require 'components/header.php';
?>
  <div class="center">
    <div class="boxLogin">
      <h1>Registro</h1>
      <div class="error">
        <?php 
        if(isset($_SESSION['error'])) {
          echo $_SESSION['error'];
          unset($_SESSION['error']);
        } ?>
      </div>
      <form method="POST" action="actions/register.php">
        <input type="text" name="name" placeholder="Nombre y Apellido" required>
        <input type="text" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <input type="password" name="repassword" placeholder="Confirmar contraseña" required>
        <input type="submit" value="REGISTRARSE">
      </form>
      <a href="index.php">Regresar</a>
    </div>
  </div>
</body>
</html>