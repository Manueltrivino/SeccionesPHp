<?php
function EncontrarProyecto($IdProyecto, $vConexion){
    $Proyecto=array();
    
    $SQL="SELECT P.id, P.denominacion, P.observaciones, E.id as idEmpresa, E.denominacion as nomEmpresa, U.id as idUsuario, 
    U.nombre, U.apellido, S.Id as idEstado, S.Denominacion as Estado 
    FROM proyecto P, empresa E, usuario U, estado S
     WHERE P.id = $IdProyecto
     AND P.idEmpresa = E.id
     AND P.idlider =U.id
     AND P.estado = S.Id";

    $rs = mysqli_query($vConexion, $SQL);
        
    $data = mysqli_fetch_array($rs) ;
    if (!empty($data)) {
        $Proyecto['IDPROYECTO']         = $data['id'];
        $Proyecto['PROYECTO']     = $data['denominacion'];
        $Proyecto['OBSERVACIONES']   = $data['observaciones'];
        $Proyecto['IDEMPRESA']      = $data['idEmpresa'];
        $Proyecto['NOMEMPRESA']      = $data['nomEmpresa'];
        $Proyecto['IDUSUARIO']       = $data['idUsuario'];
        $Proyecto['NOMBREU']       = $data['nombre'];
        $Proyecto['APELLIDO']       = $data['apellido'];
        $Proyecto['IDESTADO']       = $data['idEstado'];
        $Proyecto['ESTADO']       = $data['Estado'];
        
    }
    return $Proyecto;
}

function Modificar_Proyecto($IdProyecto, $vConexion) {
    $SQL = "UPDATE proyecto SET
    denominacion = '" . $_POST['denominacion'] . "', 
    idEmpresa = '" . $_POST['idEmpresa'] . "', 
    estado = '" . $_POST['idEstado'] . "', 
    idlider = '". $_POST['idlider'] . "', 
    observaciones = '" . $_POST['observaciones'] . "',
    prioridad = '" . $_POST['prioridad'] . "'
    WHERE id = $IdProyecto";

    if (!mysqli_query($vConexion, $SQL)) {
        return false;
    }
    return true;

}
?>
