<?php 
function InsertarProyecto($vConexion) { 
        
    $SQL_Insert="INSERT INTO proyecto (denominacion, fecha, idEmpresa, estado, idlider, observaciones, prioridad)
    VALUES ('".$_POST['denominacion']."' , NOW() , '".$_POST['idEmpresa']."', 1, ".$_POST['idlider']." , '".$_POST['observaciones']."', '".$_POST['prioridad']."')";


    if (!mysqli_query($vConexion, $SQL_Insert)) {
        //si surge un error, finalizo la ejecucion del script con un mensaje
        die ('<h4>Consulta: '. $SQL_Insert.'</h4> <p style="color: #ff0000">'.mysqli_error($vConexion) .'</p>'  ) ;
    }

    return true;
}
?>