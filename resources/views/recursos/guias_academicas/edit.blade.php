@extends('layout')

<head>
    <title>
        Editar Guía
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
                Biblioteca Digital "Santiago Mariño"  <small>Editar Guías académicas</small>
              </h1>
            </div>
          </div>
          <div class="container-fluid" style="margin: 50px 0">
            <div class="row">
              <div class="col-xs-12 col-sm-4 col-md-3">
                <img
                  src="{{asset('assets/img/flat-book.png')}}"
                  alt="guia"
                  class="img-responsive center-box"
                  style="max-width: 110px"
                />
              </div>
              <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                Bienvenido a la sección para editar guías en la biblioteca,
                modifique todos los campos que desee para poder modificar el registro
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <form action="{{route('guia.update', ['guia' => $guia])}}" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Editar Guía académica</div>
                <div class="row">
                  <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <legend><strong>Información básica</strong></legend>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="group-material">
                        <input
                          type="text"
                          class="tooltips-general material-control"
                          name="titulo"
                          placeholder="Escriba aquí el título de la clase"
                          required=""
                          maxlength="255"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Escriba el título de la clase"
                          value="{{$guia->publicaciones->titulo}}"
                        />
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Título</label>
                      </div>
                      <div class="group-material">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label for="autor_id[]">Autor</label>
                        <select
                          class="tooltips-general material-control select2"
                          multiple="multiple"
                          data-toggle="tooltip"
                          data-placement="top" 
                          name="autor_id[]"
                          title="Elige el autor del guia"
                          
                        >
                        @foreach($autores as $autor)
                        <option
                        value="{{ $autor->id }}"
                        @if(in_array($autor->id, $guia->publicaciones->autores()->pluck('id')->toArray())) selected @endif
                        >
                            {{ $autor->nombre }}
                        </option>
                        @endforeach
                        </select>
    
                      </div>
                      <div class="group-material">
                        <span>Especialidad</span>
                        <select
                          class="tooltips-general material-control"
                          name="carrera_id"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Seleccione la especialidad asociada a la clase cargada"
                        >
                          <option value="" disabled="" selected="">
                            Seleccionar carrera
                          </option>
                          @foreach($carreras as $carrera)
                          <option value="{{ $carrera->id }}"
                            @if($carrera->id == $guia->publicaciones->carrera_id) 
                              selected 
                            @endif
                            >
                            {{ $carrera->nombre }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="group-material">
                        <span>Asignatura</span>
                        <select
                          class="tooltips-general material-control"
                          name="asignatura_id"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Seleccione la asignatura a la que corresponde el guia"
                        >
                          <option value="" disabled="" selected="">
                            Seleccionar asignatura
                          </option>
                          @foreach($asignaturas as $asignatura)
                          <option value="{{ $asignatura->id }}"
                            @if($asignatura->id == $guia->asignatura_id) 
                              selected 
                            @endif
                            >
                            {{ $asignatura->nombre }}</option>
                          @endforeach
                        </select>
                        @error('asignatura_id')
                          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-8 col-sm-offset-2"> 
                    <legend><strong>Otros datos</strong></legend>
                  </div>
                </div> 
                <div class="row">
                  <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="group-material">
                      <input
                        type="text"
                        class="material-control tooltips-general"
                        name="anio"
                        placeholder="Escribe aquí el año del guia"
                        required=""
                        pattern="[0-9]{1,4}"
                        maxlength="4"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Solamente números, sin espacios"
                        value="{{$guia->publicaciones->anio}}"
                      />
                      <span class="highlight"></span>
                      <span class="bar"></span>
                      <label>Año</label>
                    </div>

                    <div class="group-material">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label for="descripcion" id="descripcion-label">Escriba una breve descripción de la clase...</label>
                        <textarea
                              class="form-control"
                              style="white-space: normal"
                              id="descripcion"
                              name="descripcion"
                              rows="15"
                          >{{$guia->descripcion}}
                        </textarea>
                        
                    </div>
                    
                      <div class="group-material">
                        <input class="tooltips-general material-control" 
                            type="file" 
                            name="archivo" 
                            id=""
                            title="Seleccione el archivo que contiene el guia"
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Cargar Guías académicas</label>
                      </div>
                      @if ($errors->any())
                                  @foreach ($errors->all() as $error)
                                      <div>{{$error}}</div>
                                  @endforeach
                      @endif
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
              </div>
            </form>
          </div>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
                var textarea = document.getElementById('descripcion');
                var label = document.getElementById('descripcion-label');
        
                textarea.addEventListener('focus', function() {
                    label.classList.add('hidden-label');
                });
        
                textarea.addEventListener('input', function() {
                    if (textarea.value.trim() === '') {
                        label.classList.remove('hidden-label');
                    } else {
                        label.classList.add('hidden-label');
                    }
                });
        
                textarea.addEventListener('blur', function() {
                    if (textarea.value.trim() === '') {
                        label.classList.remove('hidden-label');
                    }
                });
        
                // Ocultar label si textarea ya tiene texto al cargar la página
                if (textarea.value.trim() !== '') {
                    label.classList.add('hidden-label');
                }
            });
          </script>
        
          <x-dialog-ayuda-sistema/>

          <x-footer/>
          
    </div>
</body>
@endsection