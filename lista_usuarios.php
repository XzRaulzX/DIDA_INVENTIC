<?php
  $page_title = 'Lista de usuarios-clave';
  require_once('includes/load.php');
?>
<?php
// Validación de permiso de acceso a la página
 page_require_level(2);
//Busca todos los usuarios de la base de datos
 $all_users = find_all_user();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Listado de Usuarios/Clave</span>
       </strong>
         <a href="imprimir_usuarios.php" class="btn btn-info pull-right">Imprimir Lista</a>
         
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th style="width: 35%;">Nombre </th>
            <th style="width: 15%;">Usuario</th>
            <th class="text-center" style="width: 15%;">Clave</th>
            <th class="text-center" style="width: 35%;">Correo Electrónico</th>
            
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_users as $a_user): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_user['nombre']))?></td>
           <td><?php echo remove_junk(ucwords($a_user['usuario']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['clave']))?></td>
           <td><?php echo remove_junk(ucwords($a_user['correo']))?></td>
          

           
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
