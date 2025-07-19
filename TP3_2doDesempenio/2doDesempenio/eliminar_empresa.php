<?php
    session_start();
    if (empty($_SESSION['Usuario_Nombre']) ) {
        header('Location: cerrarsesion.php');
        exit;
    }
    
    require_once 'funciones/conexion.php';
    $MiConexion = ConexionBD();
   
    require_once 'funciones/listar_empresa.php';
    //verificamos que ID_USER no este vacio, que sea numerico y sea mayor que 0
    if (!empty($_GET['ID_EM']) && is_numeric($_GET['ID_EM']) && $_GET['ID_EM'] > 0  )  {
        
        //Pasamos los parametros a la funcion y verificamos que devuelva verdadero
        if (Eliminar_Empresa($_GET['ID_EM'], $MiConexion ) != false) {
            $E_mensaje .='Se ha eliminado la empresa. <br /> ';
            $E_estilo ='success';
        }else {
            $E_mensaje.='No se pudo eliminar el registro. <br /> ';
            $E_estilo ='warning';
        }
    }
    
 
    header('Location: listado_empresas.php');
    exit;
?>