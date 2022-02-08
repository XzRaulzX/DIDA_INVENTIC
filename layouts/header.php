<?php $user = current_user(); ?>
<!DOCTYPE html>
  <html lang="es">
    <head>
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['nombre']);
            else echo "DIDA_InvenTIC: Gestión Inventario";?>
    </title>
	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />


  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">



  </head>
  <body>
  <?php  if ($session->isUserLoggedIn(true)): ?>
    <header id="header">
     <div class="logo pull-left"> <a href="home.php" target="_self"><img class="img-avatar" 
      src="libs/images/DIDA_InvenTIC_9.png"></a> </div> 
      <div class="header-content">
      <div class="header-date pull-left">
        <?php 
        $apli="Administración de Inventario";
        $fecha=". [ ".date("d/m/Y  G:i a")." ]";
        echo $apli.$fecha;
        ?>
      </div>
      <div class="pull-right clearfix">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
              <img src="uploads/users/<?php echo $user['imagen'];?>" alt="user-image" class="img-circle img-inline">
              <span><?php echo remove_junk(ucfirst($user['nombre'])); ?> <i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                  <a href="perfil.php?id=<?php echo (int)$user['id'];?>">
                      <i class="glyphicon glyphicon-user"></i>
                      Perfil
                  </a>
              </li>
             <li>
                 <a href="edit_cuenta.php" title="Editar Cuenta">
                     <i class="glyphicon glyphicon-cog"></i>
                     Configuración
                 </a>
             </li>
             <li class="last">
                 <a href="logout.php">
                     <i class="glyphicon glyphicon-off"></i>
                     Salir
                 </a>
             </li>
           </ul>
          </li>
        </ul>
      </div>
     </div>
    </header>
    <div class="sidebar">
      <?php if($user['nivel'] === '0'): ?>
        <!-- super menu -->
      <?php include_once('super_menu.php');?>

      <?php elseif($user['nivel'] === '1'): ?>
        <!-- profe menu -->
      <?php include_once('profe_menu.php');?>

      <?php elseif($user['nivel'] === '2'): ?>
        <!-- gestor user -->
      <?php include_once('gestor_menu.php');?>

      <?php elseif($user['nivel'] === '3'): ?>
        <!-- técnico menu -->
      <?php include_once('tecnico_menu.php');?>

      <?php endif;?>

   </div>
<?php endif;?>

<div class="page">
  <div class="container-fluid">