<?php
session_start();

require_once 'funciones/conexion.php';
    $MiConexion = ConexionBD();


require_once 'funciones/listar_proyectos.php';

    if (isset($_GET['ID_estado'])) {
        Cancelar($_GET['ID_estado'], $MiConexion);
    } else {
        die("Error: ID de estado no proporcionado.");
    }

header('Location: listado_proyectos.php');
    
exit;

    
?>