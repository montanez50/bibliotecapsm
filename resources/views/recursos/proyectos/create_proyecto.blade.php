@extends('layout')

<head>
    <title>
        Cargar Proyecto Comunitario
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
                Biblioteca Digital "Santiago Mariño"  <small>Añadir Proyecto Comunitario</small>
              </h1>
            </div>
          </div>

          <x-nav-tabs-recursos-create :activeTab='$activeTab' />
          
          <div class="container-fluid" style="margin: 50px 0">
            <div class="row">
              <div class="col-xs-12 col-sm-4 col-md-3">
                <img
                  src="{{asset('assets/img/flat-book.png')}}"
                  alt="pdf"
                  class="img-responsive center-box"
                  style="max-width: 110px"
                />
              </div>
              <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                Bienvenido a la sección para agregar nuevos Proyectos Comunitarios a la biblioteca,
                deberas de llenar todos los campos para poder registrar el proyecto
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <form action="{{route('proyecto.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
              <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Nuevo Proyecto Comunitario</div>
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
                          placeholder="Escriba aquí el título del Proyecto Comunitario"
                          required=""
                          maxlength="70"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Escriba el título del Proyecto Comunitario"
                        />
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Título</label>
                      </div>
                      <div class="group-material">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label for="autor_id[]">Autores</label>
                        <select
                          class="tooltips-general material-control select2"
                          multiple="multiple"
                          data-toggle="tooltip"
                          data-placement="top" 
                          name="autor_id[]"
                          title="Elige los autores del Proyecto Comunitario"
                          
                        >
                        @foreach($autores as $autor)
                          <option value="{{ $autor->id }}">{{ $autor->nombre }}</option>
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
                          title="Seleccione la especialidad asociada al proyecto comunitario"
                        >
                          <option value="" disabled="" selected="">
                            Seleccionar carrera
                          </option>
                          @foreach($carreras as $carrera)
                            <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                          @endforeach
                        </select>
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
                        placeholder="Escribe aquí el año del Proyecto Comunitario"
                        required=""
                        pattern="[0-9]{1,4}"
                        maxlength="4"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Solamente números, sin espacios"
                      />
                      <span class="highlight"></span>
                      <span class="bar"></span>
                      <label>Año</label>
                    </div>

                    <div class="group-material">
                      <span>Tutor</span>
                      <select
                        class="tooltips-general material-control"
                        id="tutor"
                        name="tutor"
                        required=""
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Seleccione el tutor de los autores del Proyecto Comunitario"
                      >
                        <option value="" disabled="" selected="">
                          Seleccionar Tutor
                        </option>
                        @foreach($docentes as $docente)
                          <option value="{{ $docente->nombres }}">{{ $docente->nombres }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="group-material">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label for="descripcion" id="descripcion-label">Escriba la descripción del Proyecto Comunitario...</label>
                        <textarea
                              class="form-control"
                              style="white-space: normal"
                              id="descripcion"
                              name="descripcion"
                              rows="15"
                          >{{old('descripcion')}}
                        </textarea>
                        
                    </div>
                    
                      <div class="group-material">
                        <input class="tooltips-general material-control" 
                            type="file" 
                            name="archivo" 
                            id=""
                            title="Seleccione el archivo que contiene el Proyecto Comunitario"
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Cargar Proyecto Comunitario</label>
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