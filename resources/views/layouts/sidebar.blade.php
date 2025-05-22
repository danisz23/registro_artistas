<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Marca -->
    <a href="#" class="brand-link">
        <i class="fas fa-palette brand-image img-circle elevation-3" style="opacity: .8"></i>
        <span class="brand-text font-weight-light">Mi Panel</span>
    </a>

    <!-- Menú lateral -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Usuarios -->
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Usuarios</p>
                    </a>
                </li>

                <!-- Artistas -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-astronaut"></i>
                        <p>
                            Artistas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Individuales -->
                        <li class="nav-item">
                            <a href="{{ route('admin.artistas_individuales.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Individuales</p>
                            </a>
                        </li>
                        <!-- Colectivos -->
                        <li class="nav-item">
                            <a href="{{ route('admin.artistas_colectivos.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Colectivos</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Más secciones aquí -->
            </ul>
        </nav>
    </div>
</aside>
