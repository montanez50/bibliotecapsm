@php
    $routeName = Route::currentRouteName();
@endphp
<div class="navbar-lateral full-reset">
  <div class="visible-xs font-movile-menu mobile-menu-button"></div>
  <div class="full-reset container-menu-movile custom-scroll-containers">
     <div class="logo full-reset all-tittles">
        <i
           class="visible-xs zmdi zmdi-close pull-left mobile-menu-button"
           style="
           line-height: 55px;
           cursor: pointer;
           padding: 0 10px;
           margin-left: 7px;
           "
           ></i>
        ¡Bienvenido!
     </div>
     <div
        class="full-reset"
        style="background-color: #042d71; padding: 10px 0; color: #fff"
        >
        <figure>
           <img
              src="{{asset('assets/img/logo-IUPSM.png')}}"
              alt="Biblioteca"
              class="img-responsive center-box"
              style="width: 55%"
              />
        </figure>
        <p class="text-center" style="padding-top: 15px">
           Biblioteca Digital "Santiago Mariño"
        </p>
     </div>
     <div class="full-reset nav-lateral-list-menu">
        <ul class="list-unstyled">
           <li>
              <a href="/" @if($routeName == 'dashboard') style="background-color: #E34724" @endif>
                <i class="zmdi zmdi-home zmdi-hc-fw"></i>
                &nbsp;&nbsp; Inicio
              </a>
           </li>
           @hasanyrole('Personal Administrativo|Administrador')
           <li>
              <div class="dropdown-menu-button">
                 <i class="zmdi zmdi-case zmdi-hc-fw"></i>&nbsp;&nbsp;
                 Administración
                 <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i>
              </div>
              <ul class="list-unstyled" @if($routeName == 'carrera.index' || $routeName == 'linea.index' || $routeName == 'asignatura.index' || $routeName == 'autor.index' || $routeName == 'editorial.index') style="display: block" @endif>
                 <li>
                    <a href="/carreras" @if($routeName == 'carrera.index') style="background-color: #E34724" @endif
                       ><i class="zmdi zmdi-balance zmdi-hc-fw"></i>&nbsp;&nbsp;
                    Lista de carreras</a
                       >
                 </li>
                 <li>
                    <a href="/lineas" @if($routeName == 'linea.index') style="background-color: #E34724" @endif
                       ><i class="zmdi zmdi-truck zmdi-hc-fw"></i>&nbsp;&nbsp;
                    Lista de líneas de investigación</a
                       >
                 </li>
                 <li>
                    <a href="/asignaturas" @if($routeName == 'asignatura.index') style="background-color: #E34724" @endif
                       ><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i
                       >&nbsp;&nbsp; Lista de asignaturas</a
                       >
                 </li>
                 <li>
                    <a href="/autores" @if($routeName == 'autor.index') style="background-color: #E34724" @endif
                       ><i class="zmdi zmdi-assignment-account zmdi-hc-fw"></i
                       >&nbsp;&nbsp; Lista de autores</a
                       >
                 </li>
                 <li>
                    <a href="/editoriales" @if($routeName == 'editorial.index') style="background-color: #E34724" @endif
                       ><i class="zmdi zmdi-collection-bookmark zmdi-hc-fw"></i
                       >&nbsp;&nbsp; Lista de editoriales</a
                       >
                 </li>
              </ul>
           </li>
           @endhasanyrole
           @hasanyrole('Personal Administrativo|Administrador')
           <li>
              <div class="dropdown-menu-button">
                 <i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp;
                 Gestión de usuarios
                 <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i>
              </div>
              <ul class="list-unstyled" @if($routeName == 'user.index' || $routeName == 'user.create') style="display: block" @endif>
                 <li>
                    <a href="/usuarios/registrar" @if($routeName == 'user.create') style="background-color: #E34724" @endif
                       ><i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Nuevo
                    usuario</a
                       >
                 </li>
                 <li>
                    <a href="/usuarios" @if($routeName == 'user.index') style="background-color: #E34724" @endif
                       ><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>&nbsp;&nbsp; Listado de
                    usuarios</a
                       >
                 </li>
                 {{-- 
                 <li>
                    <a href="registrar_docente"
                       ><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp;
                    Nuevo docente</a
                       >
                 </li>
                 <li>
                    <a href="usuarios/registrar_estudiante"
                       ><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>&nbsp;&nbsp;
                    Nuevo estudiante</a
                       >
                 </li>
                 <li>
                    <a href="usuarios/registrar_personal"
                       ><i class="zmdi zmdi-male-female zmdi-hc-fw"></i
                       >&nbsp;&nbsp; Nuevo personal administrativo</a
                       >
                 </li>
                 --}}
              </ul>
           </li>
           @endhasanyrole
           <li>
              <div class="dropdown-menu-button">
                 <i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>&nbsp;&nbsp;
                 Libros y catálogo
                 <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i>
              </div>
              <ul class="list-unstyled"
              @if($routeName == 'libro.create' || $routeName == 'tdg.create' || $routeName == 'proyecto.create' || $routeName == 'video.create' || $routeName == 'libro.index' || $routeName == 'tdg.index' || $routeName == 'proyecto.index' || $routeName == 'video.index') style="display: block" @endif
              >
               @hasanyrole('Personal Administrativo|Administrador')
                 <li>
                    <a href="/libros/create" @if($routeName == 'libro.create' || $routeName == 'tdg.create' || $routeName == 'proyecto.create') style="background-color: #E34724" @endif
                       ><i class="zmdi zmdi-book zmdi-hc-fw"></i>&nbsp;&nbsp; Nuevo
                    Recurso</a
                       >
                 </li>
               @endhasanyrole
               @hasanyrole('Docente|Administrador')
                  <li>
                     <a href="/videos/create" @if($routeName == 'video.create') style="background-color: #E34724" @endif
                        ><i class="zmdi zmdi-collection-video zmdi-hc-fw"></i>&nbsp;&nbsp; Nuevo
                     Video</a
                        >
                  </li>
               @endhasanyrole
                 <li>
                    <a href="/libros" @if($routeName == 'libro.index' || $routeName == 'tdg.index' || $routeName == 'proyecto.index' || $routeName == 'video.index') style="background-color: #E34724" @endif
                       ><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i
                       >&nbsp;&nbsp; Catálogo</a
                       >
                 </li>
              </ul>
           </li>
           @hasanyrole('Personal Administrativo|Administrador|Docente')
           <li>
              <a href="/reportes" @if($routeName == 'reportes') style="background-color: #E34724" @endif
                 ><i class="zmdi zmdi-trending-up zmdi-hc-fw"></i>&nbsp;&nbsp;
              Reportes y estadísticas</a
                 >
           </li>
           @endhasanyrole
           @hasrole('Administrador')
           <li>
              <a href="/avanzadas"
                 ><i class="zmdi zmdi-wrench zmdi-hc-fw"></i>&nbsp;&nbsp;
              Configuraciones avanzadas</a
                 >
           </li>
           @endhasrole
        </ul>
     </div>
  </div>
</div>
