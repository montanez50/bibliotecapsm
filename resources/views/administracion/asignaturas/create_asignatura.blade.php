@extends('layout')
<head>
    <title>
        Asignaturas
    </title>
</head>
@section('content')
<body>
   
    <x-side-nav-bar/>

    <div class="content-page-container full-reset custom-scroll-containers">
        
        <x-top-user-nav-bar/>

        <div class="container">
            <div class="page-header">
            <h1 class="all-tittles">
                Biblioteca Digital "Santiago Mariño"  <small>Administración Asignaturas</small>
            </h1>
            </div>
        </div>

        <x-nav-tabs-admin :activeTab='$activeTab'/>

        <div class="container-fluid" style="margin: 50px 0">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img
                    src="{{asset('assets/img/user04.png')}}"
                    alt="user"
                    class="img-responsive center-box"
                    style="max-width: 110px"
                    />
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección para registrar una nueva asignatura, introduzca el nombre 
                    y la(s) carrera(s) a las que pertenece la asignatura en el siguiente formulario
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                    <li><a href="/asignaturas">Listado de asignaturas</a></li>
                    <li class="active">Nueva asignatura</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    Agregar una nueva asignatura
                </div>
                <form autocomplete="off" method="POST" action="/asignaturas">
                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <div class="group-material">
                                <input
                                    type="text"
                                    class="material-control tooltips-general"
                                    name="nombre"
                                    placeholder="Nombre de la asignatura"
                                    required=""
                                    maxlength="50"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Escriba el nombre de la asignatura"
                                />
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre de la asignatura</label>
                            </div>
                                
                                <div class="group-material">
                                  <span>Carrera</span>
                                  <select
                                    class="tooltips-general material-control select2"
                                    name="carrera_id[]"
                                    multiple="multiple"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Seleccione la carrera en la que se imparte la asignatura"
                                  >
                                    @foreach($carreras as $carrera)
                                        <option value="{{ $carrera->id }}" 
                                        >
                                          {{ $carrera->nombre }}
                                        </option>
                                    @endforeach
      
                                  </select>
                                  @error('carrera_id')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                  @enderror
                                </div>
                                @if ($errors->any())
                                  @foreach ($errors->all() as $error)
                                      <div>{{$error}}</div>
                                  @endforeach
                                @endif
                            <div class="group-material">
                                                                                   
                                <p class="text-center">
                                <button
                                    type="reset"
                                    class="btn btn-info"
                                    style="margin-right: 20px"
                                >
                                    <i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar
                                </button>
                                </p>
                            </div>
                    </div>
                </form>
            </div>
        </div>
        <x-dialog-ayuda-sistema/>
            
        <x-footer/>
    </div>
  </body>
@endsection