<?php
  $page_title = 'Asignar Prioridad';
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
  page_require_level(3);
  $incidencia = find_incidencia_by_id((int)$_GET['id']);
 
?>
<?php
 if(isset($_POST['asigna_prioridad'])){
   $req_fields = array('prioridad');
   validate_fields($req_fields);
   if(empty($errors)){
     $prioridad  = remove_junk($db->escape($_POST['prioridad']));
    
    
// Por defecto el estado de la incidencia es: Generado (0)
     
    
     $query  = "UPDATE incidencia SET ";
     $query .="prioridad='{$prioridad}'";
     $query .=" WHERE id='{$db->escape($incidencia['id'])}'";
     $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
      
       $session->msg('s',"Prioridad Asignada con éxito. ");
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
            <span>Prioridad de Inicidencia</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="asigna_prioridad.php?id=<?php echo (int)$incidencia['id'];?>" class="clearfix">



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
                  <select class="form-control" name="prioridad">
                  <option <?php if($incidencia['prioridad'] === '0') echo 'selected="selected"';?>value="0">NINGUNA</option>
                  <option <?php if($incidencia['prioridad'] === '1') echo 'selected="selected"';?>value="1">BAJA</option>
                  <option <?php if($incidencia['prioridad'] === '2') echo 'selected="selected"';?>value="2">MEDIA</option>
                  <option <?php if($incidencia['prioridad'] === '3') echo 'selected="selected"';?>value="3">ALTA</option>
                 

                  
                </select>
               </div>
              </div>
           
              
              <button type="submit" name="asigna_prioridad" class="btn btn-danger">Asigna Prioridad</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>


