<?php
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(0);
?>
<?php
  $delete_id = delete_by_id('grupos_usuario',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Grupo eliminado");
      redirect('grupos_usuario.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('grupos_usuario.php');
  }
?>
