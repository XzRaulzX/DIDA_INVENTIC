<?php
  require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Función que busca todas los registros de una tabla dada por nombre
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}

/*--------------------------------------------------------------*/
/* Función que ejecuta una query
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  Función que busca en una tabla un id concreto
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
/*  Función que busca en una tabla un cod_dispositivo concreto
/*--------------------------------------------------------------*/
function find_by_cod_dispositivo($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE cod_dispositivo='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/*  Función que busca en una tabla un cod_tipo_memoria concreto
/*--------------------------------------------------------------*/
function find_by_cod_memoria($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE cod_tipo_memoria='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/*  Función que busca en una tabla un cod concreto
/*--------------------------------------------------------------*/
function find_by_zonas($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE cod_zona='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/*  Función que busca en una tabla de inventario uno en concreto
/*--------------------------------------------------------------*/
function find_by_inventario($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE cod_inventario='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
/* Función que busca las ordenes
/*--------------------------------------------------------------*/
function find_all_ordenes($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." ORDER BY id_incidencia ASC");
   }
}

/*--------------------------------------------------------------*/
/* Function que borra de una tabla un registro dado por id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}


/*--------------------------------------------------------------*/
/* Function que borra de una tabla un registro dado por cod_zona
/*--------------------------------------------------------------*/
function delete_by_zonas($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE cod_zona=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}


/*--------------------------------------------------------------*/
/* Function que borra de una tabla un registro dado por cod_inventario
/*--------------------------------------------------------------*/
function delete_by_inventario($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE cod_inventario=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Function que borra de una tabla un registro dado por cod_inventario
/*--------------------------------------------------------------*/
function delete_by_tipo_memoria($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE cod_tipo_memoria=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Function que borra de una tabla un registro dado por cod_dipositivos
/*--------------------------------------------------------------*/
function delete_by_dispositivo($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE cod_dispositivo=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

/*--------------------------------------------------------------*/
/* Function que borra de la tabla de usuarios a los profesores
/*--------------------------------------------------------------*/
function delete_usuarios_nivel($table,$nivel)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE nivel=". $db->escape($nivel);
    
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Función que nos devuelve el id del u´ltimo registro de una tabla
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determina si exist la tabla en la base de datos
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
  /* Función que intenta autentificar al usuario/clave  contra la tabla de usuarios
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT id,usuario,clave,nivel FROM usuarios WHERE usuario ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['clave'] ){
        return $user['id'];
      }
    }
   return false;
  }
  

  /*--------------------------------------------------------------*/
  
  /* Busca el usuario actual dado por el identificador de la sesión
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('usuarios',$user_id);
        endif;
      }
    return $current_user;
  }
  /*--------------------------------------------------------------*/
  /* Busca TODOS los usuarios
  /* HAce un join de usuarios y grupos_usuarios
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.nombre,u.usuario,u.clave,u.nivel,u.estado,u.imagen,u.correo,u.ultima_entrada,";
      $sql .="g.nombre_grupo ";
      $sql .="FROM usuarios u ";
      $sql .="LEFT JOIN grupos_usuario g ";
      $sql .="ON g.nivel_grupo=u.nivel ORDER BY u.nombre ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Busca todas las incidencias ordenadas por fecha incidencia
  /*--------------------------------------------------------------*/

    function find_all_inventario(){
      global $db;
      $results = array();
      $sql = "SELECT i.*,a.numero as Zona,ti.nombre as Dispositivo,tm.codigo as Memoria";
      $sql .=" FROM inventario i, zona a, dispositivo ti, tipo_memoria tm";
      $sql .=" where i.cod_dispositivo=ti.cod_dispositivo and i.cod_zona=a.cod_zona and i.cod_tipo_memoria=tm.cod_tipo_memoria";
      $sql .=" ORDER BY i.fecha_revision ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Buscar incidencia por id
  /*--------------------------------------------------------------*/

    function find_incidencia_by_id($id){
      global $db;
      $id = (int)$id;
      $sql = "SELECT i.*,a.nombre as area,ti.codigo as tipo_incidencia";
      $sql .=" FROM incidencia i, areas a, tipos_incidencia ti";
      $sql .=" WHERE i.id_tipo_incidencia=ti.id and i.id_area=a.id ";
      $sql .=" AND i.id = '{$db->escape($id)}' LIMIT 1 ";
      $sql = $db->query($sql);
      if($result = $db->fetch_assoc($sql))
            return $result;
      else
         return null;
  }
  /*--------------------------------------------------------------*/
  /* Función que actualiza la fecha del ultimo logeo
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE usuarios SET ultima_entrada='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}

  /*--------------------------------------------------------------*/
  /* Busca en el grupo de usuarios un grupo dado
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT nombre_grupo FROM grupos_usuario WHERE nombre_grupo = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Busca en grupos de usuario por nivel dado
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT nivel_grupo FROM grupos_usuario WHERE nivel_grupo = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Funcion que determina a qué elementos de menú tiene acceso un nivel determinado de usuario
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['nivel']);
     //Si el usuario no está logeado
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor Iniciar sesión...');
            redirect('index.php', false);
      //Si el grupo está desactivado
     elseif($login_level['estado_grupo'] === '0'):
           $session->msg('d','Este nivel de usuario esta inactivo!');
           redirect('home.php',false);
      //Comporbamos si el nivel del usuario actual es menor o igual que el nivel de acceso requerido
     elseif($current_user['nivel'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "¡Lo siento!  no tienes permiso para ver la página.");
            redirect('home.php', false);
        endif;

     }
   
/*--------------------------------------------------------------*/
  /* Busca Usuarios Técnicos
  /*--------------------------------------------------------------*/

    function find_all_tecnicos(){
      global $db;
      $results = array();
      $sql = "SELECT id,nombre";
      $sql .=" FROM usuarios";
      $sql .=" WHERE estado=1 AND nivel=3";
      $sql .=" ORDER BY nombre ASC";
      $result = find_by_sql($sql);
      return $result;
  }

/*--------------------------------------------------------------*/
  /* Busca Tareas Finalizadas
  /*--------------------------------------------------------------*/

    function cuenta_tareas($id_incidencia)
{
  global $db;
 
    $sql    = "SELECT COUNT(id) as total FROM  orden_trabajo WHERE id_incidencia=".$db->escape($id_incidencia). " AND estado !=2";
    $result = $db->query($sql);
     return($db->fetch_assoc($result));

  
}

 /*--------------------------------------------------------------*/
  /* Buscar tecnico por id tecnico
  /*--------------------------------------------------------------*/

    function find_tecnico_by_id($id){
      global $db;
      $id = (int)$id;
      $sql = "SELECT id,nombre";
      $sql .=" FROM usuarios";
      $sql .=" WHERE id = '{$db->escape($id)}' LIMIT 1 ";
      $result = find_by_sql($sql);
      return $result;
  } 


  /*--------------------------------------------------------------*/
  /* Buscar tecnico por id tecnico
  /*--------------------------------------------------------------*/

    function Dame_Incidencia($id){
      global $db;
      $id = (int)$id;
      $sql = "SELECT descripcion";
      $sql .=" FROM incidencia";
      $sql .=" WHERE id = '{$db->escape($id)}' LIMIT 1 ";
      $result = find_by_sql($sql);
      return $result;
  } 


 /*--------------------------------------------------------------*/
/* Function para Count id  segun parametro
/*--------------------------------------------------------------*/

function count_by_id_estado($table,$estado,$comparacion){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table)." WHERE estado".$db->escape($comparacion).$db->escape($estado);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
 /* Incidencias por tipo (estadísticas)
 /*--------------------------------------------------------------*/
 function incidencias_por_tipo($limit){
   global $db;
   $sql  = "SELECT COUNT(i.id) as total ,ti.codigo as tipo";
   $sql .= " FROM incidencia i, tipos_incidencia ti";
   $sql .= " WHERE i.id_tipo_incidencia=ti.id";
   $sql .= " GROUP BY i.id_tipo_incidencia";
   $sql .= " ORDER BY total DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }
/*--------------------------------------------------------------*/
 /* Incidencias por area (estadísticas)
 /*--------------------------------------------------------------*/
 function incidencias_por_area($limit){
   global $db;
   $sql  = "SELECT COUNT(i.id) as total ,a.nombre as nombre, a.signatura as signatura";
   $sql .= " FROM incidencia i, areas a";
   $sql .= " WHERE i.id_area=a.id";
   $sql .= " GROUP BY i.id_area";
   $sql .= " ORDER BY total DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }

/*--------------------------------------------------------------*/
 /* Últimas incidencias (estadísticas)
 /*--------------------------------------------------------------*/
 function ultimas_incidencias($limit){
   global $db;
   $sql  = "SELECT *";
   $sql .= " FROM incidencia";
   $sql .= " ORDER BY fecha_incidencia DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }
/*--------------------------------------------------------------*/
 /* Últimas tareas (estadísticas)
 /*--------------------------------------------------------------*/
 function ultimas_tareas($limit){
   global $db;
   $sql  = "SELECT *";
   $sql .= " FROM orden_trabajo";
   $sql .= " ORDER BY fecha_inicio DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }
/*--------------------------------------------------------------*/
 /* Devuelve el código de la prioridad
 /*--------------------------------------------------------------*/
function Dame_Prioridad($num_pri){
 $prioridad=0;
 switch($num_pri) 
    {
       case 0: $prioridad="ninguna";break;
       case 1: $prioridad="BAJA"; break;
       case 2: $prioridad="MEDIA"; break;
       case 3: $prioridad="ALTA"; break;
       default: $prioridad="ninguna";  
     };
return $prioridad;
}
/*--------------------------------------------------------------*/
 /* Devuelve el código del estado de incidencia
 /*--------------------------------------------------------------*/
function Dame_Estado_Incidencia($num_estado){
 $estado=0;
 switch($num_estado) 
    {
       case 0: $estado="Generada";break;
       case 1: $estado="En Revisión"; break;
       case 2: $estado="Confirmada"; break;
       case 3: $estado="En Reparación"; break;
       case 4: $estado="En Comprobación"; break;
       case 5: $estado="Finalizada"; break;
       default: $estado="ninguna";  
     };
return $estado;
}
/*--------------------------------------------------------------*/
 /* Devuelve el código del tipo de actuación (ORDENES DE TRABAJO)
 /*--------------------------------------------------------------*/
function Dame_Actuacion($num_act){
 $act=0;
 switch($num_act) 
    {
       case 0: $act="ninguna";break;
       case 1: $act="Reparación"; break;
       case 2: $act="Sustitución"; break;
       case 3: $act="Compra"; break;
       case 4: $act="Instalación"; break;
       case 5: $act="Configuración"; break;
       case 6: $act="Eliminación"; break;
       default: $act="ninguna";  
     };
return $act;
}
/*--------------------------------------------------------------*/
 /* Devuelve el código del estado de incidencia
 /*--------------------------------------------------------------*/
function Dame_Estado_Tarea($num_estado){
 $estado=0;
 switch($num_estado) 
    {
       case 0: $estado="Generada";break;
       case 1: $estado="En Proceso"; break;
       case 2: $estado="Finalizada"; break;
       
       default: $estado="Generada";  
     };
return $estado;
}
/*--------------------------------------------------------------*/
/* Función para generar los informes de incidencias
/*--------------------------------------------------------------*/
function informe_incidencias($start_date,$end_date,$tipo_informe,$estado,$prioridad){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
 if ($tipo_informe==0)
 {
                  $sql  = "SELECT i.fecha_incidencia,a.descripcion as lugar,i.descripcion as descripcion,";
                  $sql .= " CASE";
                  $sql .= "    WHEN i.prioridad=1 THEN 'Baja'";
                  $sql .= "    WHEN i.prioridad=2 THEN 'Media'";
                  $sql .= "    WHEN i.prioridad=3 THEN 'Alta'";
                  $sql .= "    ELSE 'Ninguna'";
                  $sql .= " END as prioridad, ";
                  $sql .= " CASE";
                  $sql .= "    WHEN i.estado=0 THEN 'Generada'";
                  $sql .= "    WHEN i.estado=1 THEN 'En revisión'";
                  $sql .= "    WHEN i.estado=2 THEN 'Confirmada'";
                  $sql .= "    WHEN i.estado=3 THEN 'En reparación'";
                  $sql .= "    WHEN i.estado=4 THEN 'En comprobación'";
                  $sql .= "    WHEN i.estado=5 THEN 'Finalizada'";
                  $sql .= "    ELSE 'Generada'";
                  $sql .= " END as estado ";
                  $sql .= " FROM incidencia i, areas a ";
                  $sql .= " WHERE i.id_area=a.id ";
                  $sql .= " AND i.fecha_incidencia BETWEEN '{$start_date}' AND '{$end_date}'";
                  $sql .= " ORDER BY i.fecha_incidencia DESC ";
   }
  if ($tipo_informe==1)
  {
                  $sql  = "SELECT i.fecha_incidencia,a.descripcion as lugar,i.descripcion as descripcion,";
                  $sql .= " CASE";
                  $sql .= "    WHEN i.prioridad=1 THEN 'Baja'";
                  $sql .= "    WHEN i.prioridad=2 THEN 'Media'";
                  $sql .= "    WHEN i.prioridad=3 THEN 'Alta'";
                  $sql .= "    ELSE 'Ninguna'";
                  $sql .= " END as prioridad ";
                  $sql .= " FROM incidencia i, areas a ";
                  $sql .= " WHERE i.id_area=a.id ";
                  $sql .= " AND i.estado={$estado} ";
                  $sql .= " AND i.fecha_incidencia BETWEEN '{$start_date}' AND '{$end_date}'";
                  $sql .= " ORDER BY i.fecha_incidencia DESC ";
  }
  if ($tipo_informe==2)
  {
                  $sql  = "SELECT i.fecha_incidencia,a.descripcion as lugar,i.descripcion as descripcion,";
                  $sql .= " CASE";
                  $sql .= "    WHEN i.estado=0 THEN 'Generada'";
                  $sql .= "    WHEN i.estado=1 THEN 'En revisión'";
                  $sql .= "    WHEN i.estado=2 THEN 'Confirmada'";
                  $sql .= "    WHEN i.estado=3 THEN 'En reparación'";
                  $sql .= "    WHEN i.estado=4 THEN 'En comprobación'";
                  $sql .= "    WHEN i.estado=5 THEN 'Finalizada'";
                  $sql .= "    ELSE 'Generada'";
                  $sql .= " END as estado ";
                  $sql .= " FROM incidencia i, areas a ";
                  $sql .= " WHERE i.id_area=a.id ";
                  $sql .= " AND i.prioridad={$prioridad} ";
                  $sql .= " AND i.fecha_incidencia BETWEEN '{$start_date}' AND '{$end_date}'";
                  
                  $sql .= " ORDER BY i.fecha_incidencia DESC ";
  }
  if ($tipo_informe==3)
  {
                  $sql  = "SELECT i.fecha_incidencia,a.descripcion as lugar,i.descripcion as descripcion ";
                  $sql .= " FROM incidencia i, areas a ";
                  $sql .= " WHERE i.id_area=a.id ";
                  $sql .= " AND i.estado={$estado} ";
                  $sql .= " AND i.prioridad={$prioridad} ";
                  $sql .= " AND i.fecha_incidencia BETWEEN '{$start_date}' AND '{$end_date}'";
                  $sql .= " ORDER BY i.fecha_incidencia DESC ";
  }
  return $db->query($sql);
}

/*--------------------------------------------------------------*/
/* Función para generar los informes de ORDENES DE TRABAJO (TAREAS)
/*--------------------------------------------------------------*/
function informe_tareas($start_date,$end_date,$tipo_informe,$estado,$actuacion){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
 if ($tipo_informe==0)
 {
                  $sql  = "SELECT fecha_inicio,descripcion,";
                  $sql .= " CASE";
                  $sql .= "    WHEN estado=0 THEN 'Generada'";
                  $sql .= "    WHEN estado=1 THEN 'En proceso'";
                  $sql .= "    WHEN estado=2 THEN 'Finalizada'";
                  $sql .= "    ELSE 'Generada'";
                  $sql .= " END as estado, ";
                  $sql .= " CASE";
                  $sql .= "    WHEN tipo_actuacion=0 THEN 'Ninguna'";
                  $sql .= "    WHEN tipo_actuacion=1 THEN 'Reparación'";
                  $sql .= "    WHEN tipo_actuacion=2 THEN 'Sustitución'";
                  $sql .= "    WHEN tipo_actuacion=3 THEN 'Compra'";
                  $sql .= "    WHEN tipo_actuacion=4 THEN 'Instalación'";
                  $sql .= "    WHEN tipo_actuacion=5 THEN 'Configuración'";
                  $sql .= "    WHEN tipo_actuacion=5 THEN 'Eliminación'";
                  $sql .= "    ELSE 'Generada'";
                  $sql .= " END as actuacion ";
                  $sql .= " FROM orden_trabajo ";
                  $sql .= " WHERE fecha_inicio BETWEEN '{$start_date}' AND '{$end_date}'";
                  $sql .= " ORDER BY fecha_inicio DESC ";
   }
  if ($tipo_informe==1)
  {
                  $sql  = "SELECT fecha_inicio,descripcion,";
                   $sql .= " CASE";
                  $sql .= "    WHEN tipo_actuacion=0 THEN 'Ninguna'";
                  $sql .= "    WHEN tipo_actuacion=1 THEN 'Reparación'";
                  $sql .= "    WHEN tipo_actuacion=2 THEN 'Sustitución'";
                  $sql .= "    WHEN tipo_actuacion=3 THEN 'Compra'";
                  $sql .= "    WHEN tipo_actuacion=4 THEN 'Instalación'";
                  $sql .= "    WHEN tipo_actuacion=5 THEN 'Configuración'";
                  $sql .= "    WHEN tipo_actuacion=5 THEN 'Eliminación'";
                  $sql .= "    ELSE 'Generada'";
                  $sql .= " END as actuacion ";
                  $sql .= " FROM orden_trabajo ";
                  $sql .= " WHERE estado={$estado} ";
                  $sql .= " AND fecha_inicio BETWEEN '{$start_date}' AND '{$end_date}'";
                  $sql .= " ORDER BY fecha_inicio DESC ";
  }
  if ($tipo_informe==2)
  {
                  $sql  = "SELECT fecha_inicio,descripcion,";
                $sql .= " CASE";
                  $sql .= "    WHEN estado=0 THEN 'Generada'";
                  $sql .= "    WHEN estado=1 THEN 'En proceso'";
                  $sql .= "    WHEN estado=2 THEN 'Finalizada'";
                  $sql .= "    ELSE 'Generada'";
                  $sql .= " END as estado ";
                  $sql .= " FROM orden_trabajo ";
                  $sql .= " WHERE tipo_actuacion={$actuacion} ";
                  $sql .= " AND fecha_inicio BETWEEN '{$start_date}' AND '{$end_date}'";                  
                  $sql .= " ORDER BY fecha_inicio DESC ";
  }
  if ($tipo_informe==3)
  {
                  $sql  = "SELECT fecha_inicio,descripcion ";
                  $sql .= " FROM orden_trabajo ";
                  $sql .= " WHERE estado={$estado} ";
                  $sql .= " AND tipo_actuacion={$actuacion} ";
                  $sql .= " AND fecha_inicio BETWEEN '{$start_date}' AND '{$end_date}'";
                  $sql .= " ORDER BY fecha_inicio DESC ";
  }
  return $db->query($sql);
}

/*--------------------------------------------------------------*/
/* Función para generar los correos a usuarios sobre sus incidencias
/*--------------------------------------------------------------*/
function genera_informe_incidencias($id_usuario){
  global $db;
  
 
                  $sql  = "SELECT i.fecha_incidencia as fecha,i.descripcion as incidencia,a.descripcion as area ,t.descripcion as tipo,";
                  $sql .= " CASE";
                  $sql .= "    WHEN i.prioridad=1 THEN 'Baja'";
                  $sql .= "    WHEN i.prioridad=2 THEN 'Media'";
                  $sql .= "    WHEN i.prioridad=3 THEN 'Alta'";
                  $sql .= "    ELSE 'Ninguna'";
                  $sql .= " END as prioridad, ";
                  $sql .= " CASE";
                  $sql .= "    WHEN i.estado=0 THEN 'Generada'";
                  $sql .= "    WHEN i.estado=1 THEN 'En revisión'";
                  $sql .= "    WHEN i.estado=2 THEN 'Confirmada'";
                  $sql .= "    WHEN i.estado=3 THEN 'En reparación'";
                  $sql .= "    WHEN i.estado=4 THEN 'En comprobación'";
                  $sql .= "    WHEN i.estado=5 THEN 'Finalizada'";
                  $sql .= "    ELSE 'Generada'";
                  $sql .= " END as estado ";
                  $sql .= " FROM incidencia i, areas a ,tipos_incidencia t";
                  $sql .= " WHERE i.id_tipo_incidencia=t.id ";
                  $sql .= " AND i.id_area=a.id ";
                  $sql .= " AND i.id_usuario={$id_usuario}";
                  $sql .= " ORDER BY i.fecha_incidencia DESC ";
  
                   return $db->query($sql);
}

//---------------------------DIDA_Inventic (Estadísticas del Panel de Control)




/*--------------------------------------------------------------*/
 /* ZONAS inventariadas (estadísticas)
 AULA=1
 DEPARTAMENTO=4
 /*--------------------------------------------------------------*/
 
 function zonas_tic($zona){
  global $db;
  
    $sql  = "SELECT COUNT(distinct(inventario.cod_zona)) AS total ";
     $sql .= " FROM inventario, zona";
     $sql .= " WHERE inventario.cod_zona=zona.cod_zona ";
     $sql .= " AND zona.cod_tipo_zona=".$db->escape($zona);
    
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  
}

/* DISPOSITIVOS inventariados (estadísticas)
 AULA=1
 DEPARTAMENTO=4
 /*--------------------------------------------------------------*/
 
 function dispositivos_tic(){
  global $db;
  
    $sql  = "SELECT COUNT(distinct(inventario.cod_dispositivo)) AS total ";
     $sql .= " FROM inventario";
   
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  
}

/* DISPOSITIVOS inventariados (estadísticas)
 estados
 'No Funciona'
 'Falta Configurar'
 'Obsoleto'
 'Operativo'
 /*--------------------------------------------------------------*/
 
 function dispositivos_estado($estado){
  global $db;
  
    $sql  = "SELECT COUNT(*) AS total ";
    $sql .= " FROM inventario";
    $sql .= " WHERE estado='".$db->escape($estado)."'";
   
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  
}


/*--------------------------------------------------------------*/
 /* Ultimos Dispositivos  por zona (estadísticas)
 /*--------------------------------------------------------------*/
 function ultimos_dispositivos_por_zona($limit){
   global $db;
   $sql  = "SELECT i.fecha_revision as fecha,d.nombre as dispositivo,z.numero as zona";
   $sql .= " FROM inventario i,dispositivo d,zona z";
   $sql .= " WHERE d.cod_dispositivo=i.cod_dispositivo and z.cod_zona=i.cod_zona";
   $sql .= " ORDER BY fecha_revision DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }
/*--------------------------------------------------------------*/
 /* Ultimos Dispositivos añadidos (estadísticas)
 /*--------------------------------------------------------------*/
 function ultimos_dispositivos_insertados($limit){
   global $db;
   $sql  = "SELECT ucase(nombre) as dispositivo";
   $sql .= " FROM dispositivo";
   $sql .= " ORDER BY cod_dispositivo DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }


/*--------------------------------------------------------------*/
 /* Dotación por zona (estadísticas)
 /*--------------------------------------------------------------*/
 function dotacion_zona($limit){
   global $db;
   $sql  = "SELECT zona.numero as zona,count(inventario.cod_dispositivo) as total";
   $sql .= " FROM inventario , zona";
   $sql .= " WHERE inventario.cod_zona=zona.cod_zona";
   $sql .= " GROUP BY zona.numero";
   $sql .= " ORDER BY count(inventario.cod_dispositivo) DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }

?>
