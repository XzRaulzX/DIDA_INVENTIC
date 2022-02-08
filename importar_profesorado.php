<?php
require_once('includes/load.php');
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
page_require_level(2);

if (isset($_POST["import"]))
{
  
   // Analisis de la hoja de cáculo
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        // Eliminación previa de todos los profesores
  
   $result = delete_usuarios_nivel('usuarios',1);
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $nombre = "";
                
                if(isset($Row[0])) {
                    $nombre = remove_junk($Row[0]);
                    
                }
                                				
                $correo = "";
                if(isset($Row[1])) {
                    $correo = remove_junk($Row[1]);
                    $usuario=substr($correo,0,strpos($correo, "@"));
                    $clave=sha1($usuario);
                }
				
                $estado=1;
                $nivel=1;
                if (!empty($nombre) || !empty($usuario) || !empty($correo) ) {

                  // Inserción del fichero de profesorado
                    $query = "insert into usuarios (nombre,usuario,clave,correo,estado,nivel) ";
                    $query.=" values ('".$nombre."','".$usuario."','".$clave."','".$correo."',".$estado.",".$nivel.");";
                     if($db->query($query))
                              {
                                //correcto
                                $session->msg('s'," Cuenta de usuario ha sido creada");
                                //redirect('usuarios.php', false);
                              } 
                              else 
                              {
                                //Errores
                                $session->msg('d',' No se pudo importar el fichero.');
                                //redirect('importar_profesorado.php', false);
                              }
                }
             }
        
         }
         redirect('usuarios.php', false);
  }
  else
  { 
        $session->msg('d',' No se pudo importar el fichero.');
        redirect('importar_profesorado.php', false);
  }
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="favicon.ico">


<!-- Bootstrap core CSS -->
<link href="libs/css/bootstrap.min.css" rel="stylesheet">
<!-- estilo -->
<link href="libs/js/sticky-footer-navbar.css" rel="stylesheet">
<link href="libs/js/style.css" rel="stylesheet">

</head>

<body>
<header> 

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon glyphicon-cloud-upload"></span>
            <span>Importar profesorado</span>
         </strong>
         <br>!! Este proceso eliminará a todo el profesorado almacenado previamente !!
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data" class="clearfix">


            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  <label>Excel</label>
                  </span>
                  <div class="co-md-4">
                   
                  <input type="file" name="file" id="file" accept=".xls,.xlsx">
                </div>
               </div>
              </div>
      
              <div class="form-group clearfix">
                  <button type="submit" id="submit" name="import" class="btn-submit">Importar Registros</button>
               
            </div>

              
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
<?php
    $sqlSelect = "SELECT * FROM usuarios";
    $result = $db->query($sqlSelect);

if (mysqli_num_rows($result) > 0)
{
?>
        
    <table class='tutorial-table'>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Dirección de Correo</th>
                

            </tr>
        </thead>
<?php
    while ($row = mysqli_fetch_array($result)) {
?>                  
        <tbody>
        <tr>
            <td><?php  echo $row['nombre']; ?></td>
            <td><?php  echo $row['usuario']; ?></td>
            <td><?php  echo $row['correo']; ?></td>
           
        </tr>
<?php
    }
?>
        </tbody>
    </table>
<?php 
} 
?>
      <!-- Fin Contenido --> 
    </div>
  </div>
  <!-- Fin row --> 

  
</div>
<!-- Fin container -->

<script src="libs/js/jquery-1.12.4-jquery.min.js"></script> 
<script src="libs/js/bootstrap.min.js"></script>
</body>
</html>