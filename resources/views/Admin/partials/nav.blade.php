<ul class="sidebar-menu">
    <li class="header">Navegacion</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ setActiveRoute('dashboard') }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Inicio</span>
        </a>
    </li>

    <li class="treeview {{ setActiveRoute('admin.courts.index') }}">
        <a href="#"><i class="fa fa-bars"><span> Canchas</span></i>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setActiveRoute('admin.courts.index') }}">
                <a href="{{ route('admin.courts.index') }}"><i class="fa fa-eye"></i> Ver todas las canchas</a>
            </li>
            @can('create', new App\Court)
                <li>
                    @if(request()->is('admin/courts/*'))
                        <a href="{{route('admin.courts.index', '#create') }}"><i class="fa fa-pencil"></i>Crear una cancha</a>
                    @else
                        <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i>crear una cancha</a>
                    @endif
                </li>
            @endcan
        </ul>
    </li>

    <li class="treeview {{ setActiveRoute('admin.championships.index') }}">
        <a href="#"><i class="fa fa-trophy"><span> Campeonatos</span></i>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ setActiveRoute('admin.championships.index') }}">
                <a href="{{ route('admin.championships.index') }}"><i class="fa fa-eye"> Ver todos los campeonatos</i></a>
            </li>
            @can('create', new App\Championship)
                <li class="{{ setActiveRoute('admin.championships.create') }}">
                    <a href="{{ route('admin.championships.create') }}"><i class="fa fa-pencil"></i>Crear un campeonato</a>
                </li>
            @endcan
        </ul>
    </li>
</ul>