<?php
  $page_title = 'Agregar Dispositivo';
  require_once('includes/load.php');
  // Nivel de permiso de la página
  page_require_level(0);
  $all_tipos = find_all('dispositivo');
 
?>
<?php
 if(isset($_POST['add_tipo_inc'])){
   $req_fields = array('nombre','descripcion');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_codigo  = remove_junk($db->escape($_POST['nombre']));
     $p_descripcion   = remove_junk($db->escape($_POST['descripcion']));
    
     $query  = "INSERT INTO dispositivo (";
     $query .=" nombre,descripcion";
     $query .=") VALUES (";
     $query .=" '{$p_codigo}', '{$p_descripcion}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE cod_dispositivo='{$p_codigo}'";
     if($db->query($query)){
       $session->msg('s',"Dispositivo agregado con éxito.");
       redirect('administrar_dispositivo.php', false);
     } else {
       $session->msg('d',' Dispositivo NO añadido.');
       redirect('administrar_dispositivo.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_dispositivo.php',false);
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
            <span>Agregar Dispositivo</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_dispositivo.php" class="clearfix">


            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="nombre" placeholder="Nombre">
               </div>
              </div>


              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-list-alt"></i>
                  </span>
                  

                  <input type="text" class="form-control" name="descripcion" placeholder="Descripcion">

               </div>
              </div>

                                     

             

              <div class="form-group clearfix">
             
               <button type="submit" name="add_tipo_inc" class="btn btn-primary">Agregar Dispositivo</button>
            </div>

              
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
