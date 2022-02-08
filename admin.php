<?php
  $page_title = 'Admin página de inicio';
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
   page_require_level(3);
?>
<?php
/*
 $c_inc_pendientes = count_by_id_estado('incidencia',5,'!=');
 $c_inc_resueltas  = count_by_id_estado('incidencia',5,'=');
 $c_orden_pendientes = count_by_id('orden_trabajo',2,'=');
 $c_user          = count_by_id('usuarios');
 $incidencias_por_tipo = incidencias_por_tipo('5');
 $incidencias_por_area = incidencias_por_area('5');
 $ultimas_incidencias    = ultimas_incidencias('5');
 $ultimas_tareas    = ultimas_tareas('5');
 */
 $aulas_tic=zonas_tic(1);
 $departamentos_tic=zonas_tic(4);
 $dispositivos_tic=dispositivos_tic();
 $dispositivos_nf=dispositivos_estado('No Funciona');
 $dispositivos_configurar=dispositivos_estado('Falta Configurar');
 $dispositivos_obsoletos=dispositivos_estado('Obsoleto');
 $dispositivos_operativos=dispositivos_estado('Operativo');
 $all_ultimos_dispositivos_tic=ultimos_dispositivos_por_zona(5);
 $all_ultimos_dispositivos_insertados=ultimos_dispositivos_insertados(5);
 $all_dotacion=dotacion_zona(5);
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
  <div class="row">
    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-home"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $aulas_tic['total']; ?> </h2>
          <p class="text-muted">Aulas Inventariadas</p>
        </div>
       </div>
    </div>
    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $departamentos_tic['total']; ?> </h2>
          <p class="text-muted">Departamentos Inventariados</p>
        </div>
       </div>
    </div>
    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-qrcode"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $dispositivos_tic['total']; ?> </h2>
          <p class="text-muted">Dispositivos Inventariados</p>
        </div>
       </div>
    </div>
    
</div>
<div class="row">
  <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-thumbs-down"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $dispositivos_nf['total']; ?></h2>
          <p class="text-muted">No Funcionan</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
          <i class="glyphicon glyphicon-wrench"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $dispositivos_configurar['total']; ?> </h2>
          <p class="text-muted">Por Configurar</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-exclamation-sign"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $dispositivos_obsoletos['total']; ?> </h2>
          <p class="text-muted">Obsoletos</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-thumbs-up"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $dispositivos_operativos['total']; ?> </h2>
          <p class="text-muted">Operativos</p>
        </div>
       </div>
    </div>
    
</div>
  <div class="row">
   <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-bookmark"></span>
           <span>Últimos dispositivos inventariados</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
             <th class="text-center">Fecha</th>
             <th class="text-center">Dispositivo</th>
             <th class="text-center">Zona</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($all_ultimos_dispositivos_tic as  $por_zona): ?>
              <tr>
                <td><?php echo remove_junk($por_zona['fecha']); ?></td>
                <td><?php echo remove_junk($por_zona['dispositivo']); ?></td>
                <td><?php echo remove_junk($por_zona['zona']); ?></td>
                
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>
   <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-map-marker"></span>
            <span>Últimos Dispositivos Añadidos</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           
           
           <th class="text-center">Nombre</th>
           
         </tr>
       </thead>
       <tbody>
         <?php foreach ($all_ultimos_dispositivos_insertados as  $disp): ?>
         <tr>
           
           <td><?php echo remove_junk($disp['dispositivo']); ?></td>
           
        </tr>

       <?php endforeach; ?>
       </tbody>
     </table>
    </div>
   </div>
  </div>
  
 <div class="col-md-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-pushpin"></span>
          <span>Dotación por Zonas</span>
        </strong>
      </div>
      <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           
           <th class="text-center">Zona</th>
           <th class="text-center">Total Dispositivos</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($all_dotacion as  $zona): ?>
         <tr>
           <td><?php echo remove_junk($zona['zona']); ?></td>
           <td><?php echo remove_junk($zona['total']); ?></td>
          
        </tr>

       <?php endforeach; ?>
       </tbody>
     </table>
    </div>
 </div>
</div>
 </div>
 


<?php include_once('layouts/footer.php'); ?>
