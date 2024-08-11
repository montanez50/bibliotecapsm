@extends('layout')
<head>
    <title>Registrar usuario</title>
</head>
@section('content')
<body>
    <x-side-nav-bar />

    <div class="content-page-container full-reset custom-scroll-containers">
        <x-top-user-nav-bar />

        <div class="container">
            <div class="page-header">
                <h1 class="all-tittles">
                    Biblioteca Digital "Santiago Mariño"  <small>Administración Usuarios</small>
                </h1>
            </div>
        </div>
    {{-- <x-nav-tabs :activeTab='$activeTab'/> --}}
        <div class="container-fluid" style="margin: 50px 0">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img
                        src="{{asset('assets/img/user01.png')}}"
                        alt="user"
                        class="img-responsive center-box"
                        style="max-width: 110px"
                    />
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección para registrar nuevos
                    usuarios del sistema, debes de llenar todos los
                    campos del siguiente formulario para registrarlo
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                        <li class="active">Nuevo usuario</li>
                        <li>
                            <a href="/usuarios">Listado de usuarios</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    Registrar un nuevo usuario
                </div>
                <form action="{{route('user.store')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="group-material">
                                        
                                        <select 
                                            name="selecNacionalidad" 
                                            class="material-control tooltips-general"
                                            title="Seleccione el tipo de cédula del usuario"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                        >
                                            <option value="V">V</option>
                                            <option value="E">E</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="group-material">
                                        
                                        <input
                                            type="text"
                                            name="cedula"
                                            class="material-control tooltips-general"
                                            placeholder="Número de cédula"
                                            required=""
                                            pattern="\d\d\d\d\d\d\d\d"
                                            maxlength="8"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Escribe la cédula del usuario"
                                        />
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Número de Cédula</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="group-material">
                                <input
                                    type="text"
                                    name="nombres"
                                    class="material-control tooltips-general"
                                    placeholder="Nombre completo"
                                    required=""
                                    maxlength="70"
                                    pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,70}"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Escribe el nombre del usuario"
                                />
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre(s)</label>
                            </div>
                            <div class="group-material">
                                <input
                                    type="email"
                                    name="correo"
                                    class="material-control tooltips-general"
                                    placeholder="correo electrónico"
                                    required=""
                                    maxlength="70"
                                    pattern="[-A-Za-z0-9!#$%&'*+/=?^_`{|}~]+(?:\.[-A-Za-z0-9!#$%&'*+/=?^_`{|}~]+)*@(?:[A-Za-z0-9](?:[-A-Za-z0-9]*[A-Za-z0-9])?\.)+[A-Za-z0-9](?:[-A-Za-z0-9]*[A-Za-z0-9])?"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Escribe el correo del usuario"
                                />
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Correo electrónico</label>
                            </div>
                            <div class="group-material">
                                <span>Rol de usuario</span>
                                <select
                                  class="tooltips-general material-control"
                                  name="role"
                                  data-toggle="tooltip"
                                  data-placement="top"
                                  title="Seleccione el rol del usuario en el sistema"
                                >
                                  <option value="" disabled="" selected="">
                                    Seleccionar rol de usuario
                                  </option>
                                  @foreach($roles as $rol)
                                    <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            <div class="group-material">
                                <input
                                    type="password"
                                    name="password"
                                    class="material-control tooltips-general"
                                    placeholder="Contraseña"
                                    required=""
                                    maxlength="200"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Escribe una contraseña"
                                />
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Contraseña</label>
                            </div>
                            <div class="group-material">
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="material-control tooltips-general"
                                    placeholder="Repite la contraseña"
                                    required=""
                                    maxlength="200"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Repite la contraseña"
                                />
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Repetir contraseña</label>
                            </div>
                            @if ($errors->any())
                                  @foreach ($errors->all() as $error)
                                      <div>{{$error}}</div>
                                  @endforeach
                            @endif
                            <p class="text-center">
                                <button
                                    type="reset"
                                    class="btn btn-info"
                                    style="margin-right: 20px"
                                >
                                    <i class="zmdi zmdi-roller"></i>
                                    &nbsp;&nbsp; Limpiar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="zmdi zmdi-floppy"></i>
                                    &nbsp;&nbsp; Guardar
                                </button>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <x-dialog-ayuda-sistema />

        <x-footer />
    </div>
</body>
@endsection
