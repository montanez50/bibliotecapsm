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
                <div class="col-xs-12" style="margin-bottom: 20px">
                    <form action="{{ route('libro.index') }}" method="GET" class="form-inline">
                        
                        <div class="col-sm-8">
                            <input type="text" 
                            class="search-input"
                            name="buscar" 
                            placeholder="Búsqueda..."
                            >
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="search-button">
                                <i class="zmdi zmdi-search zmdi-hc-lg"></i>&nbsp;
                            </button>
                        </div>
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
                            src="{{asset('assets/img/book.png')}}"
                            alt="Libro"
                            width="48"
                            height="48"
                        />
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{$libro->id}} - {{$libro->publicaciones->titulo}}</h4>
                    <div class="pull-left">
                        @foreach ($libro->publicaciones->autores as $autor)
                            <strong>{{$autor->nombre}}<br /></strong>
                        @endforeach
                        <strong>{{$libro->publicaciones->anio}}<br /> </strong>
                    </div>
                    <div class="text-center pull-right">
                        <a
                            href="libros/{{$libro->id}}"
                            class="btn btn-info btn-xs"
                            style="margin-right: 10px"
                            ><i class="zmdi zmdi-info-outline"></i> &nbsp;&nbsp;
                            Más información</a
                        >
                        <form action="/libros/{{$libro->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-xs" style="margin-top: 10px"><i class="zmdi zmdi-delete"></i>&nbsp;&nbsp;Eliminar libro</button>
                        </form>
                    </div>

                </div>
            </div>
            @endforeach
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
