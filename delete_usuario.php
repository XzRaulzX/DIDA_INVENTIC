<?php
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(0);
?>
<?php
  $delete_id = delete_by_id('usuarios',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Usuario eliminado");
      redirect('usuarios.php');
  } else {
      $session->msg("d","Se ha producido un error en la eliminación del usuario");
      redirect('usuarios.php');
  }
?>
