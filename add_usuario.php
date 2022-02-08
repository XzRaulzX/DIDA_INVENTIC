<?php
  $page_title = 'Agregar usuarios';
  require_once('includes/load.php');
 // Validación de permiso de acceso a la página
  page_require_level(0);
  $groups = find_all('grupos_usuario');
?>
<?php
  if(isset($_POST['add_usuario'])){

   $req_fields = array('nombre','usuario','clave','nivel' ,'estado','correo');
   validate_fields($req_fields);

   if(empty($errors))
   {
      
       $name   = remove_junk($db->escape($_POST['nombre']));
       $username   = remove_junk($db->escape($_POST['usuario']));
       $password   = remove_junk($db->escape($_POST['clave']));
       $user_nivel = (int)$db->escape($_POST['nivel']);
       $user_estado = (int)$db->escape($_POST['estado']);
       $user_correo =remove_junk($db->escape($_POST['correo']));
       $password = sha1($password);
       $user_ultima_entrada=make_date();
 
       $query = "INSERT INTO usuarios (";
                            $query .="nombre,usuario,clave,nivel,estado,correo,ultima_entrada";
                            $query .=") VALUES (";
                            $query .=" '{$name}', '{$username}', '{$password}', '{$user_nivel}','{$user_estado}','{$user_correo}','{$user_ultima_entrada}'";
                            $query .=")";
                            if($db->query($query))
                              {
                                //sucess
                                $session->msg('s'," Cuenta de usuario ha sido creada");
                                redirect('add_usuario.php', false);
                              } 
                              else 
                              {
                                //failed
                                $session->msg('d',' No se pudo crear la cuenta.');
                                redirect('add_usuario.php', false);
                              }

       
      
  }     
     else{
          $session->msg("d", $errors);
          redirect('add_usuario.php',false);
          }



      
 }
?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar usuario</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form  method="post" action="add_usuario.php">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre completo" required>
            </div>
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" class="form-control" name="usuario" placeholder="Nombre de usuario">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name ="clave"  placeholder="Contraseña">
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="text" class="form-control" name ="correo"  placeholder="Correo Electrónico">
            </div>
            <div class="form-group">
              <label for="level">Nivel de usuario</label>
                <select class="form-control" name="nivel">
                  <?php foreach ($groups as $group ):?>
                   <option value="<?php echo $group['nivel_grupo'];?>"><?php echo ucwords($group['nombre_grupo']);?></option>
                <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
          <label for="status">Estado</label>
              <select class="form-control" name="estado">
                <option <?php if($e_group['estado'] === '1') echo 'selected="selected"';?> value="1"> Activo </option>
                <option <?php if($e_group['estado'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
               
              </select>
        </div>
            
            <div class="form-group clearfix">
             
              <button type="submit" name="add_usuario" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
