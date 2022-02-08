<?php
  $page_title = 'Editar Dispositivos';
  require_once('includes/load.php');
  // Nivel de acceso a la página
   page_require_level(0);
?>
<?php
$tincidencias= find_by_cod_dispositivo('dispositivo',(int)$_GET['id']);

?>
<?php
 if(isset($_POST['actualiza_t_inc'])){
   $req_fields = array('nombre','descripcion');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_codigo  = remove_junk($db->escape($_POST['nombre']));
     $p_descripcion   = remove_junk($db->escape($_POST['descripcion']));
     
     $id_t_inc=$tincidencias['cod_dispositivo'];

       $query   = "UPDATE dispositivo SET";
       $query  .=" nombre ='{$p_codigo}', descripcion ='{$p_descripcion}'";
       $query  .=" WHERE cod_dispositivo ='{$id_t_inc}'";

       
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Dispositivo actualizado con éxito. ");
                 redirect('administrar_dispositivo.php?id='.$tincidencias['cod_dispositivo'], false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_tipo_incidencia.php?id='.$tincidencias['cod_dispositivo'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_tipo_incidencia.php?id='.$tincidencias['cod_dispositivo'], false);
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
            <span>Actualizar Dispositivo</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="edit_tipo_incidencia.php?id=<?php echo (int)$tincidencias['cod_dispositivo'];?>"class="clearfix">


            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                    <label for="nombre">Nombre</label>
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="nombre"  value="<?php echo remove_junk($tincidencias['nombre']);?>">
               </div>
              </div>


              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                    <label for="descripcion">Descripción</label>
                   <i class="glyphicon glyphicon-list-alt"></i>
                  </span>
                  

                  <input type="text" class="form-control" name="descripcion"  value="<?php echo remove_junk($tincidencias['descripcion']);?>">

               </div>
              </div>

                                     

             

              <div class="form-group clearfix">
             
               <button type="submit" name="actualiza_t_inc" class="btn btn-primary">Actualizar</button>
            </div>

              
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>