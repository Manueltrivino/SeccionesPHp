<?php      
function Validar_Datos() {
    $Mensaje='';
    
    if (strlen($_POST['denominacion']) < 3) {
        $Mensaje.='Debes ingresar un nombre de proyecto <br />';
    }
        
    if (empty($_POST['idlider']) ) {
        $Mensaje.='Debes seleccionar un lider. <br />';
    }
    if (empty($_POST['idEmpresa'])) {
        $Mensaje.='Debes seleccionar una empresa. <br />';
    }


    return $Mensaje;

}
function Validar_Empresa() {
    $Mensaje='';
    
    if (strlen($_POST['denominacion']) < 3) {
        $Mensaje.='Debes ingresar un nombre de la empresa <br />';
    }
        
    if (empty($_POST['idpais']) ) {
        $Mensaje.='Debes seleccionar un pais. <br />';
    }


    return $Mensaje;

}

?>