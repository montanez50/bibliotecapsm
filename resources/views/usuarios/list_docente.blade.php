@extends('layout')

<head>
    <title>
        Docentes
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
                  src="assets/img/user02.png"
                  alt="user"
                  class="img-responsive center-box"
                  style="max-width: 110px"
                />
              </div>
              <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                Bienvenido a la sección donde se encuentra el listado de docentes
                registrados en el sistema, puedes actualizar algunos datos de los
                docentes o eliminar el registro completo del docente siempre y
                cuando no tenga préstamos asociados.<br />
                <strong class="text-danger"
                  ><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Importante! </strong
                >Si eliminas el docente del sistema se borrarán todos los datos
                relacionados con él, incluyendo préstamos y registros en la
                bitácora.
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-12 lead">
                <ol class="breadcrumb">
                  <li><a href="/reg-docente">Nuevo docente</a></li>
                  <li class="active">listado de docentes</li>
                </ol>
              </div>
            </div>
          </div>
          <div class="container-fluid">
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
                  placeholder="Buscar docente"
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
            <h2 class="text-center all-tittles" style="clear: both; margin: 25px 0">
              Listado de docentes
            </h2>
            <div class="table-responsive">
              <div class="div-table" style="margin: 0 !important">
                <div
                  class="div-table-row div-table-row-list"
                  style="background-color: #dff0d8; font-weight: bold"
                >
                  <div class="div-table-cell" style="width: 15%">#</div>
                  <div class="div-table-cell" style="width: 15%">Nombres</div>
                  <div class="div-table-cell" style="width: 15%">Apellidos</div>
                  <div class="div-table-cell" style="width: 15%">Especialidad</div>
                  <div class="div-table-cell" style="width: 9%">Actualizar</div>
                  <div class="div-table-cell" style="width: 9%">Eliminar</div>
                </div>
              </div>
              <div class="table-responsive">
                <div class="div-table" style="margin: 0 !important">
                  @foreach ($docentes as $docente)
                  <div class="div-table-row div-table-row-list">
                    <div class="div-table-cell" style="width: 15%">{{$docente->ci_docente}}</div>
                    <div class="div-table-cell" style="width: 15%">{{$docente->nombre_docente}}</div>
                    <div class="div-table-cell" style="width: 15%">{{$docente->apellido_docente}}</div>
                    <div class="div-table-cell" style="width: 15%">{{$docente->especialidad}}</div>
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
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <x-dialog-ayuda-sistema/>

          <x-footer/>
    </div>
@endsection