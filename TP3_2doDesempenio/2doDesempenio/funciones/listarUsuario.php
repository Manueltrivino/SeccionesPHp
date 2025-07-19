<?php
function Listar_Usuarios($vConexion) {
     
    $Listado=array();

    
    $SQL = "SELECT U.id, U.nombre, U.apellido, U.mail, U.img, U.alias, U.idrol, R.Denominacion
        FROM usuario U, rols R
        WHERE U.idrol=R.Id 
        ORDER BY U.nombre" ;

     $rs = mysqli_query($vConexion, $SQL);
        
     $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID'] = $data['id'];
            $Listado[$i]['NOMBRE'] = $data['nombre'];
            $Listado[$i]['APELLIDO'] = $data['apellido'];
            $Listado[$i]['EMAIL'] = $data['mail'];
            $Listado[$i]['IMG'] = $data['img'];
            $Listado[$i]['ALIAS'] = $data['alias'];
            $Listado[$i]['IDROL'] = $data['idrol'];
            $Listado[$i]['ROL'] = $data['Denominacion'];
            
            $i++;
    }

    return $Listado;

}

function Eliminar_Usuario($vIdUsuario, $vConexion) {

    $SQL="DELETE FROM usuario wHERE id = $vIdUsuario";

    if (!mysqli_query($vConexion, $SQL)) {
        return false;
    }
    return true;
}
?>