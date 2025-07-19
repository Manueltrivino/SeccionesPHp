<?php 
session_start();    

require_once 'funciones/conexion.php';
$MiConexion=ConexionBD();
$Mensaje='';

if (!empty($_POST['BotonLogin'])) {

    require_once 'funciones/loguear.php';
    $UsuarioLogueado = DatosLogin($_POST['email'], $_POST['password'], $MiConexion);

    //la consulta con la BD para que encuentre un usuario registrado con el usuario y clave brindados
    if ( !empty($UsuarioLogueado)) {
       
        if ($UsuarioLogueado['ROL'] > 2) {
            $Mensaje ='No tienes permisos asignados para ingresar al panel';


        } else {

            //generar los valores del usuario (esto va a venir de mi BD)
            $_SESSION['Usuario_Id']     =   $UsuarioLogueado['ID'];
            $_SESSION['Usuario_Nombre']     =   $UsuarioLogueado['NOMBRE'];
            $_SESSION['Usuario_Apellido']   =   $UsuarioLogueado['APELLIDO'];
            $_SESSION['Usuario_Mail']      =   $UsuarioLogueado['MAIL'];
            $_SESSION['Usuario_Img']        =   $UsuarioLogueado['IMG'];
            $_SESSION['Usuario_Alias']         =   $UsuarioLogueado['ALIAS'];
            $_SESSION['Usuario_Rol']    =   $UsuarioLogueado['ROL'];
            $_SESSION['Usuario_RolNom']    =   $UsuarioLogueado['DENOMINACION'];
            header('Location: index.php');
            exit;
        }
    }else {
        $Mensaje='Datos incorrectos, intenta de nuevo.';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <?php
    require_once 'partes/head.php'
    ?>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">


                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <div class="text-center mt-4">
                                        <p class="lead">
                                            <img src="img/avatars/login.png" width="150" height="150">
                                        <h1 class="h2">Ingresa tus datos.</h1>
                                        </p>
                                    </div>


                                    <!-- ----------------- Formulario --------------------- -->
                                    <form role="form" method='post'>
                                        <?php if (!empty($Mensaje)) { ?>
                                            <div class="card-header">
                                                <h4 class="text-danger"> <?php echo $Mensaje; ?></h4>
                                            </div>
                                        <?php } ?>
                                        
                                        <fieldset><!-- para agrupar los elementos del form --> 
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input class="form-control form-control-lg" placeholder="Ingresa tu email" name="email" type="email" autofocus value='' />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input class="form-control form-control-lg" placeholder="Ingresa tu password" name="password" type="password"/>
                                            </div>
                                            <div class="d-grid gap-2 mt-3">
                                                <button type="submit" class="btn btn-lg btn-primary" value="Login" name="BotonLogin" >Ingresar</button>                                 
                                            </div>
                                        </fieldset>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="text-center mb-3">
                            Don't have an account? <a href="pages-sign-up.html">Sign up</a>
                        </div>
-->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="js/app.js"></script>

</body>

</html>