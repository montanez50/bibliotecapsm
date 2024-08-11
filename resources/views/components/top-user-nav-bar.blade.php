<nav class="navbar-user-top full-reset">
    <ul class="list-unstyled full-reset">
      <figure>
        <img
        @if (strcmp(Auth::user()->getRoleNames()[0], 'Administrador') === 0)
            src="{{ asset('assets/img/user04.png') }}"
        @elseif (strcmp(Auth::user()->getRoleNames()[0], 'Docente') === 0)
            src="{{ asset('assets/img/user02.png') }}"
        @elseif (strcmp(Auth::user()->getRoleNames()[0], 'Personal Administrativo') === 0)
            src="{{ asset('assets/img/user01.png') }}"
        @elseif (strcmp(Auth::user()->getRoleNames()[0], 'Estudiante') === 0)
            src="{{ asset('assets/img/user03.png') }}"
        @endif
          {{-- src="{{asset('assets/img/user01.png')}}" --}}
          alt="user-picture"
          class="img-responsive img-circle center-box"
        />
      </figure>
      <li style="color: #fff; cursor: default">
        <span class="all-tittles">{{Auth::user()->nombres}}</span>
      </li>
      <li
        class="tooltips-general exit-system-button"
        data-href="{{ route('logout') }}"
        data-placement="bottom"
        title="Salir del sistema"
      >
        <i class="zmdi zmdi-power"></i>
      </li>
      {{-- <li
        class="tooltips-general search-book-button"
        data-href="searchbook.html"
        data-placement="bottom"
        title="Buscar libro"
      >
        <i class="zmdi zmdi-search"></i>
      </li>
      <li
        class="tooltips-general btn-help"
        data-placement="bottom"
        title="Ayuda"
      >
        <i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>
      </li> --}}
      <li
        class="mobile-menu-button visible-xs"
        style="float: left !important"
      >
        <i class="zmdi zmdi-menu" ></i>
      </li>
    </ul>
  </nav>