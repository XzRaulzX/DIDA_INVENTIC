<?php
// Busca las incidencias generadas por el usuario
// Envia un correo con las incidencias ordenadas 
  require_once('includes/load.php');
  // Validación de permiso de acceso a la página
  page_require_level(3);
  $results = genera_informe_incidencias((int)$_GET['id']);
  $usuario = find_by_id('usuarios',(int)$_GET['id']);   
    
     if($results){

                // Generación del cuerpo del correo
                $asunto="ADADI.- INCIDENCIAS GENERADAS POR EL USUARIO";
                $cuerpo="<b>LISTADO DE INCIDENCIAS</b>";
                $cuerpo.="<hr>";
                $contador=0;
                $correo = $usuario['correo'];
                foreach($results as $incidencia)
                {
                  $cuerpo.="<pre>";
                  $cuerpo.="ORDEN: ".$contador."<br>";
                  $cuerpo.="      <b>Fecha Incidencia: </b>".$incidencia['fecha']."<br>";
                  $cuerpo.="                    <b>Descripción:  </b>".$incidencia['incidencia']."<br>";
                  $cuerpo.="                    <b>Área:  </b>".$incidencia['area']."<br>";
                  $cuerpo.="                    <b>Tipo de Incidencia:  </b>".$incidencia['tipo']."<br>";
                  $cuerpo.="                    <b>Prioridad:  </b>".$incidencia['prioridad']."<br>";
                  $cuerpo.="                    <b>Estado:  </b>".$incidencia['estado']."<br>";
                  $cuerpo.="<hr>";
                  $contador++;
                } ;
                $cuerpo.="<hr>";
                
                $cuerpo.="<b>Total Incidencias puestas: </b>".$contador;
                $cuerpo.="</pre>";
                Envia_Correo_Simple($correo,$asunto,$cuerpo);
                $session->msg('s',"Información enviada con éxito");
                redirect('enviar_info.php?id='.(int)$usuario['id'], false);
                
                  } 
                  
      else {
      
              $session->msg('d',' Lo siento, Envio de información fallida.');
              redirect('enviar_info.php?id='.(int)$usuario['id'], false);
       }

?>                  