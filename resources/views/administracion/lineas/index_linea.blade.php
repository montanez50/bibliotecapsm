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
                Bienvenido a la sección donde se encuentra el listado de Líneas de Investigación
                en la universidad, y sus carreras asociadas. Puedes actualizar o eliminar los datos de las mismas.
            </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
            <div class="col-xs-12 lead">
                <ol class="breadcrumb">
                    <li class="active">Listado de Líneas</li>
                    <li><a href="lineas/create">Nueva Línea de Investigación</a></li>
                </ol>
            </div>
            </div>
        </div>
        <div class="container-fluid">
            <h2 class="text-center all-tittles">listado de Líneas de Investigación</h2>
            <div class="div-table">
            <div class="div-table-row div-table-head">
                <div class="div-table-cell">#</div>
                <div class="div-table-cell">Nombre</div>
                <div class="div-table-cell">Carrera asociada</div>
                <div class="div-table-cell">Actualizar</div>
                <div class="div-table-cell">Eliminar</div>
            </div>
            @foreach ($lineas as $linea)
                <div class="div-table-row">
                    <div class="div-table-cell">{{$linea->id}} </div>
                    <div class="div-table-cell">{{$linea->nombre}}</div>
                    <div class="div-table-cell">{{$linea->carreras->nombre}} <br></div>
                    <div class="div-table-cell">
                        <a href="lineas/{{$linea->id}}/edit" class="btn btn-success">
                            <i style="color: white" class="zmdi zmdi-refresh"></i>
                        </a>
                    </div>
                    <div class="div-table-cell">
                        <form action="lineas/{{$linea->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                        </form>
                        
                    </div>
                </div>
            @endforeach
            
            
            </div>
        </div>
        
        <x-dialog-ayuda-sistema/>
            
        <x-footer/>
    </div>
</body>    

@endsection