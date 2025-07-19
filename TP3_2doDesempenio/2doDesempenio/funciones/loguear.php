<?php 
function DatosLogin($vUsuario, $vClave, $vConexion){
    $Usuario=array();
       
    $SQL="SELECT U.id, U.nombre, U.apellido, U.mail, U.img, U.alias, U.clave, U.idrol, R.Denominacion
     FROM Usuario U, rols R
     WHERE U.idrol = R.Id
     AND  mail='$vUsuario' 
     AND clave='$vClave'";

    //Ejecutamos la consulta con el metodo mysqli_query()
    $rs = mysqli_query($vConexion, $SQL);
    
    //extraemos el array de la consulta y la guardamos en data    
    $data = mysqli_fetch_array($rs) ;
    if (!empty($data)) {
        $Usuario['ID'] = $data['id'];
        $Usuario['NOMBRE'] = $data['nombre'];
        $Usuario['APELLIDO'] = $data['apellido'];
        $Usuario['MAIL'] = $data['mail'];
        $Usuario['IMG'] = $data['img'];
        $Usuario['ALIAS'] = $data['alias']; 
        $Usuario['ROL'] = $data['idrol'];
        $Usuario['DENOMINACION'] = $data['Denominacion'];
    }
    return $Usuario;
}

?>