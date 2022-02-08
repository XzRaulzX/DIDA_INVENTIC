<?php
   session_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
 include_once('layouts/header.php'); 
 ?>


<body style="background-image: url('libs/images/uno.jpg')">
<div class="login-page">
      
     <div class="text-center">
      <img class="logo-ini" src="libs\images\DIDA_InvenTIC_9.png">
       <h2>Gestión de Inventario TIC</h2>       
       <p>Iniciar sesión </p>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">Usuario</label>
              <input type="name" class="form-control" name="username" placeholder="Usuario">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Contraseña</label>
            <input type="password" name= "password" class="form-control" placeholder="Contraseña">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-info  pull-right">Entrar</button>
        </div>
       
    </form>
</div>
</body>
<?php include_once('layouts/footer.php'); ?>