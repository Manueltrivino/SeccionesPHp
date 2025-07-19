<?php
    session_start();
    if (empty($_SESSION['Usuario_Nombre']) ) {
        header('Location: cerrarsesion.php');
        exit;
    }
    
    require_once 'funciones/conexion.php';
    $MiConexion = ConexionBD();
   
    require_once 'funciones/listar_pais.php';
    if (!empty($_GET['ID_PA']) && is_numeric($_GET['ID_PA']) && $_GET['ID_PA'] > 0  )  {
        
        if (Eliminar_Pais($_GET['ID_PA'], $MiConexion ) != false) {
            $E_mensaje .='Se ha eliminado el pais. <br /> ';
            $E_estilo ='success';
        }else {
            $E_mensaje.='No se pudo eliminar el registro. <br /> ';
            $E_estilo ='warning';
        }
    }
    
 
    header('Location: listado_paises.php');
    exit;
?>