<?php
require_once 'app/models/mdlUsuarios.php';
$user = new mdlUsuarios();
if (!$user::auth() || !$user::isAdmin()) {
    header('Location: ../');
}
?>
<section class="home-section">
  <div class="text">Dashboard2</div>
</section>
