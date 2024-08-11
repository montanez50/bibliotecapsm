@extends('layout')

<head>
    <title>
        Estudiantes
    </title>
</head>
@section('content')
    
    <x-side-nav-bar/>

    <div class="content-page-container full-reset custom-scroll-containers">
        
        <x-top-user-nav-bar/>

        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">
                Biblioteca Digital "Santiago Mariño"  <small>Administración Usuarios</small>
              </h1>
            </div>
        </div>
        
      <x-nav-tabs :activeTab='$activeTab'/>

        <div class="container-fluid" style="margin: 50px 0">
            <div class="row">
              <div class="col-xs-12 col-sm-4 col-md-3">
                <img
                  src="assets/img/user03.png"
                  alt="user"
                  class="img-responsive center-box"
                  style="max-width: 110px"
                />
              </div>
              <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                Bienvenido a la sección donde se encuentra el listado de estudiantes
                de la institución, podrás buscar los estudiantes por sección o
                nombre. Puedes actualizar o eliminar los datos del estudiante.<br />
                <strong class="text-danger"
                  ><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Importante! </strong
                >Si eliminas el estudiante del sistema se borrarán todos los datos
                relacionados con él, incluyendo préstamos y registros en la
                bitácora.
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-12 lead">
                <ol class="breadcrumb">
                  <li><a href="/reg-estudiante">Nuevo estudiante</a></li>
                  <li class="active">Listado de estudiantes</li>
                </ol>
              </div>
            </div>
          </div>
          <div class="container-fluid" style="margin: 0 0 50px 0">
            <form
              class="pull-right"
              style="width: 30% !important"
              autocomplete="off"
            >
              <div class="group-material">
                <input
                  type="search"
                  style="display: inline-block !important; width: 70%"
                  class="material-control tooltips-general"
                  placeholder="Buscar estudiante"
                  required=""
                  pattern="[a-zA-ZáéíóúÁÉÍÓÚ ]{1,50}"
                  maxlength="50"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Escribe los nombres, sin los apellidos"
                />
                <button
                  class="btn"
                  style="
                    margin: 0;
                    height: 43px;
                    background-color: transparent !important;
                  "
                >
                  <i class="zmdi zmdi-search" style="font-size: 25px"></i>
                </button>
              </div>
            </form>
            <h2 class="text-center all-tittles" style="margin: 25px 0; clear: both">
              Especialidades
            </h2>
            <ul class="list-unstyled text-center list-catalog-container">
              <li class="list-catalog">Arquitectura</li>
              <li class="list-catalog">Civil</li>
              <li class="list-catalog">Eléctrica</li>
              <li class="list-catalog">Electrónica</li>
              <li class="list-catalog">Mecánica</li>
              <li class="list-catalog">Mto. Mecánico</li>
              <li class="list-catalog">Sistemas</li>
            </ul>
          </div>
          <div class="container-fluid">
            <h2 class="text-center all-tittles">listado de estudiantes</h2>
            <div class="table-responsive">
              <div class="div-table" style="margin: 0 !important">
                <div
                  class="div-table-row div-table-row-list"
                  style="background-color: #dff0d8; font-weight: bold"
                >
                  <div class="div-table-cell" style="width: 6%">#</div>
                  <div class="div-table-cell" style="width: 18%">Nombres</div>
                  <div class="div-table-cell" style="width: 18%">Apellidos</div>
                  <div class="div-table-cell" style="width: 18%">Especialidad</div>
                  <div class="div-table-cell" style="width: 9%">Actualizar</div>
                  <div class="div-table-cell" style="width: 9%">Eliminar</div>
                </div>
              </div>
            </div>

            @foreach ($estudiantes as $estudiante)
            <div class="table-responsive">
              <div class="div-table" style="margin: 0 !important">
                <div class="div-table-row div-table-row-list">
                  <div class="div-table-cell" style="width: 6%">{{$estudiante->ci_estudiante}}</div>
                  <div class="div-table-cell" style="width: 18%">{{$estudiante->nombre_estudiante}}</div>
                  <div class="div-table-cell" style="width: 18%">{{$estudiante->apellido_estudiante}}</div>
                  <div class="div-table-cell" style="width: 18%">{{$estudiante->especialidad}}</div>
                  <div class="div-table-cell" style="width: 9%">
                    <button class="btn btn-success">
                      <i class="zmdi zmdi-refresh"></i>
                    </button>
                  </div>
                  <div class="div-table-cell" style="width: 9%">
                    <button class="btn btn-danger">
                      <i class="zmdi zmdi-delete"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach

          </div>

        <x-dialog-ayuda-sistema/>
        
        <x-footer/>    
    </div>
@endsection