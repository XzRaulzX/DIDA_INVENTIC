<?php
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(0);
?>
<?php
  $delete_id = delete_by_dispositivo('dispositivo',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Dispositivo eliminado");
      redirect('administrar_dispositivo.php');
  } else {
      $session->msg("d","Error eliminando el Dispositivo");
      redirect('administrar_dispositivo.php');
  }
?>
