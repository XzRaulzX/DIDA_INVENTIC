<?php
  $page_title = 'Editar Usuario';
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(0);
?>
<?php
  $e_user = find_by_id('usuarios',(int)$_GET['id']);
  $groups  = find_all('grupos_usuario');
  
  if(!$e_user){
    $session->msg("d","Falta el id de Usuario.");
    redirect('usuarios.php');
  }
?>

<?php
//Actualiza el resto de la información de usuario
  if(isset($_POST['update'])) {
    $req_fields = array('nombre','usuario','nivel','correo','estado');
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$e_user['id'];
           $nombre = remove_junk($db->escape($_POST['nombre']));
          $usuario = remove_junk($db->escape($_POST['usuario']));
          $nivel = (int)$db->escape($_POST['nivel']);
          $estado = (int)$db->escape($_POST['estado']);
         $estado   = remove_junk($db->escape($_POST['estado']));
         $correo = remove_junk($db->escape($_POST['correo']));
            $sql = "UPDATE usuarios SET nombre ='{$nombre}', usuario ='{$usuario}',nivel='{$nivel}',estado='{$estado}',correo='{$correo}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Cuenta actualizada ");
            redirect('edit_usuario.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Lo siento no se actualizó los datos.');
            redirect('edit_usuario.php?id='.(int)$e_user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_usuario.php?id='.(int)$e_user['id'],false);
    }
  }
?>
<?php
//                                                              Actualiza la clave de usuario
if(isset($_POST['update-clave'])) {
  $req_fields = array('nueva_clave');
  validate_fields($req_fields);
  if(empty($errors)){

    
          
    
         $id = (int)$e_user['id'];
         $clave = remove_junk($db->escape($_POST['nueva_clave']));
         $h_clave   = sha1($clave);
         $sql = "UPDATE usuarios SET clave='{$h_clave}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
          // Envía un correo de actualización de la contraseña
                    
                     $salida = find_by_id('usuarios',$id);
                     $nombre = $salida['nombre'];
                     $usuario = $salida['usuario'];
                     $correo = $salida['correo'];
                     $asunto="ADADI.- Cambio de Contraseña";
                    // $cuerpo="<b>Fecha cambio: </b>".make_date();
                     $cuerpo.="<br><b>Nombre: </b>".$nombre;
                     
                     $cuerpo.="<br><b>usuario: </b>".$usuario;
                     $cuerpo.="<br><hr>";
                     $cuerpo.="<b>Nueva contraseña: </b>".$clave;
                     $cuerpo.="<hr>";
                     
                     Envia_Correo_Simple($correo,$asunto,$cuerpo);
                     
                    $session->msg('s',"Se ha actualizado la contraseña del usuario. ");
                    redirect('edit_usuario.php?id='.(int)$e_user['id'], false);
                     } 
          else {

                      $session->msg('d','No se pudo actualizar la contraseña de usuario..');
                      redirect('edit_usuario.php?id='.(int)$e_user['id'], false);
          
              }
  } else {
    $session->msg("d", $errors);
    redirect('edit_usuario.php?id='.(int)$e_user['id'],false);
  }
  

}

?>
<?php
//                                                              Actualiza la foto del usuario
  if(isset($_POST['submit-foto'])) {
  $photo = new Media();
  $user_id = (int)$e_user['id'];
  $photo->upload($_FILES['file_upload']);
  if($photo->process_user($user_id)){
    $session->msg('s','La foto fue subida al servidor.');
    redirect('edit_usuario.php?id='.(int)$e_user['id'],false);
    } else{
      $session->msg('d',$user_id);//$session->msg('d',join($photo->errors));
     redirect('edit_usuario.php?id='.(int)$e_user['id'],false);
    }
  }
?>


<!--                                                              Formulario para modificar usuario                               -->
<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Actualiza cuenta <?php echo remove_junk(ucwords($e_user['nombre'])); ?>
        </strong>
       </div>
       <div class="panel-body">
          <form method="post" action="edit_usuario.php?id=<?php echo (int)$e_user['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="name" class="control-label">Nombres</label>
                  <input type="name" class="form-control" name="nombre" value="<?php echo remove_junk(ucwords($e_user['nombre'])); ?>">
            </div>
            <div class="form-group">
                  <label for="username" class="control-label">Usuario</label>
                  <input type="text" class="form-control" name="usuario" value="<?php echo remove_junk(ucwords($e_user['usuario'])); ?>">
            </div>
            <div class="form-group">
              <label for="level">Nivel de usuario</label>
                <select class="form-control" name="nivel">
                  <?php foreach ($groups as $group ):?>
                   <option <?php if($group['nivel_grupo'] === $e_user['nivel']) echo 'selected="selected"';?> value="<?php echo $group['nivel_grupo'];?>"><?php echo ucwords($group['nombre_grupo']);?></option>
                <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
              <label for="status">Estado</label>
                <select class="form-control" name="estado">
                  <option <?php if($e_user['estado'] === '1') echo 'selected="selected"';?>value="1">Activo</option>
                  <option <?php if($e_user['estado'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
                </select>
            </div>
            <div class="form-group">
                  <label for="username" class="control-label">Correo Electrónico</label>
                  <input type="text" class="form-control" name="correo" value="<?php echo ucwords($e_user['correo']); ?>">
            </div>
            <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-info">Actualizar</button>
            </div>
        </form>
       </div>
     </div>
  </div>
  <!--                                                              Formulario para modificar la contraseña                                -->
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Cambiar contraseña <?php echo remove_junk(ucwords($e_user['nombre'])); ?>
        </strong>

      </div>
      <div class="panel-body">
        <form action="edit_usuario.php?id=<?php echo (int)$e_user['id'];?>" method="post" class="clearfix">
          <div class="form-group">
                <label for="password" class="control-label">Contraseña</label>
                <input type="password" class="form-control" name="nueva_clave" placeholder="Ingresa la nueva contraseña" required>
          </div>
          <div class="form-group clearfix">
                  <button type="submit" name="update-clave" class="btn btn-danger pull-right">Cambiar</button>
          </div>
        </form>
      </div>
    </div>
  </div>



  <!--                                                              Formulario para modificar la foto                                -->

<div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-heading clearfix">
            <strong>
            <span class="glyphicon glyphicon-camera"></span>
            <span>Cambiar foto <?php echo remove_junk(ucwords($e_user['nombre'])); ?></span>
          </strong>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
                <img class="img-circle img-size-2" src="uploads/users/<?php echo $e_user['imagen'];?>" alt="">
            </div>
            <div class="col-md-8">
              <form class="form" action="edit_usuario.php?id=<?php echo (int)$e_user['id'];?>" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <input type="file" name="file_upload" multiple="multiple" class="btn btn-default btn-file"/>
              </div>
              <div class="form-group">
               
                 <button type="submit" name="submit-foto" class="btn btn-warning">Cambiar</button>
              </div>
             </form>
            </div>
          </div>
        </div>
      </div>
  </div>




 </div>
<?php include_once('layouts/footer.php'); ?>
