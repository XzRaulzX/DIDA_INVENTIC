<?php
$page_title = 'PRocesamiento Informe Incidencias';
$results = '';
  require_once('includes/load.php');
  // nivel de acceso 
   page_require_level(3);
?>
<!--                                                        PHP                                           -->




<?php
  if(isset($_POST['submit'])){
    $req_dates = array('desde','hasta');
    validate_fields($req_dates);

              if(empty($errors)):
                        $start_date   = remove_junk($db->escape($_POST['desde']));
                        $end_date     = remove_junk($db->escape($_POST['hasta']));
                        $actuacion= remove_junk($db->escape($_POST['tipo_actuacion']));
                        $estado= remove_junk($db->escape($_POST['estado']));
                                /* Fechas tipo=1
                                   estado +1
                                   actuacion +2
                                   fechas(0)
                                   fecha + estado (1)
                                   fecha + actuacion (2)
                                   fecha + estado + actuacion (3)

                                */
                        $tipo_informe=0;
                        $estado=(int)$estado;
                        $actuacion=(int)$actuacion;
                        if ($estado <>-1){$tipo_informe=1;}
                        if ($actuacion<>-1){$tipo_informe=$tipo_informe+2;}
                      
                        $results=informe_tareas($start_date,$end_date,$tipo_informe,$estado,$actuacion);
                  
              
              else:
                $session->msg("d", $errors);
                redirect('informe_tareas.php', false);
              endif;

  } 
  else {
    $session->msg("d", "Selecciona un Rango de fechas");
    redirect('informe_tareas.php', false);
  }
  
?>



<!--                                                           HTML              -->
<!doctype html>
<html lang="es-ES">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Informe de Incidencias</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
      <link rel="stylesheet" type="text/css" href="libs/css/incidencias.css">
</head>
<body>
  <?php if($results): ?>
    <div class="page-break">
       <div class="informe-head">
           <h1>INFORME DE TAREAS (ÓRDENES DE TRABAJO)</h1>
           <h3> 
           <?php
           echo 'RANGO DE FECHAS: <strong>' . $start_date. ' a '. $end_date.' </strong><br>';
           if ($tipo_informe==1){echo 'ESTADO: <strong>' . Dame_Estado_Tarea($estado). ' </strong>';}
           if ($tipo_informe==2){echo 'ACTUACIÓN: <strong>' . Dame_Actuacion($actuacion). ' </strong>';}
           if ($tipo_informe==3){echo 'ESTADO: <strong>' . Dame_Estado_Tarea($estado). ' </strong><br>';
                                 echo 'ACTUACIÓN: <strong>' . Dame_Actuacion($actuacion). ' </strong>';}
             
           
            ?>
           </h3>
       </div>
      <table class="table table-border">
        <thead>
          <?php 
         
          if ($tipo_informe==0){

                      echo "<tr>";
                          echo "<th>Fecha</th>";
                          echo "<th>Tarea</th>";
                          echo "<th>Actuación</th>";
                          echo "<th>Estado</th>";
                      
                      echo"</tr>";
                    }

          if ($tipo_informe==1){

                      echo "<tr>";
                          echo "<th>Fecha</th>";
                          echo "<th>Tarea</th>";
                          echo "<th>Actuación</th>";
                          
                      
                      echo"</tr>";
                    }
          if ($tipo_informe==2){

                      echo "<tr>";
                          echo "<th>Fecha</th>";
                          echo "<th>Tarea</th>";
                          echo "<th>Estado</th>";
                      
                      echo"</tr>";
                    }
          if ($tipo_informe==3){

                      echo "<tr>";
                          echo "<th>Fecha</th>";
                          echo "<th>Incidencia</th>";
                          
                      
                      echo"</tr>";
                    }
          ?>
        </thead>
        <tbody class="tbody">
          <?php 
            $total_registros=0;
          foreach($results as $result): ?>
           <tr>
             
              <?php 
            
              if ($tipo_informe==0)
              {
                  echo '<td>'.remove_junk($result['fecha_inicio']).'</td>';
                  
                  echo '<td>'.remove_junk($result['descripcion']).'</td>';
                  
                  echo '<td>'.remove_junk($result['actuacion']).'</td>';
                  echo '<td>'.remove_junk($result['estado']).'</td>';
                }
               if ($tipo_informe==1)
              {
                  echo '<td>'.remove_junk($result['fecha_inicio']).'</td>';
                 
                  echo '<td>'.remove_junk($result['descripcion']).'</td>';
                  echo '<td>'.remove_junk($result['actuacion']).'</td>';
                 
                }
               if ($tipo_informe==2)
              {
                  echo '<td>'.remove_junk($result['fecha_inicio']).'</td>';
                  echo '<td>'.remove_junk($result['descripcion']).'</td>';
                  
                  echo '<td>'.remove_junk($result['estado']).'</td>';
                }
               if ($tipo_informe==3)
              {
                  echo '<td>'.remove_junk($result['fecha_inicio']).'</td>';
                 
                  echo '<td>'.remove_junk($result['descripcion']).'</td>';
                 
                }
                ?>

          </tr>
        <?php 
        $total_registros++;
        endforeach; ?>
        </tbody>
       <tfoot>
         <tr class="text-left">
           <td > Total Órdenes de Trabajo:<strong>[ <?php echo $total_registros;?> ]</strong></td>
           
         </tr>
        
        </tfoot>
      </table>
    </div>
  <?php
    else:
        $session->msg("d", "No se encontraron incidencias. ");
        redirect('informe_tareas.php', false);
     endif;
  ?>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>
