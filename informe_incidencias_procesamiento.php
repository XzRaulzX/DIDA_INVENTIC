<?php
$page_title = 'Procesamiento Informe Incidencias';
$results = '';
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
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
                        $prioridad= remove_junk($db->escape($_POST['prioridad']));
                        $estado= remove_junk($db->escape($_POST['estado']));
                                /* Fechas tipo=1
                                   estado +1
                                   prioridad +2
                                   fechas(0)
                                   fecha + estado (1)
                                   fecha + prioridad (2)
                                   fecha + estado + prioridad (3)

                                */
                        $tipo_informe=0;
                        $estado=(int)$estado;
                        $prioridad=(int)$prioridad;
                        if ($estado <>-1){$tipo_informe=1;}
                        if ($prioridad<>-1){$tipo_informe=$tipo_informe+2;}
                      
                        $results=informe_incidencias($start_date,$end_date,$tipo_informe,$estado,$prioridad);
                  
              
              else:
                $session->msg("d", $errors);
                redirect('informe_incidencias.php', false);
              endif;

  } 
  else {
    $session->msg("d", "Selecciona un Rango de fechas");
    redirect('informe_incidencias.php', false);
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
           <h1>INFORME DE INCIDENCIAS</h1>
           <h3> 
           <?php
           echo 'RANGO DE FECHAS: <strong>' . $start_date. ' a '. $end_date.' </strong><br>';
           if ($tipo_informe==1){echo 'ESTADO: <strong>' . Dame_Estado_Incidencia($estado). ' </strong>';}
           if ($tipo_informe==2){echo 'PRIORIDAD: <strong>' . Dame_Prioridad($prioridad). ' </strong>';}
           if ($tipo_informe==3){echo 'ESTADO: <strong>' . Dame_Estado_Incidencia($estado). ' </strong><br>';
                                 echo 'PRIORIDAD: <strong>' . Dame_Prioridad($prioridad). ' </strong>';}
             
           
            ?>
           </h3>
       </div>
      <table class="table table-border">
        <thead>
          <?php 
          if ($tipo_informe==0){

                      echo "<tr>";
                          echo "<th>Fecha</th>";
                          echo "<th>Lugar</th>";
                          echo "<th>Incidencia</th>";
                          echo "<th>Prioridad</th>";
                          echo "<th>Estado</th>";
                      
                      echo"</tr>";
                    }

          if ($tipo_informe==1){

                      echo "<tr>";
                          echo "<th>Fecha</th>";
                          echo "<th>Lugar</th>";
                          echo "<th>Incidencia</th>";
                          echo "<th>Prioridad</th>";
                          
                      
                      echo"</tr>";
                    }
          if ($tipo_informe==2){

                      echo "<tr>";
                          echo "<th>Fecha</th>";
                          echo "<th>Lugar</th>";
                          echo "<th>Incidencia</th>";
                          
                          echo "<th>Estado</th>";
                      
                      echo"</tr>";
                    }
          if ($tipo_informe==3){

                      echo "<tr>";
                          echo "<th>Fecha</th>";
                          echo "<th>Lugar</th>";
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
                  echo '<td>'.remove_junk($result['fecha_incidencia']).'</td>';
                  echo '<td>'.remove_junk($result['lugar']).'</td>';
                  echo '<td>'.remove_junk($result['descripcion']).'</td>';
                  echo '<td>'.remove_junk($result['prioridad']).'</td>';
                  echo '<td>'.remove_junk($result['estado']).'</td>';
                }
               if ($tipo_informe==1)
              {
                  echo '<td>'.remove_junk($result['fecha_incidencia']).'</td>';
                  echo '<td>'.remove_junk($result['lugar']).'</td>';
                  echo '<td>'.remove_junk($result['descripcion']).'</td>';
                  echo '<td>'.remove_junk($result['prioridad']).'</td>';
                 
                }
               if ($tipo_informe==2)
              {
                  echo '<td>'.remove_junk($result['fecha_incidencia']).'</td>';
                  echo '<td>'.remove_junk($result['lugar']).'</td>';
                  echo '<td>'.remove_junk($result['descripcion']).'</td>';
                  
                  echo '<td>'.remove_junk($result['estado']).'</td>';
                }
               if ($tipo_informe==3)
              {
                  echo '<td>'.remove_junk($result['fecha_incidencia']).'</td>';
                  echo '<td>'.remove_junk($result['lugar']).'</td>';
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
           <td > Total Incidencias:<strong>[ <?php echo $total_registros;?> ]</strong></td>
           
         </tr>
        
        </tfoot>
      </table>
    </div>
  <?php
    else:
        $session->msg("d", "No se encontraron incidencias. ");
        redirect('informe_incidencias.php', false);
     endif;
  ?>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>
