
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.php">
                    <span class="align-middle">AdminKit</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Proyectos
                    </li>


                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="listado_proyectos.php">
                            <i class="align-middle me-2" data-feather="list"></i> <span class="align-middle">Listado</span>
                        </a>
                    </li>
                    
                     
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="carga_proyecto.php">
                            <i class="align-middle me-2" data-feather="file"></i><span class="align-middle">Cargar nuevo</span>
                        </a>
                    </li>
                    

                    <li class="sidebar-header">
                        Empresas
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="listado_empresas.php">
                            <i class="align-middle me-2" data-feather="award"></i> <span class="align-middle">Listado </span>
                        </a>
                    </li>

                    <!-- Validar si tiene accesos --------------------------------------------------- -->
                    <?php if($_SESSION['Usuario_Rol'] == 1){?>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="carga_empresa.php">
                            <i class="align-middle me-2" data-feather="file"></i><span class="align-middle">Cargar nueva </span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="listado_paises.php">
                            <i class="align-middle me-2" data-feather="map-pin"></i><span class="align-middle">Listtado de paises </span>
                        </a>
                    </li>

                    

                    <li class="sidebar-header">
                        Personal
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="listado_usuarios.php">
                            <i class="align-middle me-2" data-feather="user"></i><span class="align-middle">Listado de usuarios</span>
                        </a>
                    </li>
                    <?php } ?>
                    <!--
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="carga_usuarios.html">
                            <i class="align-middle me-2" data-feather="file"></i><span class="align-middle">Cargar nuevo</span>
                        </a>
                    </li>
    -->
                </ul>
            </div>
        </nav>

            