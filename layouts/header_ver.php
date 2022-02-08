<!DOCTYPE html>
  <html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>
    </title>
	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />


  </head>
  <body>
    <header id="header">
      <div class="logo pull-left"><img class="logo-ini" src="libs/images/logo_adadi.png"></div>
      <div class="header-content">
      <div class="header-date pull-left">
        <?php 
        $apli="Administración de Incidencias TIC";
        $fecha=". [ ".date("d/m/Y  G:i a")." ]";
        echo $apli.$fecha;
        ?>
      </div>
  
