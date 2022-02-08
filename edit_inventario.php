<?php
  $page_title = 'Editar Inventario';
  require_once('includes/load.php');
// Validación de permiso de acceso a la página  
  page_require_level(1);
  $user_id = current_user();
  $linea_inventario = find_by_inventario('inventario',(int)$_GET['id']);
  $cod_inventario=$linea_inventario['cod_inventario'];
  $all_zonas = find_all('zona');
  $all_dispositivos=find_all('dispositivo');
  $all_memorias=find_all('tipo_memoria');
?>
<?php
 if(isset($_POST['edit_inventario'])){
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
                 
                     
                 $query  = "UPDATE  inventario SET ";
                 $query .="cod_zona={$p_cod_zona},cod_dispositivo={$p_dispositivo},fecha_revision='{$p_fecha_revision}',";
                 $query .="estado='{$p_estado}',cod_tipo_memoria={$p_cod_tipo_memoria},";
                 $query .="ram_1='{$p_ram_1}',ram_2='{$p_ram_2}',ram_3='{$p_ram_3}',ram_4='{$p_ram_4}',tipo_almacenamiento='{$p_tipo_almacenamiento}',";
                 $query .="almacenamiento_1='{$p_almacenamiento_1}',almacenamiento_2='{$p_almacenamiento_2}',conexion_wifi='{$p_conexion_wifi}'";
                 $query  .=" WHERE cod_inventario ={$cod_inventario}";

       
              $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Inventario actualizado con éxito. ");
                 redirect('inventario.php?id='.$linea_inventario['cod_inventario'], false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_inventario.php?id='.$linea_inventario['cod_inventario'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_inventario.php?id='.$linea_inventario['cod_inventario'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg);?>
  </div>
</div>
  <div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon glyphicon-briefcase"></span>
            <span>Actualizar Inventario</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">

        <form action="edit_inventario.php?id=<?php echo (int)$linea_inventario['cod_inventario'];?>" method="post" class="clearfix">


              
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
                           </label>
                                <div class="input-group">
                                     <span class="input-group-addon">
                                       <i class="glyphicon glyphicon-map-marker"></i>
                                     </span>

                                         <select class="form-control" name="cod_zona">
                                                  
                                                <?php  foreach ($all_zonas as $zona): ?>
                                                  <option <?php if($zona['cod_zona'] === $linea_inventario['cod_zona']) echo 'selected="selected"';?> value="<?php echo $zona['cod_zona'];?>"><?php echo ucwords($zona['numero']);?></option>

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
                                         
                                        <?php  foreach ($all_dispositivos as $dispositivo): ?>
                                          <option <?php if($dispositivo['cod_dispositivo'] === $linea_inventario['cod_dispositivo']) echo 'selected="selected"';?> value="<?php echo $dispositivo['cod_dispositivo'];?>"><?php echo $dispositivo['nombre'] . " --> ".$dispositivo['descripcion']?></option>
                                            
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
                                <input type="text" class="datepicker form-control" name="fecha_revision" placeholder="Fecha Revisión" value="<?php echo remove_junk($linea_inventario['fecha_revision']);?>">
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
                                  <option <?php if($linea_inventario['estado'] === 'No indicado') echo 'selected="selected"';?>value="No indicado">No indicado</option>
                                  <option <?php if($linea_inventario['estado'] === 'No Funciona') echo 'selected="selected"';?>value="No Funciona">No Funciona</option>
                                  <option <?php if($linea_inventario['estado'] === 'Obsoleto') echo 'selected="selected"';?>value="Obsoleto">Obsoleto</option>
                                  <option <?php if($linea_inventario['estado'] === 'Falta Configurar') echo 'selected="selected"';?>value="Falta Configurar">Falta Configurar</option>
                                  <option <?php if($linea_inventario['estado'] === 'Operativo') echo 'selected="selected"';?>value="Operativo">Operativo</option>
                                  
                                  
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

                                        <option <?php if($memoria['cod_tipo_memoria'] === $linea_inventario['cod_tipo_memoria']) echo 'selected="selected"';?> value="<?php echo $memoria['cod_tipo_memoria'];?>"><?php echo $memoria['codigo'] . " --> ".$memoria['descripcion']?></option>                                            
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

<option <?php if($linea_inventario['ram_1'] === 'No disponible') echo 'selected="selected"';?>value="No disponible">No disponible</option>
<option <?php if($linea_inventario['ram_1'] === '256 Mb') echo 'selected="selected"';?>value="256 Mb">256 Mb</option>
<option <?php if($linea_inventario['ram_1'] === '512 Mb') echo 'selected="selected"';?>value="512 Mb">512 Mb</option>
<option <?php if($linea_inventario['ram_1'] === '1 Gb') echo 'selected="selected"';?>value="1 Gb">1 Gb</option>
<option <?php if($linea_inventario['ram_1'] === '2 Gb') echo 'selected="selected"';?>value="2 Gb">2 Gb</option>
<option <?php if($linea_inventario['ram_1'] === '4 Gb') echo 'selected="selected"';?>value="4 Gb">4 Gb</option>
<option <?php if($linea_inventario['ram_1'] === '8 Gb') echo 'selected="selected"';?>value="8 Gb">8 Gb</option>
<option <?php if($linea_inventario['ram_1'] === '16 Gb') echo 'selected="selected"';?>value="16 Gb">16 Gb</option>

                                 
                                  
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
                                 <option <?php if($linea_inventario['ram_1'] === 'No disponible') echo 'selected="selected"';?>value="No disponible">No disponible</option>
<option <?php if($linea_inventario['ram_2'] === '256 Mb') echo 'selected="selected"';?>value="256 Mb">256 Mb</option>
<option <?php if($linea_inventario['ram_2'] === '512 Mb') echo 'selected="selected"';?>value="512 Mb">512 Mb</option>
<option <?php if($linea_inventario['ram_2'] === '1 Gb') echo 'selected="selected"';?>value="1 Gb">1 Gb</option>
<option <?php if($linea_inventario['ram_2'] === '2 Gb') echo 'selected="selected"';?>value="2 Gb">2 Gb</option>
<option <?php if($linea_inventario['ram_2'] === '4 Gb') echo 'selected="selected"';?>value="4 Gb">4 Gb</option>
<option <?php if($linea_inventario['ram_2'] === '8 Gb') echo 'selected="selected"';?>value="8 Gb">8 Gb</option>
<option <?php if($linea_inventario['ram_2'] === '16 Gb') echo 'selected="selected"';?>value="16 Gb">16 Gb</option>
                                  
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
                                <option <?php if($linea_inventario['ram_1'] === 'No disponible') echo 'selected="selected"';?>value="No disponible">No disponible</option>
<option <?php if($linea_inventario['ram_3'] === '256 Mb') echo 'selected="selected"';?>value="256 Mb">256 Mb</option>
<option <?php if($linea_inventario['ram_3'] === '512 Mb') echo 'selected="selected"';?>value="512 Mb">512 Mb</option>
<option <?php if($linea_inventario['ram_3'] === '1 Gb') echo 'selected="selected"';?>value="1 Gb">1 Gb</option>
<option <?php if($linea_inventario['ram_3'] === '2 Gb') echo 'selected="selected"';?>value="2 Gb">2 Gb</option>
<option <?php if($linea_inventario['ram_3'] === '4 Gb') echo 'selected="selected"';?>value="4 Gb">4 Gb</option>
<option <?php if($linea_inventario['ram_3'] === '8 Gb') echo 'selected="selected"';?>value="8 Gb">8 Gb</option>
<option <?php if($linea_inventario['ram_3'] === '16 Gb') echo 'selected="selected"';?>value="16 Gb">16 Gb</option>
                                  
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
                                   <option <?php if($linea_inventario['ram_1'] === 'No disponible') echo 'selected="selected"';?>value="No disponible">No disponible</option>
<option <?php if($linea_inventario['ram_4'] === '256 Mb') echo 'selected="selected"';?>value="256 Mb">256 Mb</option>
<option <?php if($linea_inventario['ram_4'] === '512 Mb') echo 'selected="selected"';?>value="512 Mb">512 Mb</option>
<option <?php if($linea_inventario['ram_4'] === '1 Gb') echo 'selected="selected"';?>value="1 Gb">1 Gb</option>
<option <?php if($linea_inventario['ram_4'] === '2 Gb') echo 'selected="selected"';?>value="2 Gb">2 Gb</option>
<option <?php if($linea_inventario['ram_4'] === '4 Gb') echo 'selected="selected"';?>value="4 Gb">4 Gb</option>
<option <?php if($linea_inventario['ram_4'] === '8 Gb') echo 'selected="selected"';?>value="8 Gb">8 Gb</option>
<option <?php if($linea_inventario['ram_4'] === '16 Gb') echo 'selected="selected"';?>value="16 Gb">16 Gb</option>
                                  
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

<option <?php if($linea_inventario['tipo_almacenamiento'] === 'No disponible') echo 'selected="selected"';?>value="No disponible">Dispositivo sin Almacenamiento</option>
<option <?php if($linea_inventario['tipo_almacenamiento'] === 'HDD') echo 'selected="selected"';?>value="HDD">Disco Mecánico</option>
<option <?php if($linea_inventario['tipo_almacenamiento'] === 'SSD') echo 'selected="selected"';?>value="SSD">Disco Sólido</option>
<option <?php if($linea_inventario['tipo_almacenamiento'] === 'M2') echo 'selected="selected"';?>value="M2">Disco NMVE M.2</option>
                              
                                  
                                  
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
<option <?php if($linea_inventario['almacenamiento_1'] === 'No disponible') echo 'selected="selected"';?>value="No disponible">No disponible</option>
<option <?php if($linea_inventario['almacenamiento_1'] === '40 Gb') echo 'selected="selected"';?>value="40 Gb">40 Gb</option>
<option <?php if($linea_inventario['almacenamiento_1'] === '80 Gb') echo 'selected="selected"';?>value="80 Gb">80 Gb</option>
<option <?php if($linea_inventario['almacenamiento_1'] === '120 Gb') echo 'selected="selected"';?>value="120 Gb">120 Gb</option>
<option <?php if($linea_inventario['almacenamiento_1'] === '240 Gb') echo 'selected="selected"';?>value="240 Gb">240 Gb</option>
<option <?php if($linea_inventario['almacenamiento_1'] === '256 Gb') echo 'selected="selected"';?>value="256 Gb">256 Gb</option>
<option <?php if($linea_inventario['almacenamiento_1'] === '512 Gb') echo 'selected="selected"';?>value="512 Gb">512 Gb</option>
<option <?php if($linea_inventario['almacenamiento_1'] === '1 Tb') echo 'selected="selected"';?>value="1 Tb">1 Tb</option>
<option <?php if($linea_inventario['almacenamiento_1'] === '2 Tb') echo 'selected="selected"';?>value="2 Tb">2 Tb</option>
<option <?php if($linea_inventario['almacenamiento_1'] === '3 Tb') echo 'selected="selected"';?>value="3 Tb">3 Tb</option>
<option <?php if($linea_inventario['almacenamiento_1'] === '4 Tb') echo 'selected="selected"';?>value="4 Tb">4 Tb</option>
                                 
                                  
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
                                  <option <?php if($linea_inventario['almacenamiento_1'] === 'No disponible') echo 'selected="selected"';?>value="No disponible">No disponible</option>
<option <?php if($linea_inventario['almacenamiento_2'] === '40 Gb') echo 'selected="selected"';?>value="40 Gb">40 Gb</option>
<option <?php if($linea_inventario['almacenamiento_2'] === '80 Gb') echo 'selected="selected"';?>value="80 Gb">80 Gb</option>
<option <?php if($linea_inventario['almacenamiento_2'] === '120 Gb') echo 'selected="selected"';?>value="120 Gb">120 Gb</option>
<option <?php if($linea_inventario['almacenamiento_2'] === '240 Gb') echo 'selected="selected"';?>value="240 Gb">240 Gb</option>
<option <?php if($linea_inventario['almacenamiento_2'] === '256 Gb') echo 'selected="selected"';?>value="256 Gb">256 Gb</option>
<option <?php if($linea_inventario['almacenamiento_2'] === '512 Gb') echo 'selected="selected"';?>value="512 Gb">512 Gb</option>
<option <?php if($linea_inventario['almacenamiento_2'] === '1 Tb') echo 'selected="selected"';?>value="1 Tb">1 Tb</option>
<option <?php if($linea_inventario['almacenamiento_2'] === '2 Tb') echo 'selected="selected"';?>value="2 Tb">2 Tb</option>
<option <?php if($linea_inventario['almacenamiento_2'] === '3 Tb') echo 'selected="selected"';?>value="3 Tb">3 Tb</option>
<option <?php if($linea_inventario['almacenamiento_2'] === '4 Tb') echo 'selected="selected"';?>value="4 Tb">4 Tb</option>
                                  
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
<option <?php if($linea_inventario['conexion_wifi'] === 'No disponible') echo 'selected="selected"';?>value="No disponible">No disponible</option>  
<option <?php if($linea_inventario['conexion_wifi'] === 'WIFI') echo 'selected="selected"';?>value="WIFI">Wifi</option>
<option <?php if($linea_inventario['conexion_wifi'] === 'Cable') echo 'selected="selected"';?>value="Cable">Cable</option>                               
                                  
                          </select>
                        </div>
                    </div>
                </div>
              </div>


            <div class="row">
                                                 

               
              <div class="form-group">
                <div class="input-group">
              <button type="submit" name="edit_inventario" class="btn btn-danger">Actualizar Inventario</button>
                </div>
              </div>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
