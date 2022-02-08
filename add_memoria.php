<?php
  $page_title = 'Agregar Tipo de Memoria';
  require_once('includes/load.php');
  // Nivel de permiso de la página
  page_require_level(0);
  $all_tipos = find_all('dispositivo');
 
?>
<?php
 if(isset($_POST['add_tipo_memoria'])){
   $req_fields = array('codigo','descripcion','velocidad');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_codigo  = remove_junk($db->escape($_POST['codigo']));
     $p_descripcion   = remove_junk($db->escape($_POST['descripcion']));
     $p_velocidad   = remove_junk($db->escape($_POST['velocidad']));

     $query  = "INSERT INTO tipo_memoria (";
     $query .=" codigo,descripcion,velocidad";
     $query .=") VALUES (";
     $query .=" '{$p_codigo}', '{$p_descripcion}', '{$p_velocidad}'";
     $query .=");";
     
     if($db->query($query)){
       $session->msg('s',"Memoria agregada con éxito.");
       redirect('add_memoria.php', false);
     } else {
       $session->msg('d',' Tipo de Memoria NO añadida.');
       redirect('add_memoria.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_memoria.php',false);
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
            <span class="glyphicon glyphicon-menu-hamburger"></span>
            <span>Agregar Tipo de Memoria</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_memoria.php" class="clearfix">


            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-tag"></i>
                  </span>
                  <input type="text" class="form-control" name="codigo" placeholder="codigo">
               </div>
              </div>


              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pushpin"></i>
                  </span>
                  

                  <input type="text" class="form-control" name="descripcion" placeholder="Descripcion">

               </div>
              </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-signal"></i>
                  </span>
                  

                  <input type="text" class="form-control" name="velocidad" placeholder="Velocidad">

               </div>
              </div>
                                     

             

              <div class="form-group clearfix">
             
               <button type="submit" name="add_tipo_memoria" class="btn btn-primary">Agregar Tipo de Memoria</button>
            </div>

              
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
