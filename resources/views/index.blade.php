@extends('layout')
<head>
    <title>Inicio</title>
</head>
@section('content')
    <x-side-nav-bar/>
    
    <div class="content-page-container full-reset custom-scroll-containers">
        
        <x-top-user-nav-bar/>

        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">
                Biblioteca Digital "Santiago Mariño" <small>Inicio</small>
              </h1>
            </div>
        </div>
        <section class="full-reset text-center" style="padding: 40px 0">
        <article class="tile">
            <div class="tile-icon full-reset"><i class="zmdi zmdi-face" style="margin: 25px"></i></div>
            <div class="tile-name all-tittles">administradores</div>
            <div class="tile-num full-reset">{{$admins}}</div>
        </article>
        <article class="tile">
            <div class="tile-icon full-reset">
            <i class="zmdi zmdi-accounts" style="margin: 25px"></i>
            </div>
            <div class="tile-name all-tittles">estudiantes</div>
            <div class="tile-num full-reset">{{$estudiantes}}</div>
        </article>
        <article class="tile">
            <div class="tile-icon full-reset">
            <i class="zmdi zmdi-male-alt" style="margin: 25px"></i>
            </div>
            <div class="tile-name all-tittles">docentes</div>
            <div class="tile-num full-reset">{{$docentes}}</div>
        </article>
        <article class="tile">
            <div class="tile-icon full-reset">
            <i class="zmdi zmdi-male-female" style="margin: 25px"></i>
            </div>
            <div class="tile-name all-tittles" style="width: 90%">
            personal administrativo
            </div>
            <div class="tile-num full-reset">{{$personalAdministrativo}}</div>
        </article>

        <article class="tile">
            <div class="tile-icon full-reset"><i class="zmdi zmdi-book" style="margin: 25px"></i></div>
            <div class="tile-name all-tittles">libros</div>
            <div class="tile-num full-reset">{{$libros}}</div>
        </article>
        <article class="tile">
            <div class="tile-icon full-reset"><i class="zmdi zmdi-book" style="margin: 25px"></i></div>
            <div class="tile-name all-tittles">Trabajos de Grado</div>
            <div class="tile-num full-reset">{{$tdg}}</div>
        </article>
        <article class="tile">
            <div class="tile-icon full-reset"><i class="zmdi zmdi-book" style="margin: 25px"></i></div>
            <div class="tile-name all-tittles">Proyectos Comunitarios</div>
            <div class="tile-num full-reset">{{$proyectos}}</div>
        </article>
        <article class="tile">
            <div class="tile-icon full-reset"><i class="zmdi zmdi-videocam" style="margin: 25px"></i></div>
            <div class="tile-name all-tittles">Videos</div>
            <div class="tile-num full-reset">{{$videos}}</div>
        </article>
        </section>
        
        <x-dialog-ayuda-sistema/>
        
        <x-footer/>

    </div>
    
@endsection