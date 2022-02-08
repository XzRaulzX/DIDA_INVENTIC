<?php
  $page_title = 'Editar Tipo de Memoria';
  require_once('includes/load.php');
  // Nivel de permiso de la página
  page_require_level(0);
  $linea_memoria=find_by_cod_memoria('tipo_memoria',(int)$_GET['id']);
 
?>
<?php
 if(isset($_POST['edit_tipo_memoria']))
 {
           $req_fields = array('codigo','descripcion','velocidad');
           validate_fields($req_fields);
           if(empty($errors))
                  {
                   $p_codigo  = remove_junk($db->escape($_POST['codigo']));
                   $p_descripcion   = remove_junk($db->escape($_POST['descripcion']));
                   $p_velocidad   = remove_junk($db->escape($_POST['velocidad']));
                   $p_cod_tipo_memoria=$linea_memoria['cod_tipo_memoria'];

                   $query  = "UPDATE tipo_memoria  SET ";
                   $query .=" codigo='{$p_codigo}',descripcion='{$p_descripcion}',velocidad='{$p_velocidad}'";
                   $query .=" WHERE cod_tipo_memoria ={$p_cod_tipo_memoria}";
                   if ($p_cod_tipo_memoria==1)
                            {  
                               $session->msg('s',' Este registro NO puede ser modificado.');
                               redirect('administrar_memoria.php', false);
                            }
                   else
                       {
                             $result = $db->query($query);
                             if($result && $db->affected_rows() === 1)
                                   {
                                     $session->msg('s',"Tipo de Memoria actualizada con éxito. ");
                                     redirect('administrar_memorias.php?id='.$linea_memoria['cod_tipo_memoria'], false);
                                   } 
                                   else 
                                   {
                                     $session->msg('d',' Lo siento, actualización falló.');
                                      redirect('administrar_memorias.php?id='.$linea_memoria['cod_tipo_memoria'], false);
                                   }

                        }
                  }
            else{
                       $session->msg("d", $errors);
                       redirect('administrar_memoria.php',false);
            }
                

              
}
?>
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
            <span class="glyphicon glyphicon-menu-hamburger"></span>
            <span>Modificar Tipo de Memoria</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="edit_tipo_memoria.php?id=<?php echo (int)$linea_memoria['cod_tipo_memoria'];?>"class="clearfix">


            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-tag"></i>
                  </span>
                  <input type="text" class="form-control" name="codigo" value="<?php echo remove_junk($linea_memoria['codigo']);?>">
               </div>
              </div>


              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-pushpin"></i>
                  </span>
                  

                  <input type="text" class="form-control" name="descripcion" value="<?php echo remove_junk($linea_memoria['descripcion']);?>">

               </div>
              </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-signal"></i>
                  </span>
                  

                  <input type="text" class="form-control" name="velocidad" value="<?php echo remove_junk($linea_memoria['velocidad']);?>">

               </div>
              </div>
                                     

             

              <div class="form-group clearfix">
             
               <button type="submit" name="edit_tipo_memoria" class="btn btn-primary">Modificar Tipo de Memoria</button>
            </div>

              
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
