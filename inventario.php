<?php
  $page_title = 'Administrar Inventario';
  require_once('includes/load.php');
  // Nivel de GEstor TIC (2)
   page_require_level(2);
  $all_inventario = find_all_inventario();
  
 
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
          <span class="glyphicon glyphicon-briefcase"></span>
          <span>Inventario</span>
       </strong>
          
         <div class="pull-right">
           <a href="add_inventario.php" class="btn btn-primary">Añadir a Inventario</a>
         </div>
       

        </div>
        <div class="panel-body">
          <table class="table table-bordered" name="tabla">
            <thead>
              <tr>
                
                
                <th class="text-center" style="width: 10%;"> Fecha Revision </th>
                <th class="text-center" style="width: 5%;"> Zona </th>
                <th class="text-center" style="width: 10%;"> Dispositivo </th>
                <th class="text-center" style="width: 7%;"> Estado </th>
                <th class="text-center" style="width: 7%;"> Tipo Memoria </th>
                <th class="text-center" style="width: 7%;"> RAM 1 </th>
                <th class="text-center" style="width: 7%;"> RAM 2 </th>
                <th class="text-center" style="width: 7%;"> RAM 3 </th>
                <th class="text-center" style="width: 7%;"> RAM 4 </th>
                <th class="text-center" style="width: 10%;"> Tipo Almacenamiento </th>
                <th class="text-center" style="width: 7%;"> Alm_1 </th>
                <th class="text-center" style="width: 7%;"> Alm_2 </th>
                <th class="text-center" style="width: 7%;"> Conexion </th>
                <th class="text-center" style="width: 20%;"> Acciones </th>
              </tr>
            </thead>
            
            <tbody>
              <?php foreach ($all_inventario as $inventario):?>
              <tr>
                           


                
                <td class="text-center"> <?php echo remove_junk($inventario['fecha_revision']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inventario['Zona']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inventario['Dispositivo']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inventario['estado']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inventario['Memoria']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inventario['ram_1']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inventario['ram_2']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inventario['ram_3']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inventario['ram_4']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inventario['tipo_almacenamiento']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inventario['almacenamiento_1']); ?></td>
                <td class="text-center"> <?php echo remove_junk($inventario['almacenamiento_2']); ?></td>            
                <td class="text-center"> <?php echo remove_junk($inventario['conexion_wifi']); ?></td>


                <td class="text-center">
                  <div class="btn-group">
                   

                   
                    
                    
                    <a href="edit_inventario.php?id=<?php echo (int)$inventario['cod_inventario'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_inventario.php?id=<?php echo (int)$inventario['cod_inventario'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
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
