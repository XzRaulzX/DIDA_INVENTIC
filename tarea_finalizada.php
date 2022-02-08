<?php
 
  require_once('includes/load.php');
 // Validación de permiso de acceso a la página
  page_require_level(3);
  $orden_trabajo = find_by_id('orden_trabajo',(int)$_GET['id']);
 
   
// Por defecto el estado de la incidencia es: Generado (0)
     
    
    $fecha_fin=make_date();
   
// Por defecto el estado de la incidencia es: Generado (0)
     
    
     $query  = "UPDATE orden_trabajo SET ";
     $query .="estado=2,";
     $query .="fecha_fin='{$fecha_fin}'";
     $query .=" WHERE id='{$db->escape($orden_trabajo['id'])}'";
     $result = $db->query($query);
     if($result && $db->affected_rows() === 1){
      
      $session->msg('s',"Estado Asignado con éxito. ");
      redirect('tarea.php?id='.(int)$orden_trabajo['id'], false);
      
        } 
      else {
      
       $session->msg('d',' Lo siento, Asignación fallida.');
      redirect('tarea.php?id='.(int)$orden_trabajo['id'], false);
       }
    
?>
