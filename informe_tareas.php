<?php
$page_title = 'Informe de Incidencias';
  require_once('includes/load.php');
  // Checkin del nivel de permiso
   page_require_level(3);
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
 
          <strong>
            <span class="glyphicon glyphicon-print"></span>
            <span>INFORME DE TAREAS</span>
         </strong>
        </div>
      
      <div class="panel-body">
          <form class="clearfix" method="post" action="informe_tareas_procesamiento.php">
          
            <div class="form-group">
              <label class="form-label">Rango de fechas</label>
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input type="text" class="datepicker form-control" name="desde" placeholder="Desde">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  <input type="text" class="datepicker form-control" name="hasta" placeholder="Hasta">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
<div class="row">
     <div class="col-md-6">
              <div class="form-group">
              <label class="form-label">Tipo de Actuación</label>
                <div class="input-group">
                  <span class="input-group-addon">
                      <i class="glyphicon glyphicon-wrench"></i>
                     </span>
                  <select class="form-control" name="tipo_actuacion">
                      <option value="-1">Selecciona un Tipo de Actuación</option>
                      <option value="0">Ninguna</option>
                      <option value="1">Reparación</option>
                      <option value="2">Sustitución</option>
                      <option value="3">Compra</option>
                      <option value="4">Instalación</option>
                      <option value="5">Configuración</option>
                      <option value="6">Eliminación</option>
                     
                    
                    </select>
                </div>
            </div>
          </div>

<div class="row">
     <div class="col-md-6">
         <div class="form-group">
              <label class="form-label">Estado</label>
                <div class="input-group">
                  <span class="input-group-addon">
                      <i class="glyphicon glyphicon-pushpin"></i>
                     </span>
                   <select class="form-control" name="estado">
                      <option value="-1">Selecciona un Estado</option>
                      <option value="0">generada</option>
                      <option value="1">en proceso</option>
                      <option value="2">finalizada</option>
                                       

                     
                    
                    </select>
                </div>
            </div>
</div>
</div>

            <div class="form-group">
                 <button type="submit" name="submit" class="btn btn-primary">Generar Informe de Tareas</button>
            </div>
          </form>
      </div>

    </div>
  </div>

</div>
<?php include_once('layouts/footer.php'); ?>
