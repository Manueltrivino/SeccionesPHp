<?php
    session_start();
    if (empty($_SESSION['Usuario_Nombre'])  || $_SESSION['Usuario_Rol'] != 1) {
        header('Location: cerrarsesion.php');
        exit;
    }
    
require_once 'funciones/conexion.php';
$MiConexion=ConexionBD(); 

require_once 'funciones/listar_pais.php';
$ListadoPais = Listar_Pais($MiConexion);
$CantidadPais= count($ListadoPais);


require_once 'funciones/validacion_registro.php'; 
require_once 'editar/actualizar_empresa.php';

// buscamos los datos necesarios de la empresa a cambiar 
if(isset($_GET['ID_empresa'])){
    $data = EncontrarEmpresa($_GET['ID_empresa'], $MiConexion);  
}
$Mensaje='';
$Estilo='danger';
if (!empty($_POST['BotonActualizar'])) {
    $Mensaje=Validar_Empresa();
    if (empty($Mensaje)) {
        if (Modificar_Empresa($_GET['ID_empresa'], $MiConexion) != false) {
            header('Location: listado_empresas.php');
            exit;
        }
    }
}
    ?>
<!DOCTYPE html>
<html lang="en">
    <?php
    require_once 'partes/head.php' ;
    ?>


<body>
    <div class="wrapper">
        <?php require_once 'partes/lateral.php'; ?>
    
        <div class="main">
            <?php require_once 'partes/cabecera.php'; ?> 
            

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="mb-3">
                        <h1 class="h3 d-inline align-middle">Editar Empresa</h1>
                    </div>
                    <form role="form" method='post'>
                        <div class="row">
                            <div class="col-12 col-lg-6">

                                <div class="card-header">
                                                                    
                                    <h4 class="text-info">
                                        Los campos con <i class="align-middle me-2" data-feather="command"></i> son obligatorios
                                    </h4> 
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Denominación <i class="align-middle me-2" data-feather="command"></i></h5>
                                        <input type="text" class="form-control" name="denominacion" id="Denominacion" placeholder="Ingresa el nombre"
                                         value="<?php echo !empty($data['EMPRESA']) ? $data['EMPRESA'] : ''; ?>">
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Pais <i class="align-middle me-2" data-feather="command"></i></h5>
                                        <select class="form-select mb-3" name="idpais" id="Idpais">
                                            <option value="" selected>Elige una opción</option>
                                            <?php 
                                                $selected='';
                                                for($i=0 ; $i < $CantidadPais ; $i++) {
                                                    if (!empty($data['IDPAIS']) && $data['IDPAIS'] ==  $ListadoPais[$i]['ID']) {
                                                        $selected = 'selected';
                                                    }else {
                                                        $selected='';
                                                    }
                                            ?>
                                            <option value="<?php echo $ListadoPais[$i]['ID']; ?>" <?php echo $selected; ?>  >
                                                        <?php echo $ListadoPais[$i]['DENOMINACION']; ?>
                                                    </option>
                                            
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title mb-0">Observaciones</h5>
                                        <textarea class="form-control"  rows="2" name="observaciones" id="observaciones"
                                        placeholder="Observaciones del tema..."><?php echo !empty($data['observaciones']) ? $data['observaciones'] : ''; ?></textarea>
                                        </div>
                                   
                                    <button type="submit" class="btn btn-primary" value="Actualizar Datos" name="BotonActualizar" >Actualizar Datos</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
            
            <?php 
require_once 'partes/pie.php';
?>

</body>

</html>