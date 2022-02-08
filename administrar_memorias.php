<?php
  $page_title = 'Administrar Tipos de Memoria';
  require_once('includes/load.php');
  // Nivel de permiso de la página
   page_require_level(0);
  $all_memorias = find_all('tipo_memoria');
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
          <span>Tipos de Memoria</span>
       </strong>
         <div class="pull-right">
           <a href="add_memoria.php" class="btn btn-primary">Agregar Tipo de Memoria</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 5%;">#</th>
                <th class="text-center" style="width: 7%;">Código</th>
                <th class="text-center" style="width: 65%;">Descripción </th>
                <th class="text-center" style="width: 7%;">Velocidad </th>
                <th class="text-center" style="width: 10%;">Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($all_memorias as $memoria):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>                
                <td class="text-center"> <?php echo remove_junk($memoria['codigo']); ?></td>
                <td> <?php echo remove_junk($memoria['descripcion']); ?></td>
                <td class="text-center"> <?php echo remove_junk($memoria['velocidad']); ?></td>
                
                

                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_tipo_memoria.php?id=<?php echo (int)$memoria['cod_tipo_memoria'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_tipo_memoria.php?id=<?php echo (int)$memoria['cod_tipo_memoria'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
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
