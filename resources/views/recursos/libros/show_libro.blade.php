@extends('layout')
<head>
    <title>
        Ver Libro
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
                        Biblioteca Digital "Santiago Mariño"  <small>Ver Libro</small>
                    </h1>
                </div>

                <div class="row">
                    <div class="col-sm-12 lead">
                        <ol class="breadcrumb">
                            <li><a href="/libros">Listado de libros </a></li>
                            <li class="active">Mostrar libro</a></li>
                        </ol>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="container-flat-form" style="padding-left: 15px; padding-right: 15px">
                        <div class="row">
                            <div class="col text-justify lead">
                                <div class="title-flat-form">Detalles del Libro</div>
                            </div>

                        </div>
                        <div class="row justify-content-start" style="margin: 20px 0">
                            
                            <div class="col-md-6 col-sm-3">
                                <img
                                    src="{{asset('assets/img/flat-book.png')}}"
                                    alt="pdf"
                                    class="img-responsive center-box"
                                />
                            </div>
                            <div class="col-sm-9 col-md-6 text-justify lead">
                                <div class="col-sm-12 text-justify lead">
                                    <h3>Título:</h3>
                                    <h4>{{$libro->publicaciones->titulo}}</h4>
                                </div>
                                <div class="col-sm-12 text-justify lead">
                                    <h3>Autor(es):</h3>
                                    <h4>{{implode(', ', $libro->publicaciones->autores->pluck('nombre')->toArray())}}</h4>                                
                                </div> 
                                <div class="col-sm-12 text-justify lead">
                                    <h3>Año:</h3>
                                    <h4>{{$libro->publicaciones->anio}}</h4>
                                    <h3>Estado del libro en la institución:</h3>
                                    <h4>{{$libro->estado}}</h4>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8  text-justify lead">
                                    <h3>Editorial:</h3>
                                    <h4>{{$libro->editoriales->nombre}}</h4>
                                    <h3>Clasaificación decimal (Dewey):</h3>
                                    <h4>{{$libro->dewey}}</h4>
                                </div>
                            </div>
                        </div>
                        @hasanyrole('Personal Administrativo|Administrador')
                        <div class="row" style="margin: 20px 0">
                            <div class="col-xs-12 col-sm-8 col-md-8  text-right lead" style="position: absolute; bottom: 0; right: 0;">
                                <button class="btn btn-warning">
                                    <a href="/libros/{{$libro->id}}/edit">
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
                    <embed src="{{asset("storage/{$libro->publicaciones->archivo}")}}" 
                        type="application/pdf" 
                        width="100%"
                        height="100%"
                    />
                </div>
            </div>
                
                <x-dialog-ayuda-sistema/>

                <x-footer/>    
        </div>
    </body>
@endsection