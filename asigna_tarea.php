<?php
  $page_title = 'Agregar Incidencia';
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
  page_require_level(2);
  $incidencia = find_incidencia_by_id((int)$_GET['id']);
  

?>
<?php
 if(isset($_POST['asigna_tarea'])){
   $req_fields = array('descripcion','estado' ,'tipo_actuacion');
   validate_fields($req_fields);
   if(empty($errors)){
     $t_descripcion  = remove_junk($db->escape($_POST['descripcion']));
     $t_fecha_inicio = make_date();
     $t_estado   = remove_junk($db->escape($_POST['estado']));
     $t_tipo_actuacion   = remove_junk($db->escape($_POST['tipo_actuacion']));
     $t_id_incidencia=(int)$incidencia['id'];

    
     $query  = "INSERT INTO orden_trabajo (";
     $query .=" descripcion,fecha_inicio,estado,tipo_actuacion,id_incidencia";
     $query .=") VALUES (";
     $query .=" '{$t_descripcion}','{$t_fecha_inicio}', '{$t_estado}', '{$t_tipo_actuacion}', '{$t_id_incidencia}'";
     $query .=")";
     //$query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     
     if($db->query($query)){
      
       $session->msg('s',"Orden de Trabajo Generada con éxito. ");
       redirect('asigna_tarea.php?id='.(int)$incidencia['id'], false);
      
      
     } else {
      
       $session->msg('d',' Lo siento, registro falló.');
       redirect('asigna_tarea.php?id='.(int)$incidencia['id'], false);
      
     }
    
     

   } else{
    
     $session->msg("d", $errors);
     redirect('asigna_tarea.php?id='.(int)$incidencia['id'], false);
     

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
            <span class="glyphicon glyphicon-tasks"></span>
            <span>Crear Tarea (Orden de Trabajo)</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="asigna_tarea.php?id=<?php echo (int)$incidencia['id'];?>" class="clearfix">


          <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                    <label for="inc_descripcion">INCIDENCIA</label>
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="inc_descripcion"  value="<?php echo remove_junk($incidencia['descripcion']); ?>" disabled>
               </div>
              </div>

              <hr>



        <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                    <label for="descripcion">Orden de Trabajo</label>
                   <i class="glyphicon glyphicon-tasks"></i>
                  </span>
                 <input type="text" class="form-control" name="descripcion" placeholder="Descripción">
               </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <label for="estado">Estado</label>
                      <i class="glyphicon glyphicon-inbox"></i>
                     </span>

                    <select class="form-control" name="estado">
                      <option value="0">generada</option>
                      <option value="1">en proceso</option>
                      <option value="2">finalizada</option>
                 
                </select>

                            

                  </div>
                 </div>
                 <div class="col-md-6">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <label for="tipo_actuacion">Tipo de Actuación</label>
                       <i class="glyphicon glyphicon-briefcase"></i>
                     </span>

                         
                    <select class="form-control" name="tipo_actuacion">
                      <option value="0">Ninguna</option>
                      <option value="1">Reparación</option>
                      <option value="2">Sustitución</option>
                      <option value="3">Compra</option>
                      <option value="4">Instalación</option>
                      <option value="5">Configuración</option>
                      <option value="6">Eliminación</option>
                  
                </select>


                  </div>
                 </div>
                  
               </div>
              </div>

            
           
              
              <button type="submit" name="asigna_tarea" class="btn btn-danger">Crear Orden de Trabajo</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
