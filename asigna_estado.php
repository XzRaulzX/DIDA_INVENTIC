<?php
  $page_title = 'Asignar Prioridad';
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
  page_require_level(3);
  $incidencia = find_incidencia_by_id((int)$_GET['id']);
 
?>
<?php
 if(isset($_POST['asigna_estado'])){
   $req_fields = array('estado');
   validate_fields($req_fields);
   if(empty($errors)){
     $estado  = remove_junk($db->escape($_POST['estado']));
    
    
// Por defecto el estado de la incidencia es: Generado (0)
     
    
     $query  = "UPDATE incidencia SET ";
     $query .="estado='{$estado}'";
     $query .=" WHERE id='{$db->escape($incidencia['id'])}'";
     $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
             //ENVÍA CORREO AL PROFESOR QUE HA GENERADO LA INCIDENCIA.
          if ($estado==5)   
          $id = $incidencia['id_usuario'];
          $id_incidencia = $incidencia['id'];
          $salida = find_by_id('usuarios',$id);
          $tareaso = busca_tareas_id($id_incidencia);
                     $correo = $salida['correo'];
                     $asunto="INCIDENCIA FINALIZADA";
                     $cuerpo = "La incidencia con descripción " . "<b>" . $incidencia['descripcion'] . "</b>";
                     $cuerpo = $cuerpo. " ha sido finalizada." . "<br>";
                     $cuerpo = $cuerpo . "-----------------------------------------------------------------------" . "<br>";
                     $cuerpo= $cuerpo . "Las tareas que se ha llevado acabo han sido:  ";
                     while($fila = $tareaso->fetch_assoc())
                     {
                      $cuerpo = $cuerpo .  $fila['descripcion'] . " ,";
                     }
                     $cuerpo = substr($cuerpo, 0, -3);
                     $cuerpo = $cuerpo . ".";
                     Envia_Correo_Simple($correo,$asunto,$cuerpo);
      
       $session->msg('s',"Estado Asignado con éxito.");
      redirect('incidencia.php?id='.(int)$incidencia['id'], false);
      
     } else {
      
       $session->msg('d',' Lo siento, Asignación fallida.');
      
    redirect('incidencia.php?id='.(int)$incidencia['id'], false);
     }
    
    


   } else{
    
     $session->msg("d", $errors);
redirect('incidencia.php?id='.(int)$incidencia['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <span>Estado de la Inicidencia</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="asigna_estado.php?id=<?php echo (int)$incidencia['id'];?>" class="clearfix">



              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-tag"></i>
                     </span>

                    <input type="text" class="form-control" name="codigo_incidencia"  value="<?php echo remove_junk($incidencia['tipo_incidencia']);?>" disabled>
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-map-marker"></i>
                     </span>

                         <input type="text" class="form-control" name="area"  value="<?php echo remove_junk($incidencia['area']);?>" disabled>

                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                      </span>


                            <input type="text" class="form-control" name="fecha_incidencia"  value="<?php echo remove_junk($incidencia['fecha_incidencia']);?>" disabled>


                   </div>
                  </div>
               </div>
              </div>





              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="descripcion" value="<?php echo remove_junk($incidencia['descripcion']);?>" disabled>
               </div>
              </div>



              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-signal"></i>
                  </span>
                  <select class="form-control" name="estado">
                  <option <?php if($incidencia['estado'] === '0') echo 'selected="selected"';?>value="0">generada</option>
                  <option <?php if($incidencia['estado'] === '1') echo 'selected="selected"';?>value="1">en revisión</option>
                  <option <?php if($incidencia['estado'] === '2') echo 'selected="selected"';?>value="2">confirmada</option>
                  <option <?php if($incidencia['estado'] === '3') echo 'selected="selected"';?>value="3">en reparación</option>
                  <option <?php if($incidencia['estado'] === '4') echo 'selected="selected"';?>value="4">en comprobación</option>
                  <option <?php if($incidencia['estado'] === '5') echo 'selected="selected"';?>value="5">finalizada</option>
                  
                 

                  
                </select>
               </div>
              </div>
           
              
              <button type="submit" name="asigna_estado" class="btn btn-danger">Asigna Estado</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>


