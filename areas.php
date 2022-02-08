<?php
  $page_title = 'Zonas';
  require_once('includes/load.php');
  // Nivel de permiso de la página
   page_require_level(0);
  $zonas = find_all('zona');
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
          <span class="glyphicon glyphicon-map-marker"></span>
          <span>Zonas</span>
       </strong>
         <div class="pull-right">
           <a href="add_zona.php" class="btn btn-primary">Agregar Zona</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 5%;">#</th>
                <th class="text-center" style="width: 15%;"> Numero </th>
                <th class="text-center" style="width: 30%;"> Ubicacion </th>
                <th class="text-center" style="width: 10%;"> Planta </th>
                <th class="text-center" style="width: 15%;"> Punto de acceso </th>
                <th class="text-center" style="width: 15%;"> Switch </th>
                <th class="text-center" style="width: 15%;"> Cortinas </th>
                <th class="text-center" style="width: 15%;"> Capacidad </th>
                <th class="text-center" style="width: 15%;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($zonas as $zona):?>
                <?php $tipo_ubicacion=$zona['cod_tipo_zona']; ?>
                <?php $denominacion_ubicacion=0; ?>
                <?php switch($tipo_ubicacion) {
                    case 0:  $denominacion_ubicacion="Espacio Libre"; break;
                    case 1:  $denominacion_ubicacion="Aulario del Centro"; break;
                    case 2:  $denominacion_ubicacion="Salon de actos"; break;
                    case 3:  $denominacion_ubicacion="Secretaría"; break;
                    case 4:  $denominacion_ubicacion="Departamento"; break;
                    case 5:  $denominacion_ubicacion="Sala del Profesorado"; break;
                    case 6:  $denominacion_ubicacion="Gimnasio"; break;
                    case 7:  $denominacion_ubicacion="Biblioteca del Centro"; break;
                    case 8:  $denominacion_ubicacion="Zona Comun";}?>
                    
              <tr>
                <td class="text-center"><?php echo count_id();?></td>              
                <td class="text-center"><?php echo remove_junk($zona['numero']); ?></td>
                <td> <?php echo $denominacion_ubicacion; ?></td>
                <td class="text-center"> <?php echo remove_junk($zona['planta']); ?></td>
                <!-- Tipo de Ubicación --->
                

                

                <td class="text-center"><?php echo remove_junk($zona['punto_acceso']); ?></td>
                <td class="text-center"><?php echo remove_junk($zona['switch']); ?></td>
                <td class="text-center"><?php echo remove_junk($zona['cortinas']); ?></td>
                <td class="text-center"><?php echo remove_junk($zona['capacidad']); ?></td>

                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_area.php?id=<?php echo (int)$zona['cod_zona'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_zona.php?id=<?php echo remove_junk($zona['cod_zona']);?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
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
