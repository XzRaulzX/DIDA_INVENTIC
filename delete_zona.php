<?php
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(0);
?>
<?php

  $delete_id = delete_by_zonas('zona',(int)$_GET['id']);
  if($delete_id){
     $session->msg("s","Zona eliminada");
      redirect('areas.php');
  } else {
     $session->msg("d","Error eliminando Zona");
  //$session->msg("d",echo ['cod_zona']);    
      redirect('areas.php');

  }
?>
