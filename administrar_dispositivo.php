<?php
  $page_title = 'Administrar Dispositivos';
  require_once('includes/load.php');
  // Nivel de permiso de la página
   page_require_level(0);
  $t_incidencias = find_all('dispositivo');
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
          <span class="glyphicon glyphicon-exclamation-sign"></span>
          <span>Dispositivos</span>
       </strong>
         <div class="pull-right">
           <a href="add_dispositivo.php" class="btn btn-primary">Agregar Dispositivo</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 5%;">#</th>
                <th class="text-center" style="width: 15%;">Nombre</th>
                <th class="text-center" style="width: 65%;">Descripción </th>
                <th class="text-center" style="width: 15%;">Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($t_incidencias as $t_inc):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>                
                <td class="text-center"> <?php echo remove_junk($t_inc['nombre']); ?></td>
                <td> <?php echo remove_junk($t_inc['descripcion']); ?></td>
                
                

                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_tipo_incidencia.php?id=<?php echo (int)$t_inc['cod_dispositivo'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_tipo_incidencia.php?id=<?php echo (int)$t_inc['cod_dispositivo'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
