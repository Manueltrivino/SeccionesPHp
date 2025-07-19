<?php
function Listar_Empresa($vConexion) {
     
    $Listado=array();

    //1) genero la consulta que deseo
    $SQL = "SELECT E.id, E.denominacion, E.fecha, U.nombre, U.apellido, U.img as foto, P.img as bandera
        FROM empresa E, usuario U, paiss P
        WHERE U.id=E.quiencarga AND E.idpais=P.Id
        ORDER BY E.denominacion";

    //2) a la conexion actual le brindo mi consulta, y el resultado lo entrego a variable $rs
     $rs = mysqli_query($vConexion, $SQL);
        
     //3) el resultado deberá organizarse en una matriz, entonces lo recorro
     $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID'] = $data['id'];
            $Listado[$i]['DENOMINACION'] = $data['denominacion'];
            $Listado[$i]['FECHA'] = $data['fecha'];
            $Listado[$i]['NOMBRE'] = $data['nombre'];
            $Listado[$i]['APELLIDO'] = $data['apellido'];
            $Listado[$i]['BANDERA'] = $data['bandera'];
            $Listado[$i]['FOTO'] = $data['foto'];
            $i++;
    }


    //devuelvo el listado generado en el array $Listado. (Podra salir vacio o con datos)..
    return $Listado;

}

function Eliminar_Empresa($vIdEmpresa, $vConexion) {

    $SQL="DELETE FROM empresa WHERE id = $vIdEmpresa";

    if (!mysqli_query($vConexion, $SQL)) {
        return false;
    }
    return true;
}
?>