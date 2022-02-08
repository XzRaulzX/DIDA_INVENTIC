<?php
  $page_title = 'Actualizar Zona';
  require_once('includes/load.php');
  // Nivel de acceso a la página
   page_require_level(0);
?>
<?php
$area = find_by_zonas('zona',(int)$_GET['id']);

?>
<?php
  if(isset($_POST['actualiza_zona'])){
   $req_fields = array('numero','planta','punto_acceso','switch','cortinas','capacidad');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_numero  = remove_junk($db->escape($_POST['numero']));
     $p_planta   = remove_junk($db->escape($_POST['planta']));
     $p_acceso   = remove_junk($db->escape($_POST['punto_acceso']));
     $p_switch   = remove_junk($db->escape($_POST['switch']));
     $p_cortinas   = remove_junk($db->escape($_POST['cortinas']));
     $p_capacidad   = remove_junk($db->escape($_POST['capacidad']));
     $p_ubicacion   = remove_junk($db->escape($_POST['cod_tipo_zona']));
     
     $cod_zona=$area['cod_zona'];

       $query   = "UPDATE zona SET";
       $query  .=" numero ='{$p_numero}', planta ='{$p_planta}',";
       $query  .=" punto_acceso ='{$p_acceso}', switch ='{$p_switch}',";
       $query  .=" cortinas ='{$p_cortinas}', capacidad ={$p_capacidad}, ";
       $query  .=" cod_tipo_zona ={$p_ubicacion}";
       $query  .=" WHERE cod_zona ={$cod_zona}";

       
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Zona actualizada con éxito. ");
                 redirect('areas.php?id='.$area['id'], false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_area.php?id='.$area['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_area.php?id='.$area['id'], false);
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
            <span>Actualizar Zona</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="edit_area.php?id=<?php echo (int)$area['cod_zona'];?>"class="clearfix">


            <div class="form-group">
              <div class="row">
                 <div class="col-md-3">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <label for="nombre">Numero</label>
                             <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="numero"  value="<?php echo remove_junk($area['numero']);?>">
                         </div>
                </div>


              <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                    <label for="descripcion">Planta</label>
                   <i class="glyphicon glyphicon-list-alt"></i>
                  </span>
                  

                  <input type="number" class="form-control" name="planta"  value="<?php echo remove_junk($area['planta']);?>">

               </div>
              </div>

                                     

              <div class="form-group">

               <div class="row">
                 <div class="col-md-3">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <label for="signatura">Punto de Acceso</label>
                      <i class="glyphicon glyphicon-tag"></i>
                     </span>
                     <select class="form-control" name="punto_acceso">
                    <option <?php if($area['punto_acceso'] === 'No') echo 'selected="selected"';?>value="No">No</option>
                    <option <?php if($area['punto_acceso'] === 'Si') echo 'selected="selected"';?>value="Si">Si</option>
                     </select>
                     
                  </div>
                 </div> 
                 <div class="col-md-3">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <label for="switch">Switch</label>
                      <i class="glyphicon glyphicon-tag"></i>
                     </span>
                     <select class="form-control" name="switch">
                    <option <?php if($area['switch'] === 'No') echo 'selected="selected"';?>value="No">No</option>
                    <option <?php if($area['switch'] === 'Si') echo 'selected="selected"';?>value="Si">Si</option>
                     </select>
                     
                  </div>
                 </div>
                 <div class="col-md-3">
                           <div class="input-group">
                             <span class="input-group-addon">
                              <label for="cortina">Cortinas</label>
                              <i class="glyphicon glyphicon-tag"></i>
                             </span>
                             <select class="form-control" name="cortinas">
                            <option <?php if($area['cortinas'] === 'No') echo 'selected="selected"';?>value="No">No</option>
                            <option <?php if($area['cortinas'] === 'Si') echo 'selected="selected"';?>value="Si">Si</option>
                             </select>
                             
                          </div>
                 </div>
               
            <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                    <label for="capacidad">Capacidad</label>
                   <i class="glyphicon glyphicon-list-alt"></i>
                  </span>
                  

                  <input type="number" class="form-control" name="capacidad"  value="<?php echo remove_junk($area['capacidad']);?>">

               </div>
              </div>
            </div>




                 <div class="row">
                 <div class="col-md-6">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <label for="ubicacion">Ubicación</label>
                      <i class="glyphicon glyphicon-pushpin"></i>
                     </span>


              
                <select class="form-control" name="cod_tipo_zona">
                  <option <?php if($area['cod_tipo_zona'] === '0') echo 'selected="selected"';?>value="0">Espacio Libre</option>
                  <option <?php if($area['cod_tipo_zona'] === '1') echo 'selected="selected"';?>value="1">Aulario del Centro</option>
                  <option <?php if($area['cod_tipo_zona'] === '2') echo 'selected="selected"';?>value="2">Salon de actos</option>
                  <option <?php if($area['cod_tipo_zona'] === '3') echo 'selected="selected"';?>value="3">Secretaria</option>
                  <option <?php if($area['cod_tipo_zona'] === '4') echo 'selected="selected"';?>value="4">Departamento</option>
                  <option <?php if($area['cod_tipo_zona'] === '5') echo 'selected="selected"';?>value="5">Sala del profesorado</option>
                  <option <?php if($area['cod_tipo_zona'] === '6') echo 'selected="selected"';?>value="6">Gimnasio</option>
                  <option <?php if($area['cod_tipo_zona'] === '7') echo 'selected="selected"';?>value="7">Biblioteca del Centro</option>
                  <option <?php if($area['cod_tipo_zona'] === '8') echo 'selected="selected"';?>value="8">Zona Comun</option>
                  
                </select>
            </div>

                   

               </div>
              </div>

              <div class="form-group clearfix">
             
               <button type="submit" name="actualiza_zona" class="btn btn-primary">Actualizar</button>
            </div>

              
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>