<?php
// verificamos el logueo
    session_start();
    if (empty($_SESSION['Usuario_Nombre']) ) {
        header('Location: cerrarsesion.php');
        exit;
    }
    
    require_once 'funciones/conexion.php';
    $MiConexion = ConexionBD();
   
    require_once 'funciones/listarUsuario.php';
    //verificamos que ID_USER no este vacio, que sea numerico y sea mayor que 0
    if (!empty($_GET['ID_USER']) && is_numeric($_GET['ID_USER']) && $_GET['ID_USER'] > 0  )  {
        
        //Pasamos los parametros a la funcion y verificamos que devuelva verdadero
        if (Eliminar_Usuario($_GET['ID_USER'] , $MiConexion ) != false) {
            $U_mensaje.='Se ha eliminado el registro de usuario. <br /> ';
            $U_estilo ='success';
        }else {
            $U_mensaje.='No se pudo eliminar el registro del usuario. <br /> ';
            $U_estilo ='warning';
        }
    }
    
 
    header('Location: listado_usuarios.php');
    exit;
?>