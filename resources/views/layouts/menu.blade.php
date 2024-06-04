<aside class="main-sidebar sidebar-dark-blue">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="{{asset('assets/logo.png')}}" alt="VISITAS" class="brand-image">
    <span class="brand-text text-white">syntaxSystems</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li id="liDashboard" class="nav-item">
          <a id="aDashboard" href="{{route('dashboard')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @can('solicitud-listar')
        <li id="liVisita" class="nav-item">
          <a id="aVisita" href="{{route('solicitud.index')}}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Registros 
            </p>
          </a>
        </li>
        @endcan
        <li id="liAlmacen" class="nav-item">
          <a id="aAlmacen" href="#" class="nav-link">
            <i class="nav-icon fa fa-table"></i>
            <p>
              Tipo Solicitudes
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('categoria-listar')
            <li class="nav-item">
              <a id="liCategoria" href="{{route('categoria.index')}}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Solicitud</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        <li id="liSeguridad" class="nav-item">
          <a id="aSeguridad" href="#" class="nav-link">
            <i class="nav-icon fas fa-shield-alt"></i>
            <p>
              Administrador - Segurid
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('usuario-listar')
            <li class="nav-item">
                <a id="liUsuario" href="{{route('usuario.index')}}" class="nav-link">
                    <i class="far nav-icon"></i>
                    <p>Usuarios</p>
                </a>
            </li>
            @endcan
            @can('rol-listar')
            <li class="nav-item">
              <a id="liRol" href="{{route('rol.index')}}" class="nav-link">
                <i class="far nav-icon"></i>
                <p>Roles</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
