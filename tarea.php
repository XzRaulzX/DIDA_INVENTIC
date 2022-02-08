<?php
  $page_title = 'Gestión de Tareas';
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(3);
  $ordenes = find_all_ordenes('orden_trabajo');

?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
          <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-tasks"></span>
            <span>ÓRDENES DE TRABAJO (TAREAS)</span>
         </strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 30%;">Incidencia</th>
                <th class="text-center" style="width: 35%;"> Descripción de la Tarea a realizar </th>
                <th class="text-center" style="width: 5%;"> Tipo de Actuación </th>
                <th class="text-center" style="width: 5%;"> Estado </th>
                <th class="text-center" style="width: 10%;"> Fecha Inicio </th>
                <th class="text-center" style="width: 10%;"> Fecha Final </th>
                <th class="text-center" style="width: 5%;"> Acciones </th>
              </tr>
            </thead>
            <?php $actual=null; ?>
            <tbody>
              <?php foreach ($ordenes as $tarea):?>
              <tr>
                <?php 
                    if (is_null($actual))
                      {
                        $actual=find_by_id('incidencia',$tarea['id_incidencia']);
                        $cargado=null;
                      }
                    else
                    {
                      $cargado=find_by_id('incidencia',$tarea['id_incidencia']);
                    }



                
                
                
                                        if (is_null($cargado)) 
                                            {
                                              echo "<td class='text-center' style='background-color:#D6EAF8'>";
                                              echo "<b>".remove_junk($actual['descripcion'])."</b>";
                                              
                                            }
                                        elseif ($cargado <> $actual) {
                                              echo "<td class='text-center' style='background-color:#D6EAF8'>";
                                              echo "<b>".remove_junk($cargado['descripcion'])."</b>";
                                              $actual=$cargado;
                                        }
                                        else
                                        {
                                          echo "<td class='text-center' style='background-color:white'>";
                                          echo "----";
                                        }    



                 ?>
                                          
                 
                           
                  <td> <?php echo remove_junk($tarea['descripcion']); ?></td>



<!-- Tipo de Actuación -->
                <?php $tipo_actuacion=$tarea['tipo_actuacion']; ?>
                <?php $denominacion_actuacion=0; ?>

                <?php switch($tipo_actuacion) {
                    case 0:  $denominacion_actuacion="Ninguna"; break;
                    case 1:  $denominacion_actuacion="Reparación"; break;
                    case 2:  $denominacion_actuacion="Sustitución"; break;
                    case 3:  $denominacion_actuacion="Compra"; break;
                    case 4:  $denominacion_actuacion="Instalación"; break;
                    case 5:  $denominacion_actuacion="Configuración"; break;
                    case 6:  $denominacion_actuacion="Eliminación"; break;
                    default:  $denominacion_estado="Ninguna"; };?>

                <td class="text-center"> <?php echo $denominacion_actuacion; ?></td>
<!-- Estado -->
                <?php $tipo_estado=$tarea['estado']; ?>
                <?php $denominacion_estado=0; ?>

                <?php switch($tipo_estado) {
                    case 0:  $denominacion_estado="Generada"; $color="orden_generada"; break;
                    case 1:  $denominacion_estado="En Proceso..."; $color="orden_en_proceso"; break;
                    case 2:  $denominacion_estado="Finalizada"; $color="orden_finalizada"; break;
                    default:  $denominacion_estado="Ninguno"; };?>

                <td class=<?php echo $color ?>> <?php echo $denominacion_estado; ?></td>
                <td class="text-center"> <?php echo remove_junk($tarea['fecha_inicio']); ?></td>
                <td class="text-center"> <?php echo remove_junk($tarea['fecha_fin']); ?></td>
                
                <td class="text-center">
                  <div class="btn-group">
                    <a href="tarea_en_proceso.php?id=<?php echo (int)$tarea['id'];?>" class="btn btn-info btn-xs"  title="Cambiar estado En proceso" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-refresh"></span>
                    </a>
                     <a href="tarea_finalizada.php?id=<?php echo (int)$tarea['id'];?>" class="btn btn-danger btn-xs"  title="Finalizar Tarea" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-ok"></span>
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



