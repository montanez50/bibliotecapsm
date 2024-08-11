@extends('layout')
<head>
    <title>Buscar Guía</title>
</head>
@section('content')
<body>
    <x-side-nav-bar />

    <div class="content-page-container full-reset custom-scroll-containers">
        <x-top-user-nav-bar />

        <div class="container">
            <div class="page-header">
                <h1 class="all-tittles">
                    Biblioteca Digital "Santiago Mariño"  <small>Catálogo de Videos</small>
                </h1>
            </div>
        </div>

        <x-nav-tabs-recursos-index :activeTab='$activeTab'/>
        
        <div class="container-fluid" style="margin: 40px 0">

            <div class="row" style="padding: 15px">
                <div class="col-xs-6 col-xs-offset-1" style="margin-bottom: 20px">
                    <form action="{{ route('guia.index') }}" method="GET" class="form-inline">
                        
                        <div class="col-sm-8">
                            <input type="text" 
                            class="search-input"
                            name="buscar" 
                            placeholder="Búsqueda..."
                            >
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="search-button">
                                <i class="zmdi zmdi-search zmdi-hc-lg"></i>&nbsp;
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-xs-4 text-right" style="margin-bottom: 20px">
                    <form action="{{ route('guia.index') }}" method="GET" id="sortForm" class="form-inline">
                        <div class="form-group">
                            <label for="sort">Ordenar por:</label>
                            <select name="sort" id="sort" class="form-control" onchange="document.getElementById('sortForm').submit();">
                                <option value="">Seleccione</option>
                                <option value="titulo_asc" {{ request('sort') == 'titulo_asc' ? 'selected' : '' }}>Título (A-Z)</option>
                                <option value="titulo_desc" {{ request('sort') == 'titulo_desc' ? 'selected' : '' }}>Título (Z-A)</option>
                                <option value="anio_asc" {{ request('sort') == 'anio_asc' ? 'selected' : '' }}>Año (Ascendente)</option>
                                <option value="anio_desc" {{ request('sort') == 'anio_desc' ? 'selected' : '' }}>Año (Descendente)</option>
                                <option value="asignatura_asc" {{ request('sort') == 'asignatura_asc' ? 'selected' : '' }}>Asigntura (Ascendente)</option>
                                <option value="asignatura_desc" {{ request('sort') == 'asignatura_desc' ? 'selected' : '' }}>Asignatura (Descendente)</option>
                            </select>
                        </div>
                        <input type="hidden" name="carrera" value="{{ request('carrera') }}">
                        <input type="hidden" name="buscar" value="{{ request('buscar') }}">
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img
                        src="{{asset('assets/img/checklist.png')}}"
                        alt="pdf"
                        class="img-responsive center-box"
                        style="max-width: 110px"
                    />
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido al catálogo de guías, selecciona una carrera de la lista
                    para filtrar, si deseas buscar una guía por materia o título
                    has click en el icono &nbsp;
                    <i class="zmdi zmdi-search"></i> &nbsp; que se encuentra en
                    la barra superior
                </div>
            </div>
        </div>
        <div class="container-fluid" style="margin: 0 0 50px 0">
            <h2 class="text-center" style="margin: 0 0 25px 0">Filtrar por carreras</h2>
            <ul class="list-unstyled text-center list-catalog-container">
                @foreach ($carreras as $carrera)
                <li class="list-catalog" data-id="{{$carrera->id}}">
                    <a 
                    style="text-decoration: none;" 
                    href="{{route('guia.index', ['carrera' => $carrera->id])}}"
                    >
                        {{$carrera->nombre}}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="container-fluid">
            @foreach ($guias as $guia)
                
            <div class="media media-hover">
                <div class="media-left media-middle">
                    <a
                        href="guias/{{$guia->id}}"
                        class="tooltips-general"
                        data-toggle="tooltip"
                        data-placement="right"
                        title="Más información del guia"
                    >
                        <img
                            class="media-object"
                            src="{{asset('assets/img/book.png')}}"
                            alt="guia clase"
                            width="48"
                            height="48"
                        />
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{$guia->id}} - {{$guia->titulo}}</h4>
                    <div class="pull-left">
                        <strong>{{$guia->publicaciones->autores()->pluck('nombre')->implode(', ')}} </strong>
                        <br>
                        <strong>{{$guia->publicaciones->anio}}<br /> </strong>
                        <strong>{{$guia->asignatura_nombre}}<br /> </strong>
                    </div>
                    <div class="text-center pull-right">
                        <a
                            href="guias/{{$guia->id}}"
                            class="btn btn-info btn-xs"
                            style="margin-right: 10px"
                            ><i class="zmdi zmdi-info-outline"></i> &nbsp;&nbsp;
                            Más información</a
                        >
                        @if(Auth::user()->id == $guia->publicaciones->user_id || strcmp(Auth::user()->getRoleNames()[0], 'Administrador') === 0)
                        <form id="/guias/{{$guia->id}}" action="{{route('guia.destroy', ['guia' => $guia])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-xs delete-guia-button" 
                            style="margin-top: 10px"
                            data-id="{{$guia->id}}"
                            >
                                <i class="zmdi zmdi-delete"></i>&nbsp;&nbsp;Eliminar Guía
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            <div class="text-center">
                {{ $guias->links() }}
            </div>
        </div>

        <x-dialog-ayuda-sistema />
        <x-footer />
    </div>
</body>

@endsection
