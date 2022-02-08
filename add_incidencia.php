<?php
  $page_title = 'Agregar Incidencia';
  require_once('includes/load.php');
// Validación de permiso de acceso a la página  
  page_require_level(1);
  $user_id = current_user();
  $all_areas = find_all('areas');
  $all_tipos_incidencia = find_all('tipos_incidencia');
?>
<?php
 if(isset($_POST['add_incidencia'])){
   $req_fields = array('descripcion','area','tipo_incidencia' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_descripcion  = remove_junk($db->escape($_POST['descripcion']));
     $p_usuario   = $user_id['id'];
     $p_area   = remove_junk($db->escape($_POST['area']));
     $p_tipo_incidencia   = remove_junk($db->escape($_POST['tipo_incidencia']));
     $p_fecha_incidencia  = make_date();
// Por defecto el estado de la incidencia es: Generado (0)
     $p_estado=0;
    
     $query  = "INSERT INTO incidencia (";
     $query .=" descripcion,id_usuario,id_area,id_tipo_incidencia,fecha_incidencia,estado";
     $query .=") VALUES (";
     $query .=" '{$p_descripcion}','{$p_usuario}', '{$p_area}', '{$p_tipo_incidencia}', '{$p_fecha_incidencia}', '{$p_estado}'";
     $query .=")";
     
     
     if($db->query($query)){
      
         // Busca datos auxiliares
      $area=find_by_id('areas',$p_area);
      $t_incidencia=find_by_id('tipos_incidencia',$p_tipo_incidencia);
      // Envío del correo al profesor de la incidencia
     $asunto="INCIDENCIA TIC GENERADA";
     $cuerpo="<b>Fecha Incidencia: </b>".$p_fecha_incidencia;
     $cuerpo.="<br><b>Zona: </b>".$area['nombre'];
     $cuerpo.=" [".$area['descripcion']. " ]";
     $cuerpo.="<br><b>Tipo de Incidencia: </b>".$t_incidencia['descripcion'];
     $cuerpo.="<hr>";
     $cuerpo.="<b>Descripción: </b>".$p_descripcion;
     $cuerpo.="<hr>";
     $cuerpo.="<br><b>Generada por: </b>". $user_id['nombre'];
     $destinatario=$user_id['correo'];
     $errors=Envia_Correo_Simple($destinatario,$asunto,$cuerpo);
      $session->msg('s',"Incidencia Generada con éxito. ");

       redirect('add_incidencia.php', true);
       
      
      
     } else {
      
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_incidencia.php', false);
      
     }
    
     

   } else{
    
     $session->msg("d", $errors);
     redirect('add_incidencia.php',false);
     

   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg);
     $idea= $user_id['id'];
          echo "<script>console.log('$idea');</script>";?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <span>Crear una Incidencia</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_incidencia.php" class="clearfix">



              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-user"></i>
                     </span>

                    <input type="text" class="form-control" name="usuario" value="<?php echo remove_junk(ucwords($user_id['nombre'])); ?>" disabled>

                            

                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-map-marker"></i>
                     </span>

                         <select class="form-control" name="area">
                            <option value="">Selecciona Zona</option>
                          <?php  foreach ($all_areas as $area): ?>
                            <option value="<?php echo (int)$area['id'] ?>">
                              <?php echo $area['nombre'] ?></option>
                          <?php endforeach; ?>
                          </select>

                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-exclamation-sign"></i>
                      </span>


                            <select class="form-control" name="tipo_incidencia">
                            <option value="">Selecciona tipo de Incidencia</option>
                          <?php  foreach ($all_tipos_incidencia as $t_inc): ?>
                            <option value="<?php echo (int)$t_inc['id'] ?>">
                              <?php echo $t_inc['codigo'] ?></option>
                          <?php endforeach; ?>
                          </select>



                   </div>
                  </div>
               </div>
              </div>








              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="descripcion" placeholder="Descripción">
               </div>
              </div>
           
              
              <button type="submit" name="add_incidencia" class="btn btn-danger">Crear Incidencia</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
