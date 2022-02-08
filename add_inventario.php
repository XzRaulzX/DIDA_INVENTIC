<?php
  $page_title = 'Agregar Inventario';
  require_once('includes/load.php');
// Validación de permiso de acceso a la página  
  page_require_level(1);
  $user_id = current_user();
  $all_inventario = find_all('inventario');
  $all_zonas = find_all('zona');
  $all_dispositivos=find_all('dispositivo');
  $all_memorias=find_all('tipo_memoria');
?>
<?php
 if(isset($_POST['add_inventario'])){
   $req_fields = array('cod_zona','cod_dispositivo','fecha_revision','estado' );
   validate_fields($req_fields);
   if(empty($errors)){
                 $p_cod_zona= remove_junk($db->escape($_POST['cod_zona']));
                 $p_dispositivo=remove_junk($db->escape($_POST['cod_dispositivo']));
                 $p_fecha_revision=remove_junk($db->escape($_POST['fecha_revision']));
                 $p_estado=remove_junk($db->escape($_POST['estado']));
                 $p_cod_tipo_memoria=remove_junk($db->escape($_POST['cod_tipo_memoria']));
                 $p_tipo_almacenamiento=remove_junk($db->escape($_POST['tipo_almacenamiento']));
                 $p_ram_1=remove_junk($db->escape($_POST['ram_1']));
                 $p_ram_2=remove_junk($db->escape($_POST['ram_2']));
                 $p_ram_3=remove_junk($db->escape($_POST['ram_3']));
                 $p_ram_4=remove_junk($db->escape($_POST['ram_4']));
                 $p_almacenamiento_1=remove_junk($db->escape($_POST['almacenamiento_1']));
                 $p_almacenamiento_2=remove_junk($db->escape($_POST['almacenamiento_2']));
                 $p_conexion_wifi=remove_junk($db->escape($_POST['conexion_wifi']));
                 //$p_qr_info=NULL;
                     
                 $query  = "INSERT INTO inventario (";
                 $query .="cod_zona,cod_dispositivo,fecha_revision,estado,cod_tipo_memoria,ram_1,ram_2,ram_3,ram_4,tipo_almacenamiento,almacenamiento_1,almacenamiento_2,conexion_wifi";
                 $query .=") VALUES (";
                 $query .=" {$p_cod_zona},{$p_dispositivo}, '{$p_fecha_revision}', '{$p_estado}', {$p_cod_tipo_memoria}, '{$p_ram_1}','{$p_ram_2}','{$p_ram_3}','{$p_ram_4}','{$p_tipo_almacenamiento}','{$p_almacenamiento_1}','{$p_almacenamiento_2}','{$p_conexion_wifi}'";
                 $query .=")";
                 
                 
                 
                 
                 if($db->query($query))
                       {
                       
                        $session->msg('s',"Dispositivo añadido al Inventario con éxito. ");
                         redirect('add_inventario.php', true);     
                       
                       } 
                  else {
                        
                         $session->msg('d',' Lo siento, registro falló.');
                         redirect('add_inventario.php', false);
                  
                       }
                  
   }

   else{
          
           $session->msg("d", $errors);

           redirect('add_inventario.php',false);
           

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
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon glyphicon-briefcase"></span>
            <span>Añadir Dispositivo a Inventario</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_inventario.php" class="clearfix">



              
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-label">Usuario</label>
                           <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="glyphicon glyphicon-user"></i>
                                 </span>

                                   <input type="text" class="form-control" name="usuario" value="<?php echo remove_junk(ucwords($user_id['nombre'])); ?>" disabled>

                           </div>
                      </div>
                    </div>
                                
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Zona</label>  
                                <div class="input-group">
                                     <span class="input-group-addon">
                                       <i class="glyphicon glyphicon-map-marker"></i>
                                     </span>

                                         <select class="form-control" name="cod_zona">
                                                  <option value="">Selecciona Zona</option>
                                                <?php  foreach ($all_zonas as $zona): ?>
                                                  <option value="<?php echo (int)$zona['cod_zona'] ?>">
                                                    <?php echo $zona['numero'] ?></option>
                                                <?php endforeach; ?>
                                          </select>

                                </div>
                            </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Dispositivo</label>  
                           <div class="input-group">
                               <span class="input-group-addon">
                                 <i class="glyphicon glyphicon-qrcode"></i>
                               </span>

                                 <select class="form-control" name="cod_dispositivo">
                                          <option value="">Selecciona Dispositivo</option>
                                        <?php  foreach ($all_dispositivos as $dispositivo): ?>
                                          <option value="<?php echo (int)$dispositivo['cod_dispositivo'] ?>">
                                            <?php echo $dispositivo['nombre'] . " --> ".$dispositivo['descripcion']?></option>
                                        <?php endforeach; ?>
                                  </select>

                           </div>
                         </div>
                        </div>
                 

                    <div class="col-md-2">
                        <div class="form-group">
                             <label class="form-label">Fecha Revisión</label>  
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input type="text" class="datepicker form-control" name="fecha_revision" placeholder="Fecha Revisión">
                            </div>
                      </div>
                  </div>
                    <div class="col-md-2">
                      <div class="form-group">
                            <label class="form-label">Estado</label>  
                        <div class="input-group">
                           <span class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                           </span>
                            <select class="form-control" name="estado">
                                  <option value="No indicado" selected="selected">Estado</option>
                                  <option value="No Funciona">No Funciona</option>
                                  <option value="Obsoleto">Obsoleto</option>
                                  <option value="Falta Configurar">Falta Configurar</option>
                                  <option value="Operativo">Operativo</option>
                                  
                          </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Memoria RAM</label>
                           <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="glyphicon glyphicon-menu-hamburger"></i>
                                 </span>
                                <select class="form-control" name="cod_tipo_memoria">
                                        
                                        <?php  foreach ($all_memorias as $memoria): ?>
                                          <option value="<?php echo (int)$memoria['cod_tipo_memoria'] ?>">
                                            <?php echo $memoria['codigo'] . " --> ".$memoria['descripcion']. "    (Velocidad:)  ".$memoria['velocidad']?></option>
                                        <?php endforeach; ?>
                                  </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-label">Banco RAM 1</label>
                           <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="glyphicon glyphicon-menu-hamburger"></i>
                                 </span>
                                <select class="form-control" name="ram_1">
                                  <option value="No disponible" selected="selected">No Disponible</option>
                                  <option value="256 Mb">256 Mb</option>
                                  <option value="512 Mb">512 Mb</option>
                                  <option value="1 Gb">1 Gb</option>
                                  <option value="2 Gb">2 Gb</option>
                                  <option value="4 Gb">4 Gb</option>
                                  <option value="8 Gb">8 Gb</option>
                                  <option value="16 Gb">16 Gb</option>
                                  
                          </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-label">Banco RAM 2</label>
                           <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="glyphicon glyphicon-menu-hamburger"></i>
                                 </span>
                                <select class="form-control" name="ram_2">
                                   <option value="No disponible" selected="selected">No Disponible</option>
                                  <option value="256 Mb">256 Mb</option>
                                  <option value="512 Mb">512 Mb</option>
                                  <option value="1 Gb">1 Gb</option>
                                  <option value="2 Gb">2 Gb</option>
                                  <option value="4 Gb">4 Gb</option>
                                  <option value="8 Gb">8 Gb</option>
                                  <option value="16 Gb">16 Gb</option>
                                  
                          </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-label">Banco RAM 3</label>
                           <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="glyphicon glyphicon-menu-hamburger"></i>
                                 </span>
                                <select class="form-control" name="ram_3">
                                   <option value="No disponible" selected="selected">No Disponible</option>
                                  <option value="256 Mb">256 Mb</option>
                                  <option value="512 Mb">512 Mb</option>
                                  <option value="1 Gb">1 Gb</option>
                                  <option value="2 Gb">2 Gb</option>
                                  <option value="4 Gb">4 Gb</option>
                                  <option value="8 Gb">8 Gb</option>
                                  <option value="16 Gb">16 Gb</option>
                                  
                          </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-label">Banco RAM 4</label>
                           <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="glyphicon glyphicon-menu-hamburger"></i>
                                 </span>
                                <select class="form-control" name="ram_4">
                                   <option value="No disponible" selected="selected">No Disponible</option>
                                  <option value="256 Mb">256 Mb</option>
                                  <option value="512 Mb">512 Mb</option>
                                  <option value="1 Gb">1 Gb</option>
                                  <option value="2 Gb">2 Gb</option>
                                  <option value="4 Gb">4 Gb</option>
                                  <option value="8 Gb">8 Gb</option>
                                  <option value="16 Gb">16 Gb</option>
                                  
                          </select>
                        </div>
                    </div>
                </div>
              </div>

              <div class="row">
                 <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Almacenamiento en Disco</label>
                           <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="glyphicon glyphicon-tasks"></i>
                                 </span>
                                <select class="form-control" name="tipo_almacenamiento">
                                  
                                  <option value="No disponible">Dispositivo sin Almacenamiento</option>
                                  <option value="HDD">Disco Mecánico</option>
                                  <option value="SSD">Disco Sólido</option>
                                  <option value="M2">Disco NMVE M.2</option>
                                  
                                  
                          </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-label">Almacenamiento 1</label>
                           <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="glyphicon glyphicon-tasks"></i>
                                 </span>
                                <select class="form-control" name="almacenamiento_1">
                                  <option value="No disponible" selected="selected">No Disponible</option>
                                  <option value="40 Gb">40 Gb</option>
                                  <option value="80 Gb">80 Gb</option>
                                  <option value="120 Gb">120 Gb</option>
                                  <option value="240 Gb">240 Gb</option>
                                  <option value="256 Gb">256 Gb</option>
                                  <option value="512 Gb">512 Gb</option>
                                  <option value="1 Tb">1 Tb</option>
                                  <option value="2 Tb">2 Tb</option>
                                  <option value="3 Tb">3 Tb</option>
                                  <option value="4 Tb">4 Tb</option>
                                  
                          </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                       <div class="form-group">
                        <label class="form-label">Almacenamiento 2</label>
                           <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="glyphicon glyphicon-tasks"></i>
                                 </span>
                                <select class="form-control" name="almacenamiento_2">
                                   <option value="No disponible" selected="selected">No Disponible</option>
                                  <option value="40 Gb">40 Gb</option>
                                  <option value="80 Gb">80 Gb</option>
                                  <option value="120 Gb">120 Gb</option>
                                  <option value="240 Gb">240 Gb</option>
                                  <option value="256 Gb">256 Gb</option>
                                  <option value="512 Gb">512 Gb</option>
                                  <option value="1 Tb">1 Tb</option>
                                  <option value="2 Tb">2 Tb</option>
                                  <option value="3 Tb">3 Tb</option>
                                  <option value="4 Tb">4 Tb</option>
                                  
                          </select>
                        </div>
                    </div>
                </div>
              
                <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-label">Conexión a Internet</label>
                           <div class="input-group">
                                 <span class="input-group-addon">
                                  <i class="glyphicon glyphicon-signal"></i>
                                 </span>
                                <select class="form-control" name="conexion_wifi">
                                  
                                  <option value="No Disponible">No disponible</option>
                                  <option value="WIFI">Wifi</option>
                                  <option value="Cable">Cable</option>
                                  
                                  
                          </select>
                        </div>
                    </div>
                </div>
              </div>


            <div class="row">
                                                 

               
              <div class="form-group">
                <div class="input-group">
              <button type="submit" name="add_inventario" class="btn btn-danger">Añadir a Inventario</button>
                </div>
              </div>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
