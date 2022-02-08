<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}

include_once('layouts/header.php'); ?>
<div class="row">

  <div class="col-md-12">
    <?php echo display_msg($msg);?>
  </div>





        <div class="col-md-12">
                    <div class="panel">
                               <div class="jumbotron text-justify">
                                          <h1>DIDA INVENTIC</h1>
                                          <p>Es una aplicación para la Gestión del inventario TIC del centro<br>
                                          elaborada en FCT por alumno perteneciente al <br>
                                          2º de Ciclo de Informática del IES Diego Angulo</p>
                                          <p>Este programa es el resultado del Proyecto Integrado FCT actualizado por:<br>
                                             <ul>
                                                 <li>Raul Antonio Serra</li>
                                                
                                             </ul>
                                           <p> y tutorizado por: <br> Joaquín Hernández Toré </p>
                                          <h4>FCT 2021</h4>
                                </div>
                     </div>   
        </div>

</div>
<?php include_once('layouts/footer.php'); ?>
