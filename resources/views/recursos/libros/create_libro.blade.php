@extends('layout')
<head>
    <title>
        Cargar libro
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
                  Biblioteca Digital "Santiago Mariño"  <small>Añadir libro</small>
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
                  Bienvenido a la sección para agregar nuevos libros a la biblioteca,
                  deberas de llenar todos los campos para poder registrar el libro
                </div>
              </div>
            </div>

            <div class="container-fluid">
                  <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Nuevo libro</div>
                      <form action="/libros" method="POST" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-sm" style="margin-left: 30px; margin-right: 30px;">
                            <legend><strong>Información básica</strong></legend>
                          </div>
                        </div>
                      <br />
  
                      <div class="row">
                        <div class="col-xs col-sm-offset-1" style="margin-left: 30px; margin-right: 30px;">
                          <div class="group-material">
                            <input
                              type="text"
                              name="titulo"
                              class="tooltips-general material-control"
                              placeholder="Escribe aquí el título o nombre del libro"
                              required=""
                              maxlength="255"
                              data-toggle="tooltip"
                              data-placement="top"
                              title="Escribe el título o nombre del libro"
                            />
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Título</label>
                          </div>
                        </div>
                      </div>
  
                      <div class="row">
  
                        <div class="col-xs-5 col-sm-offset-1">
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
                              title="Elige el (los) autor(es) del libro"
                              
                            >
                            @foreach($autores as $autor)
                              <option value="{{ $autor->id }}">{{ $autor->nombre }}</option>
                            @endforeach
                            </select>
        
                          </div>
                        </div>
  
                        <div class="col-xs-5">
                          <div class="group-material">
                            <span>Carrera</span>
                            <select
                              class="tooltips-general material-control"
                              id="carrera_id"
                              name="carrera_id"
                              data-toggle="tooltip"
                              data-placement="top"
                              title="Seleccione la carrera asociada al libro"
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
                        <div class="col-xs-5">
                          <div class="group-material">
                            <span>Asignatura</span>
                            <select
                              class="tooltips-general material-control"
                              id="asignatura_id"
                              name="asignatura_id"
                              data-toggle="tooltip"
                              data-placement="top"
                              title="Seleccione la asignatura asociada al libro"
                            >
                              <option value="" disabled="" selected="">
                                Seleccionar asignatura
                              </option>
                            </select>
                            @error('asignatura_id')
                              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                          </div>
                        </div>
                      </div>
  
                        <div class="row">
                          <div class="col-xs col-sm-offset-1" style="margin-left: 30px; margin-right: 30px;">
                            <legend><strong>Otros datos</strong></legend>
                          </div>
                        </div>
                            <br />
  
                          <div class="row">
                              <div class="col-xs-5 col-sm-offset-1">
                                  <div class="group-material">
                                    <input
                                      type="text"
                                      name="anio"
                                      class="material-control tooltips-general"
                                      placeholder="Escriba aquí el año del libro"
                                      required=""
                                      pattern="[0-9]{1,4}"
                                      maxlength="4"
                                      data-toggle="tooltip"
                                      data-placement="top"
                                      title="Solamente números, sin espacios"
                                    />
                                    @error('anio')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Año</label>
                                  </div>
                              </div>
  
                              <div class="col-xs-5">
                                  <div class="group-material">
                                    <input
                                      type="text"
                                      name="dewey"
                                      class="tooltips-general material-control"
                                      placeholder="Escribe aquí el número de la clasificación decimal Dewey del libro"
                                      required=""
                                      maxlength="10"
                                      pattern="^\d+(?:\.\d+)?$"
                                      data-toggle="tooltip"
                                      data-placement="top"
                                      title="Escribe aquí el número de la clasificación decimal Dewey del libro"
                                    />
                                    @error('dewey')
                                     <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                    @enderror
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Número Dewey</label>
                                  </div>
                              </div>
                              
                              <div class="col-xs-5 col-sm-offset-1">
                                <div class="group-material">
                                  <input
                                    type="text"
                                    name="ISBN"
                                    class="tooltips-general material-control"
                                    placeholder="Escribe aquí el ISBN del libro"
                                    required=""
                                    pattern="^(?:\d{9}[\dX]|\d{13})$"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Escribe el ISBN del libro"
                                  />
                                  @error('ISBN')
                                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                  @enderror
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>ISBN</label>
                                </div>
                              </div>
                              
                              <div class="col-xs-5">
                                <div class="group-material">
                                  <input
                                    type="text"
                                    name="ejemplares"
                                    class="material-control tooltips-general"
                                    placeholder="Escribe aquí la cantidad de libros que registraras"
                                    required=" "
                                    pattern="[0-9]{1,7}"
                                    maxlength="7"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="¿Cuántos libros registrarás?"
                                  />
                                  @error('ejemplares')
                                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                  @enderror
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Ejemplares</label>
                                </div>
                              </div>
                              
                              <div class="col-xs-5 col-sm-offset-1">
                                <div class="group-material">
                                  <input
                                    type="text"
                                    name="edicion"
                                    class="tooltips-general material-control"
                                    placeholder="Escribe aquí la edición del libro"
                                    required=""
                                    pattern="[0-9]{1,4}"
                                    maxlength="4"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Escribe la edición del libro"
                                  />
                                  @error('edicion')
                                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                  @enderror
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Edición</label>
                                </div>
                              </div>
                              
                              <div class="col-xs-5 ">
                                <div class="group-material">
                                  <select
                                    class="tooltips-general material-control"
                                    name="editorial_id"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Seleccione la editorial del libro"
                                  >
                                    <option value="" disabled="" selected="">
                                      Seleccionar editorial
                                    </option>
                                    @foreach($editoriales as $editorial)
                                      <option value="{{ $editorial->id }}">{{ $editorial->nombre }}</option>
                                    @endforeach
                                  </select>
                                  @error('editorial')
                                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                  @enderror
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label style="top: -20px">Editorial</label>
                                </div>
                              </div>
                              
                              <div class="col-xs-5 col-sm-offset-1">
                                <div class="group-material">
                                  <select
                                    class="tooltips-general material-control"
                                    name="estado"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Elige el estado del libro"
                                  >
                                    <option value="" disabled="" selected="">
                                      Selecciona el estado del libro
                                    </option>
                                    <option value="Bueno">Bueno</option>
                                    <option value="Deteriorado">Deteriorado</option>
                                  </select>
                                  @error('estado')
                                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                  @enderror
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label style="top: -20px">Estado</label>
                                </div>
                              </div>
  
                              <div class="col-xs-5">
                                <div class="group-material">
                                  <input class="tooltips-general material-control" 
                                    type="file" 
                                    name="archivo" 
                                    id="archivo"
                                    title="Seleccione el archivo que contiene el Libro"
                                  >
                                  @error('archivo')
                                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                  @enderror
                                  <span class="highlight"></span>
                                  <span class="bar"></span>
                                  <label>Cargar libro</label>
                                </div>
                              </div>

                              @if ($errors->any())
                                  @foreach ($errors->all() as $error)
                                      <div>{{$error}}</div>
                                  @endforeach
                              @endif
                                
                              <div class="col-xs-10">
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
            
            <x-dialog-ayuda-sistema/>

            <x-footer/>    
    </div>
</body>
@endsection

@section('js')
  <script type="text/javascript">
    $('#carrera_id').on('click', function () {
      let id = $(this).val();

      if(id === null) {
        return false;
      }

      $.get('/get-asignaturas/'+id, function(data, status){
        $('#asignatura_id').html('<option value="">Seleccionar asignatura</option>'+data.data);
      });
    });
  </script>
@endsection
