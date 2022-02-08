<?php
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(0);
?>
<?php
  $delete_id = delete_by_id('orden_trabajo',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Tipo de Incidencia eliminada");
      redirect('tarea.php');
  } else {
      $session->msg("d","Error eliminando Tipo de incidencia");
      redirect('tarea.php');
  }
?>