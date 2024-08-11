@extends('layout')
<head>
    <title>
        Editar Trabajo de Grado
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
                  Biblioteca Digital "Santiago Mariño"  <small>Editar Trabajo de Grado</small>
                </h1>
              </div>
            </div>

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
                  Bienvenido a la sección para editar trabajos de grado en la biblioteca,
                  modifique todos los campos que desee para poder modificar el registro
                </div>
              </div>
            </div>

            <div class="container-fluid">
                  <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Editar Trabajo de Grado</div>
                      <form action="{{route('tdg.update', ['tdg' => $tdg])}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                    placeholder="Escriba aquí el título del Trabajo de Grado"
                                    required=""
                                    maxlength="255"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Escriba el título del Trabajo de Grado"
                                    value="{{$tdg->publicaciones->titulo}}"
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
                                    title="Elige el autor del Trabajo de Grado"
                                    
                                  >
                                  @foreach($autores as $autor)
                                    <option
                                      value="{{ $autor->id }}"
                                      @if(in_array($autor->id, $tdg->publicaciones->autores()->pluck('id')->toArray())) selected @endif
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
                                    title="Seleccione la especialidad asociada al trabajo de grado"
                                  >
                                    <option value="" disabled="" selected="">
                                      Seleccionar carrera
                                    </option>
                                    @foreach($carreras as $carrera)
                                      <option value="{{ $carrera->id }}"
                                        @if($carrera->id == $tdg->publicaciones->carrera_id) 
                                          selected 
                                        @endif
                                        >
                                        {{ $carrera->nombre }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="group-material">
                                  <span>Línea de Investigación</span>
                                  <select
                                    class="tooltips-general material-control"
                                    name="linea_de_investigacion_id"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Seleccione la especialidad asociada al trabajo de grado"
                                  >
                                    <option value="" disabled="" selected="">
                                      Seleccionar línea de investigación
                                    </option>
                                    @foreach($lineas as $linea)
                                      <option value="{{ $linea->id }}"
                                        @if($linea->id == $tdg->linea_de_investigacion_id) 
                                          selected 
                                        @endif
                                        >
                                        {{ $linea->nombre }}</option>
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
                                  placeholder="Escribe aquí el año del Trabajo de grado"
                                  required=""
                                  pattern="[0-9]{1,4}"
                                  maxlength="4"
                                  data-toggle="tooltip"
                                  data-placement="top"
                                  title="Solamente números, sin espacios"
                                  value="{{$tdg->publicaciones->anio}}"
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
                                  title="Seleccione el tutor del autor del Trabajo de Grado"
                                >
                                  <option value="" disabled="" selected="">
                                    Seleccionar Tutor
                                  </option>
                                  @foreach($docentes as $docente)
                                    <option value="{{ $docente->nombres }}"
                                      @if (strcmp($tdg->tutor, $docente->nombres) == 0 )
                                        selected
                                      @endif
                                      >{{ $docente->nombres }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>
          
                              <div class="group-material">
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label for="resumen" id="resumen-label">Escriba el resumen del Trabajo de Grado...</label>
                                  <textarea
                                        class="form-control"
                                        style="white-space: normal"
                                        id="resumen"
                                        name="resumen"
                                        rows="15"
                                    >{{$tdg->resumen}}
                                  </textarea>
                                  
                              </div>
                              <div class="group-material">
                                  <input
                                    type="text"
                                    class="tooltips-general material-control"
                                    name="descriptores"
                                    placeholder="Escriba aquí los descriptores (separados por coma) del Trabajo de Grado"
                                    required=""
                                    maxlength="70"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Escriba los descriptores (separados por coma) del trabajo de grado"
                                    value="{{$tdg->descriptores}}"
                                  />
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Descriptores</label>
                                </div>
                              <div class="group-material">
                                  <span>Mención Honorífica</span>
                                  <select
                                    class="tooltips-general material-control"
                                    data-toggle="tooltip"
                                    name="mencion"
                                    data-placement="top"
                                    title="Seleccione la opción que corresponde"
                                  >
                                    <option value="" disabled="" selected="">
                                      Selecciona si el Trabajo de Grado fue de mención honorífica
                                    </option>
                                    <option value="Honorífica"
                                      @if(strcmp($tdg->mencion, "Honorífica") == 0 ) 
                                        selected 
                                      @endif
                                      >
                                      Sí
                                    </option>
                                    <option value="Regular"
                                      @if(strcmp($tdg->mencion, "Regular") == 0 ) 
                                        selected 
                                      @endif
                                      >
                                      No
                                    </option>
                                  </select>
                                </div>
                                
                                <div class="group-material">
                                  <input class="tooltips-general material-control" 
                                      type="file" 
                                      name="archivo" 
                                      id=""
                                      title="Seleccione el archivo que contiene el Trabajo de Grado"
                                  >
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Cargar Trabajo de Grado</label>
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
                      </form>
                  </div>
            </div>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                  var textarea = document.getElementById('resumen');
                  var label = document.getElementById('resumen-label');
          
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
@section('js')
  <script type="text/javascript">
    $('#carrera_id').on('change', function () {
      let id = $(this).val();

      if(id === null) {
        return false;
      }

      $.get('/get-lineas/'+id, function(data, status){
        $('#linea_de_investigacion_id').html('<option value="">Seleccionar línea de investigación</option>'+data.data);
      });
    });
  </script>
@endsection
