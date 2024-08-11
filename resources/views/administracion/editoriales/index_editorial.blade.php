@extends('layout')

<head>
    <title>
        Editoriales
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
                Biblioteca Digital "Santiago Mariño" <small>Administración Editoriales</small>
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
                Bienvenido a la sección donde se encuentra el listado de editoriales
                en la universidad. Puedes actualizarlas o eliminarlas según corresponda.
            </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
            <div class="col-xs-12 lead">
                <ol class="breadcrumb">
                    <li class="active">Listado de editoriales</li>
                    <li><a href="editoriales/create">Nueva editorial</a></li>
                </ol>
            </div>
            </div>
        </div>
        <div class="container-fluid">
            <h2 class="text-center all-tittles">listado de editoriales</h2>
            <div class="div-table">
            <div class="div-table-row div-table-head">
                <div class="div-table-cell">#</div>
                <div class="div-table-cell">Nombre</div>
                <div class="div-table-cell">Actualizar</div>
                <div class="div-table-cell">Eliminar</div>
            </div>
            @foreach ($editoriales as $editorial)
                <div class="div-table-row">
                    <div class="div-table-cell">{{$editorial->id}} </div>
                    <div class="div-table-cell">{{$editorial->nombre}}</div>
                    <div class="div-table-cell">
                        <a href="editoriales/{{$editorial->id}}/edit" class="btn btn-success">
                            <i style="color: white" class="zmdi zmdi-refresh"></i>
                        </a>
                    </div>
                    <div class="div-table-cell">
                        <form action="{{route('editorial.destroy', ['editorial' => $editorial])}}" method="post">
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