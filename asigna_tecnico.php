<?php
  $page_title = 'Asignar Prioridad';
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
  page_require_level(2);
  $incidencia = find_incidencia_by_id((int)$_GET['id']);
  $tecnicos=find_all_tecnicos();
 
?>
<?php
 if(isset($_POST['asigna_tecnico'])){
   $req_fields = array('tecnico');
   validate_fields($req_fields);
   if(empty($errors)){
     $id_tecnico  = remove_junk($db->escape($_POST['tecnico']));
    
    
// Por defecto el estado de la incidencia es: Generado (0)
     
    
     $query  = "UPDATE incidencia SET ";
     $query .="id_tecnico='{$id_tecnico}'";
     $query .=" WHERE id='{$db->escape($incidencia['id'])}'";
     $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
      
       $session->msg('s',"Técnico Asignado con éxito. ");
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
            <span>Asignación de Técnico a Inicidencia</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="asigna_tecnico.php?id=<?php echo (int)$incidencia['id'];?>" class="clearfix">



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
                   <i class="glyphicon glyphicon-wrench"></i>
                  </span>
                   <select class="form-control" name="tecnico">
                      <option value="">Selecciona un Técnico</option>
                    <?php  foreach ($tecnicos as $tec): ?>
                      <option value="<?php echo (int)$tec['id'] ?>">
                        <?php echo $tec['nombre'] ?></option>
                    <?php endforeach; ?>
                    </select>
               </div>
              </div>
           
              
              <button type="submit" name="asigna_tecnico" class="btn btn-danger">Asigna Técnico</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>


