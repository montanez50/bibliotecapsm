@extends('layout')

<head>
    <title>
        Ver Trabajo de Grado
    </title>
</head>
@section('content')
<body>
    
    <x-side-nav-bar/>

    <div class="content-page-container full-reset custom-scroll-containers">
        
        <x-top-user-nav-bar/>

        <div class="container-fluid">
            <div class="page-header">
              <h1 class="all-tittles">
                Biblioteca Digital "Santiago Mariño"  <small>Ver Trabajo de Grado</small>
              </h1>
            </div>
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                        <li><a href="/tdg">Listado de Trabajos de Grado</a></li>
                        <li class="active">Mostrar Trabajo de Grado</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <div class="container-flat-form" style="padding-left: 15px; padding-right: 15px">
                    
                    <div class="row">
                        <div class="col">
                            <div class="title-flat-form">Detalles del Trabajo de Grado</div>
                        </div>
                    </div>

                    <div class="row" style="margin: 20px 0">
                        <div class="col-md-6 col-xs-3">
                            <img
                                src="{{asset('assets/img/flat-book.png')}}"
                                alt="pdf"
                                class="img-responsive center-box"
                            />
                        </div>

                            <div class="col-sm-9 col-md-6 text-justify lead">

                                <div class="col-sm-12 text-justify lead">
                                    <h3>Título:</h3>
                                    <h4>{{$tdg->publicaciones->titulo}}</h4>
                                </div>
                                    
                                <div class="col-sm-12 text-justify lead">
                                    <h3>Autor:</h3>
                                    <h4>{{implode(', ', $tdg->publicaciones->autores()->pluck('nombre')->toArray())}}</h4>
                                </div>  
                            </div>
                            
                    </div>
                
                    <div class="row" style="margin: 20px 0">
                        <div class="col-xs-7 col-sm-6 col-md-6 text-justify lead">
                            <h3>Año:</h3><h4>{{$tdg->publicaciones->anio}}</h4>
                        </div>
                        <div class="col-xs-7 col-sm-6 col-md-6 text-justify lead">
                            <h3>Descriptores:</h3>
                            <h4>{{$tdg->descriptores}}</h4>
                            <h3>Línea de investigación:</h3>
                            <h4>{{$tdg->lineas->nombre}}</h4>
                        </div>
                    </div>
                    
                    <div class="row" style="margin: 20px 0; position: relative;">
                        <div class="col text-justify lead">
                            <h3>Resumen:</h3>
                            <h4>{{$tdg->resumen}}</h4>
                        </div>
                    </div>
                    @hasanyrole('Personal Administrativo|Administrador')
                    <div class="row" style="margin: 20px 0">
                        <div class="col-xs-12 text-right lead" style="position: absolute; bottom: 0; right: 0;">
                            
                                    <button class="btn btn-warning">
                                        <a href="/tdg/{{$tdg->id}}/edit" >
                                            <i class="zmdi zmdi-edit" style="color: white"></i>
                                            <span style="color: white">&nbsp;Editar</span> 
                                        </a>
                                    </button>
                        </div>
                    </div>
                    @endhasanyrole
                </div>
            </div>
            <div class="container-fluid">
                <h2 class="text-center all-tittles">Ver archivo{{--ver el pdf y eso--}}</h2>
                <embed src="{{asset("storage/{$tdg->publicaciones->archivo}")}}" 
                    type="application/pdf" 
                    width="100%"
                    height="100%"
                />
            </div>
        </div>
    </div>
</body>
@endsection