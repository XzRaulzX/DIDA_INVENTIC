<?php
  $page_title = 'Agregar Zona';
  require_once('includes/load.php');
  // Nivel de permiso de la página
  page_require_level(0);
  $all_areas = find_all('zona');
 
?>
<?php
 if(isset($_POST['add_zona'])){
   $req_fields = array('numero','planta','punto_acceso','switch','cortinas','capacidad');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_numero  = remove_junk($db->escape($_POST['numero']));
     $p_planta   = remove_junk($db->escape($_POST['planta']));
     $p_acceso   = remove_junk($db->escape($_POST['punto_acceso']));
     $p_switch   = remove_junk($db->escape($_POST['switch']));
     $p_cortinas   = remove_junk($db->escape($_POST['cortinas']));
     $p_capacidad   = remove_junk($db->escape($_POST['capacidad']));
     $p_ubicacion   = remove_junk($db->escape($_POST['ubicacion']));

     
     $query  = "INSERT INTO zona (";
     $query .=" numero,planta,punto_acceso,switch,cortinas,capacidad,cod_tipo_zona";
     $query .=") VALUES (";
     $query .=" '{$p_numero}', '{$p_planta}', '{$p_acceso}', '{$p_switch}', '{$p_cortinas}', {$p_capacidad}, {$p_ubicacion}";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE  numero='{$p_numero}'";
     if($db->query($query)){
       $session->msg('s',"Zona agregada con éxito.");
       redirect('areas.php', false);
     } else {
       $session->msg('d',' Zona NO añadida.');
       redirect('areas.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_zona.php',false);
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
            <span class="glyphicon glyphicon-map-marker"></span>
            <span>Agregar Zona</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_zona.php" class="clearfix">


            <div class="col-md-3">
                        <div class="form-group">
                             <label class="form-label">Número Zona</label>  
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                <input type="text" class="form-control" name="numero" placeholder="Número de Zona">
                            </div>
                      </div>
            </div>
            <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Punto de Aceso Wifi</label>  
                                <div class="input-group">
                                     <span class="input-group-addon">
                                       <i class="glyphicon glyphicon-screenshot"></i>
                                     </span>

                                         <select class="form-control" name="punto_acceso">
                                            
                                            <option value="No">No</option>
                                            <option value="Si">Si</option>
                                          </select>

                                </div>
                            </div>
                      </div>
             <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Switch de Zona</label>  
                                <div class="input-group">
                                     <span class="input-group-addon">
                                       <i class="glyphicon glyphicon-fullscreen"></i>
                                     </span>

                                         <select class="form-control" name="switch">
                                           
                                            <option value="No">No</option>
                                            <option value="Si">Si</option>
                                          </select>

                                </div>
                            </div>
                      </div>          
                <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Cortinas</label>  
                                <div class="input-group">
                                     <span class="input-group-addon">
                                       <i class="glyphicon glyphicon-fullscreen"></i>
                                     </span>

                                        <select class="form-control" name="cortinas">
                    
                                        <option value="No">No</option>
                                        <option value="Si">Si</option>
                                      </select>

                                </div>
                            </div>
                      </div>
                <div class="col-md-2">
                        <div class="form-group">
                             <label class="form-label">Capacidad (personas)</label>  
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-log-in"></i></span>
                                <input type="number" class="form-control" name="capacidad" placeholder="Capacidad">
                            </div>
                      </div>
                  </div>


</div>
<div class="row">                                     
               <div class="col-md-3">
                        <div class="form-group">
                             <label class="form-label">Planta del Edificio</label>  
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span>
                                <input type="number" class="form-control" name="planta" placeholder="Planta">
                            </div>
                      </div>
                  </div>
              

               
                <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Tipo de Zona</label>  
                                <div class="input-group">
                                     <span class="input-group-addon">
                                       <i class="glyphicon glyphicon-pushpin"></i>
                                     </span>

                                  <select class="form-control" name="ubicacion">
                                        <option value="-1">Selecciona una Ubicación</option>
                                        <option value="0">Espacio Libre</option>
                                        <option value="1">Aulario del centro</option>
                                        <option value="2">Salon de actos</option>
                                        <option value="3">Secretaría</option>
                                        <option value="4">Departamento</option>
                                        <option value="5">Sala del profesorado</option>
                                        <option value="6">Gimnasio</option>
                                        <option value="7">Biblioteca del Centro</option>
                                        <option value="8">Zona Comun</option>
                                         
                                  </select>

                                </div>
                            </div>
                      </div>
 </div>

              <div class="form-group clearfix">
             
               <button type="submit" name="add_zona" class="btn btn-primary">Agregar Zona</button>
            </div>

              
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
