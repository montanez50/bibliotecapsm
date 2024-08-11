@extends('layout')

<head>
    <title>
        Personal administrativo
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
                  src="assets/img/user05.png"
                  alt="user"
                  class="img-responsive center-box"
                  style="max-width: 110px"
                />
              </div>
              <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                Bienvenido a la sección donde se encuentra el listado del personal
                administrativo registrado en el sistema, puedes actualizar algunos
                datos o eliminar el registro completo del personal administrativo
                siempre y cuando no tenga préstamos pendientes.<br />
                <strong class="text-danger"
                  ><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Importante! </strong
                >Si eliminas el personal administrativo del sistema se borrarán
                todos los datos relacionados con él, incluyendo préstamos y
                registros en la bitácora.
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-12 lead">
                <ol class="breadcrumb">
                  <li><a href="/reg-pers-admin">Nuevo personal ad.</a></li>
                  <li class="active">Listado de personal ad.</li>
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
                  placeholder="Buscar personal"
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
              listado de personal administrativo
            </h2>
            <div class="table-responsive">
              <div class="div-table" style="margin: 0 !important">
                <div
                  class="div-table-row div-table-row-list"
                  style="background-color: #dff0d8; font-weight: bold"
                >
                  <div class="div-table-cell" style="width: 6%">#</div>
                  <div class="div-table-cell" style="width: 15%">Nombres</div>
                  <div class="div-table-cell" style="width: 15%">Apellidos</div>
                  <div class="div-table-cell" style="width: 9%">Actualizar</div>
                  <div class="div-table-cell" style="width: 9%">Eliminar</div>
                </div>
              </div>

              @foreach ($persAdmins as $persAdmin)
              <div class="table-responsive">
                <div class="div-table" style="margin: 0 !important">
                  <div class="div-table-row div-table-row-list">
                    <div class="div-table-cell" style="width: 6%">{{$persAdmin['ci_pers-admin']}}</div>
                    <div class="div-table-cell" style="width: 15%">{{$persAdmin['nombre_pers-admin']}}</div>
                    <div class="div-table-cell" style="width: 15%">{{$persAdmin['apellido_pers-admin']}}</div>
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
          </div>

          <x-dialog-ayuda-sistema/>

          <x-footer/>  
    </div>
@endsection