<?php
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(0);
?>
<?php
$registro=(int)$_GET['id'];
if ($registro <>1)
{
      $delete_id = delete_by_tipo_memoria('tipo_memoria',(int)$_GET['id']);
      $session->msg("s","Borrao. No es posible eliminarlo.");
      if($delete_id){
          $session->msg("s","Tipo de Memoria eliminada con éxito");
          redirect('administrar_memorias.php');
      } else {
          $session->msg("d","Error eliminando Tipo de Memoria");
          redirect('administrar_memorias.php');
      }
}
else
{
  $session->msg("d","Registro Obligatorio. No es posible eliminarlo.");
  redirect('administrar_memorias.php');
}
?>