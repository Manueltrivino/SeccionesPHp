<?php
function Listar_Pais($vConexion) {
     
    $Listado=array();

    $SQL = "SELECT Id, Denominacion, img
        FROM paiss
        ORDER BY Denominacion";

     $rs = mysqli_query($vConexion, $SQL);
        

     $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID'] = $data['Id'];
            $Listado[$i]['DENOMINACION'] = $data['Denominacion'];
            $Listado[$i]['IMG'] = $data['img'];
            $i++;
    }


    return $Listado;

}
function Eliminar_Pais($vIdPais, $vConexion) {

    $SQL="DELETE FROM paiss wHERE id = $vIdPais";

    if (!mysqli_query($vIdPais, $SQL)) {
        return false;
    }
    return true;
}
?>