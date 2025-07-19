<?php 
function InsertarEmpresa($vConexion) { 
        
   
$SQL_Insert="INSERT INTO empresa(denominacion, fecha, quiencarga, observaciones, idpais) 
VALUES ('".$_POST['denominacion']."', NOW(),'".$_SESSION['Usuario_Id'] ."','".$_POST['observaciones']."','".$_POST['idpais']."')";
    if (!mysqli_query($vConexion, $SQL_Insert)) {
        //si surge un error, finalizo la ejecucion del script con un mensaje
        die ('<h4>Consulta: '. $SQL_Insert.'</h4> <p style="color: #ff0000">'.mysqli_error($vConexion) .'</p>'  ) ;
    }

    return true;
}
?>