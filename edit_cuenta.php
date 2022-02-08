<?php
  $page_title = 'Editar Cuenta';
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(0);
?>
<?php
//Actualiza la imagen de usuario
  if(isset($_POST['submit'])) {
  $photo = new Media();
  $user_id = (int)$_POST['user_id'];
  $photo->upload($_FILES['file_upload']);
  if($photo->process_user($user_id)){
    $session->msg('s','La foto fue subida al servidor.');
    redirect('edit_cuenta.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('edit_cuenta.php');
    }
  }
?>
<?php
 //Actualiza el resto de información del usaurio
  if(isset($_POST['actualiza'])){
    $req_fields = array('nombre','usuario' );
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$_SESSION['user_id'];
           $nombre = remove_junk($db->escape($_POST['nombre']));
       $usuario = remove_junk($db->escape($_POST['usuario']));
            $sql = "UPDATE usuarios SET nombre ='{$nombre}', usuario ='{$usuario}' WHERE id='{$id}'";
    $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Cuenta actualizada. ");
            redirect('edit_cuenta.php?id='.$user['id'], false);
            
          } else {
            $session->msg('d',' Lo siento, actualización falló.');
            redirect('edit_cuenta.php?id='.$user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_cuenta.php?id='.$user['id'], false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-heading clearfix">
            <span class="glyphicon glyphicon-camera"></span>
            <span>Cambiar mi foto</span>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
                <img class="img-circle img-size-2" src="uploads/users/<?php echo $user['imagen'];?>" alt="">
            </div>
            <div class="col-md-8">
              <form class="form" action="edit_cuenta.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <input type="file" name="file_upload" multiple="multiple" class="btn btn-default btn-file"/>
              </div>
              <div class="form-group">
                <input type="hidden" name="user_id" value="<?php echo $user['id'];?>">
                 <button type="submit" name="submit" class="btn btn-warning">Cambiar</button>
              </div>
             </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <span class="glyphicon glyphicon-edit"></span>
        <span>Editar mi cuenta</span>
      </div>
      <div class="panel-body">
          <form method="post" action="edit_cuenta.php?id=<?php echo (int)$user['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="name" class="control-label">Nombre</label>
                  <input type="name" class="form-control" name="nombre" value="<?php echo remove_junk(ucwords($user['nombre'])); ?>">
            </div>
            <div class="form-group">
                  <label for="username" class="control-label">Usuario</label>
                  <input type="text" class="form-control" name="usuario" value="<?php echo remove_junk(ucwords($user['usuario'])); ?>">
            </div>
            <div class="form-group clearfix">
                    <a href="cambiar_clave.php" title="Cambiar Contraseña" class="btn btn-danger pull-right">Cambiar contraseña</a>
                    <button type="submit" name="actualiza" class="btn btn-info">Actualizar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include_once('layouts/footer.php'); ?>
