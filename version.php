<?php
require_once('includes/load.php');
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
require_once('vendor/SpreadsheetReader_XLSX.php');
page_require_level(2);
include_once('layouts/header.php'); 
?>
<?php
// Analisis de la hoja de cáculo

$targetPath = 'uploads/version.xlsx';
//move_uploaded_file('uploads/version.xlsx', $targetPath);
//$Reader = new SpreadsheetReader($targetPath);
$Reader= new SpreadsheetReader_XLSX($targetPath);

        // row(0) orden
        // row(1) fecha
        // row(2) modulo
        // row(3) tipo (mejora, error,,,)
        // row(4) descripcion

        
$sheetCount = count($Reader->sheets());
?>

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
          <span>Notas de la versión</span>
       </strong>
         
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" colspan="2">Versión</th>
            <?php 
                  $primera=true;
                  for($i=0;$i<$sheetCount;$i++)
                       {
                 
                       $Reader->ChangeSheet($i);
                        foreach($Reader as $fila)
                          { ?>
                          <th class="text-center"><?php echo $fila[1]; $primera=false;?></th>
                        <?php 
                        if (!$primera){break;}
                        }
                      }
              ?>
          </tr>
          <tr>
            <th class="text-center" style="width: 50px;">Orden</th>
            <th class="text-center" style="width: 5%;">Fecha</th>
            <th class="text-center" style="width: 15%;">Módulo</th>
            <th class="text-center" style="width: 5%;">Tipo</th>
            <th class="text-center" style="width: 75%;">Descripción</th>
          </tr>
        </thead>
        <tbody>
        <?php 
            for($i=0;$i<$sheetCount;$i++)
                 {

                 $Reader->ChangeSheet($i);
                 
                  foreach($Reader as $fila)
                    {
                      if ($fila[0]<>0) {
                      
                    ?>
                       <tr>
                       <td class="text-center"><?php echo $fila[0];?></td>
                       <td class="text-center"><?php echo remove_junk($fila[1])?></td>
                       <td><?php echo remove_junk($fila[2])?></td>
                       <td class="text-center"><?php echo remove_junk($fila[3])?></td>
                       <td><?php echo remove_junk($fila[4])?></td>
                               
                    </tr>
                  <?php 
                 
                }
                }
              }
        ?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>