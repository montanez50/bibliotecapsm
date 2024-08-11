@extends('layout')
<head>
    <title>
        Líneas de Investigación
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
                Biblioteca Digital "Santiago Mariño" <small>Administración Líneas de Investigación</small>
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
                    Bienvenido a la sección para modificar una Líneas de Investigación, introduzca el nombre 
                    y la carrera a las que pertenece la línea en el siguiente formulario
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                        <li><a href="/lineas">Listado de Líneas</a></li>
                        <li class="active">Modificación de línea</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    Modificar Líneas de Investigación
                </div>
                <form autocomplete="off" method="POST" action="{{route('linea.update', ['linea' => $linea])}}">
                    @method('PUT')
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
                                    title="Escriba el nombre de la línea"
                                    value="{{$linea->nombre}}"
                                />
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre de la línea de investigación</label>
                            </div>
                                
                                <div class="group-material">
                                  <span>Carrera</span>
                                  <select
                                    class="tooltips-general material-control"
                                    name="carrera_id"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Seleccione la carrera a la que pertenece la línea"
                                  >
                                    @foreach($carreras as $carrera)
                                        <option value="{{ $carrera->id }}" 
                                            @if($carrera->id == $linea->carrera_id) selected @endif
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