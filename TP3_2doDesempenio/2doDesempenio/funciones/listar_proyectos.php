<?php
function Listar_Proyectos($vConexion) {
  
    $Listado=array();

    
    $SQL = "SELECT P.id, P.denominacion, P.fecha, E.denominacion as Empresa, S.Denominacion as Estado, S.Id as Idestado,
    U.nombre, U.apellido, U.img, A.img as bandera
        FROM proyecto P, empresa E, estado S, usuario U, paiss A
        WHERE P.idEmpresa=E.id AND P.estado=S.id AND P.idlider=U.id AND E.idpais = A.Id
        ORDER BY p.fecha ASC";

    
     $rs = mysqli_query($vConexion, $SQL);
        
     
     $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID'] = $data['id'];
            $Listado[$i]['DENOMINACION'] = $data['denominacion'];
            $Listado[$i]['FECHA'] = $data['fecha'];
            $Listado[$i]['EMPRESA'] = $data['Empresa'];
            $Listado[$i]['ESTADO'] = $data['Estado'];
            $Listado[$i]['NOMBRE'] = $data['nombre'];
            $Listado[$i]['APELLIDO'] = $data['apellido'];
            $Listado[$i]['IMG'] = $data['img'];
            $Listado[$i]['BANDERA'] = $data['bandera'];
            $Listado[$i]['IDESTADO'] = $data['Idestado'];
            $i++;
    }

    return $Listado;

}

function Dar_Color($estado){
    $color = "";
     
if($estado == 1){
    $color = 'info';
}elseif($estado == 2){
    $color = 'warning';
}elseif($estado == 3){
    $color = 'success';
}elseif($estado == 4){
    $color = 'danger';
}

return $color;

}
function Cancelar($Idproyecto, $vConexion) {
    
        $SQL="UPDATE proyecto SET estado= '4'
          WHERE id = $Idproyecto";

        if (!mysqli_query($vConexion, $SQL)) {
            return false;
        }
        return true;
    }

?>