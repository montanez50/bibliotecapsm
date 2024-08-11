@extends('layout')
<head>
    <title>
        Autores
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
                Biblioteca Digital "Santiago Mariño"  <small>Administración Autores</small>
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
                    Bienvenido a la sección para modificar un autor, reintroduzca el nombre 
                    completo del autor que modificará en el siguiente formulario
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                        <li><a href="/autores">Listado de autores</a></li>
                        <li class="active">Modificación de autor</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">
                    Modificar autor
                </div>
                <form autocomplete="off" method="POST" action="{{route('autor.update', ['autor' => $autor])}}">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <div class="group-material">
                                <input
                                    type="text"
                                    class="material-control tooltips-general"
                                    name="nombre"
                                    placeholder="Nombre del autor"
                                    required=""
                                    maxlength="50"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Escriba los nombres del autor"
                                    value="{{$autor->nombre}}"
                                />
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre del autor</label>
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