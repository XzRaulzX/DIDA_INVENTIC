<?php
  $page_title = 'Editar Grupo';
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(0);
?>
<?php
  $e_group = find_by_id('grupos_usuario',(int)$_GET['id']);
  if(!$e_group){
    $session->msg("d","Falta id de Grupo.");
    redirect('grupos_usuario.php');
  }
?>
<?php
  if(isset($_POST['update'])){

   $req_fields = array('nombre_grupo','nivel_grupo');
   validate_fields($req_fields);
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['nombre_grupo']));
          $level = remove_junk($db->escape($_POST['nivel_grupo']));
         $status = remove_junk($db->escape($_POST['estado_grupo']));

        $query  = "UPDATE grupos_usuario SET ";
        $query .= "nombre_grupo='{$name}',nivel_grupo='{$level}',estado_grupo='{$status}'";
        $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
        $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"Grupo se ha actualizado! ");
          redirect('edit_grupo.php?id='.(int)$e_group['id'], false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se ha actualizado el grupo!');
          redirect('edit_grupo.php?id='.(int)$e_group['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('edit_grupo.php?id='.(int)$e_group['id'], false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h3>Editar Grupo</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="edit_grupo.php?id=<?php echo (int)$e_group['id'];?>" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Nombre del grupo</label>
              <input type="name" class="form-control" name="nombre_grupo" value="<?php echo remove_junk(ucwords($e_group['nombre_grupo'])); ?>">
        </div>
        <div class="form-group">
              <label for="level" class="control-label">Nivel del grupo</label>
              <select class="form-control" name="nivel_grupo">
                <option <?php if($e_group['nivel_grupo'] === '0') echo 'selected="selected"';?> value="0">0 - Super</option>
                <option <?php if($e_group['nivel_grupo'] === '1') echo 'selected="selected"';?> value="1">1 - Profesor</option>
                <option <?php if($e_group['nivel_grupo'] === '2') echo 'selected="selected"';?> value="2">2 - Gestor TIC</option>
                <option <?php if($e_group['nivel_grupo'] === '3') echo 'selected="selected"';?> value="3">3 - Técnico</option>   
              </select>
        </div>
        <div class="form-group">
          <label for="status">Estado</label>
              <select class="form-control" name="estado_grupo">
                <option <?php if($e_group['estado_grupo'] === '1') echo 'selected="selected"';?> value="1"> Activo </option>
                <option <?php if($e_group['estado_grupo'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
               
              </select>
        </div>
        <div class="form-group clearfix">
                <button type="submit" name="update" class="btn btn-info">Actualizar</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
