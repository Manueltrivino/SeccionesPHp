<?php
function EncontrarEmpresa($IdEmpresa, $vConexion){
    $Empresa=array();
    
    $SQL="SELECT E.id, E.denominacion, E.observaciones, P.Id as idPais, P.Denominacion as pais
    FROM empresa E, paiss P
     WHERE E.id = $IdEmpresa
     AND E.idpais = P.Id";

    $rs = mysqli_query($vConexion, $SQL);
        
    $data = mysqli_fetch_array($rs) ;
    if (!empty($data)) {
        $Empresa['IDEMPRESA']         = $data['id'];
        $Empresa['EMPRESA']     = $data['denominacion'];
        $Empresa['OBSERVACIONES']   = $data['observaciones'];
        $Empresa['IDPAIS']      = $data['idPais'];
        $Empresa['PAIS']      = $data['pais'];        
    }
    return $Empresa;
}

function Modificar_Empresa($IdEmpresa, $vConexion) {
    $SQL = "UPDATE empresa SET
    denominacion = '" . $_POST['denominacion'] . "', 
    observaciones = '" . $_POST['observaciones'] . "', 
    idpais = '" . $_POST['idpais'] . "'
    WHERE id = $IdEmpresa";

    if (!mysqli_query($vConexion, $SQL)) {
        return false;
    }
    return true;

}
?>