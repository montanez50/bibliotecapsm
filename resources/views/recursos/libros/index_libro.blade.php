@extends('layout')
<head>
    <title>Catálogo de libros</title>
</head>
@section('content')
<body>
    <x-side-nav-bar />

    <div class="content-page-container full-reset custom-scroll-containers">
        <x-top-user-nav-bar />

        <div class="container">
            <div class="page-header">
                <h1 class="all-tittles">
                    Biblioteca Digital "Santiago Mariño"  <small>Catálogo de libros</small>
                </h1>
            </div>
        </div>

        <x-nav-tabs-recursos-index :activeTab='$activeTab' />

        <div class="container-fluid" style="margin: 40px 0">
            
            <div class="row" style="padding: 15px">
                <div class="col-xs-6 col-xs-offset-1" style="margin-bottom: 20px">
                    <form action="{{ route('libro.index') }}" method="GET" class="form-inline">
                        
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
                    <form action="{{ route('libro.index') }}" method="GET" id="sortForm" class="form-inline">
                        <div class="form-group">
                            <label for="sort">Ordenar por:</label>
                            <select name="sort" id="sort" class="form-control" onchange="document.getElementById('sortForm').submit();">
                                <option value="">Seleccione</option>
                                <option value="titulo_asc" {{ request('sort') == 'titulo_asc' ? 'selected' : '' }}>Título (A-Z)</option>
                                <option value="titulo_desc" {{ request('sort') == 'titulo_desc' ? 'selected' : '' }}>Título (Z-A)</option>
                                <option value="dewey_asc" {{ request('sort') == 'dewey_asc' ? 'selected' : '' }}>Número Dewey (Ascendente)</option>
                                <option value="dewey_desc" {{ request('sort') == 'dewey_desc' ? 'selected' : '' }}>Número Dewey (Descendente)</option>
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
                    Bienvenido al catálogo, selecciona una categoría de la lista
                    para empezar, si deseas buscar un libro por nombre o título
                    has click en el icono &nbsp;
                    <i class="zmdi zmdi-search"></i> &nbsp; que se encuentra en
                    la barra superior
                </div>
            </div>
        </div>
        <div class="container-fluid" style="margin: 0 0 50px 0">
            <h2 class="text-center" style="margin: 0 0 25px 0">Filtrar por carreras</h2>
            <ul class="list-unstyled text-center list-catalog-container" id="lista-carrera">
                @foreach ($carreras as $carrera)
                    <li class="list-catalog" data-id="{{$carrera->id}}">
                        <a 
                        style="text-decoration: none;" 
                        href="{{route('libro.index', ['carrera' => $carrera->id])}}"
                        >
                            {{$carrera->nombre}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="container-fluid">
            @foreach ($libros as $libro)
            <div class="media media-hover">
                <div class="media-left media-middle">
                    <a
                        href="libros/{{$libro->id}}"
                        class="tooltips-general"
                        data-toggle="tooltip"
                        data-placement="right"
                        title="Más información del libro"
                    >
                        <img
                            class="media-object"
                            id="{{ $libro->id }}"
                            src="{{asset('assets/img/book.png')}}"
                            alt="Libro"
                            width="48"
                            height="48"
                        />
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{$libro->id}} - {{$libro->titulo}}</h4>
                    <div class="pull-left">
                        <strong>{{$libro->publicaciones->autores()->pluck('nombre')->implode(', ')}} </strong>
                        <br>
                        <strong>{{$libro->publicaciones->anio}}<br /> </strong>
                        <strong>{{$libro->asignatura_nombre}}</strong>
                    </div>
                    <div class="text-center pull-right">
                        <a
                            href="libros/{{$libro->id}}"
                            class="btn btn-info btn-xs"
                            style="margin-right: 10px"
                            ><i class="zmdi zmdi-info-outline"></i> &nbsp;&nbsp;
                            Más información</a
                        >
                        @hasanyrole('Personal Administrativo|Administrador')
                        <form id="/libros/{{$libro->id}}" action="/libros/{{$libro->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-xs delete-libro-button" 
                                style="margin-top: 10px"
                                data-id="{{$libro->id}}"
                                ><i class="zmdi zmdi-delete"></i>
                                &nbsp;&nbsp;Eliminar libro
                            </button>
                        </form>
                        @endhasanyrole
                    </div>
                </div>
            </div>
            @endforeach
            <div class="text-center">
                {{ $libros->links() }}
            </div>
        </div>

        <x-dialog-ayuda-sistema />
        <x-footer />
    </div>
    <script>
        const listaCarrera = document.getElementById('lista-carrera');
        // const filterButton = document.getElementById('filter-button');

        // Add an event listener to each li element
        listaCarrera.querySelectorAll('li').forEach((li) => {
            li.addEventListener('click', () => {
                const carreraId = li.dataset.id;
                if (carreraId) {
                    fetch(`/libros/filter?carrera_id=${carreraId}`)
                .then(response => response.json())
                .then(data => {
                            // Actualiza la vista con los libros filtrados
                            console.log(data);
                        });
                }
            });
        });
        // $(document).ready(function() {
        //     $('.media-object').each(function() {
        //         var libroId = $(this).attr('id');
        //         var imgElement = $(this);

        //         $.get('/libro-first-page/' + libroId, function(data) {
        //             if (data.image) {
        //                 imgElement.attr('src', data.image);
        //             }
        //         });
        //     });
        // });

        // Add an event listener to the filter button
        // filterButton.addEventListener('click', () => {
        //     const carreraId = carreraList.querySelector('li.selected').dataset.id;
        //     if (carreraId) {
        //         fetch(`/libros/filter?carrera_id=${carreraId}`)
        //         .then(response => response.json())
        //         .then(data => {
        //                 // Update the view with the filtered libros records
        //                 console.log(data);
        //             });
        //     }});
    </script>
</body>

@endsection
