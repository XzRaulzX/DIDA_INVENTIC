<?php
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(0);
?>
<?php
  $delete_id = delete_by_inventario('inventario',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Registro de Inventario eliminado");
      redirect('inventario.php');
  } else {
      $session->msg("d","Error eliminando Registro de Inventario");
      redirect('inventario.php');
  }
?>