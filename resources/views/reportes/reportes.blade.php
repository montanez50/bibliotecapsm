@extends('layout')
<head>
    <title>
        Reportes y Estadísticas
    </title>
</head>
@section('content')
    
    <x-side-nav-bar/>

    <div class="content-page-container full-reset custom-scroll-containers">
        
        <x-top-user-nav-bar/>

        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Biblioteca Digital "Santiago Mariño" <small>Reportes y estadísticas</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#statistics" aria-controls="statistics" role="tab" data-toggle="tab">Estadísticas</a></li>
                <li role="presentation"><a href="#reports" aria-controls="reports" role="tab" data-toggle="tab">Reportes</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="statistics">
                    <div class="container-fluid"  style="margin: 50px 0;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <img src="assets/img/chart.png" alt="chart" class="img-responsive center-box" style="max-width: 120px;">
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                                Bienvenido al área de estadísticas, aquí puedes ver las diferentes 
                                estadísticas de los usuarios y publicaciones.
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="page-header">
                          <h2 class="all-tittles">Consultas <small>en general</small></h2>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="text-center all-tittles">total consultas del mes</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover text-center">
                                        <thead>
                                            <tr class="success">
                                                <th class="text-center">Tipo usuario</th>
                                                <th class="text-center">N. de visualizaciones</th>
                                                <th class="text-center">Porcentaje</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($visualizacionesPorRol as $rol => $datos)
                                                <tr>
                                                    <td>{{ $rol }}</td>
                                                    <td>{{ $datos['total'] }}</td>
                                                    <td>{{ number_format($datos['porcentaje'], 2) }}%</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="info">
                                                <th class="text-center">Total</th>
                                                <th class="text-center">{{ $totalVisualizaciones }}</th>
                                                <th class="text-center">{{$totalVisualizaciones != 0 ? number_format(($visualizacionesPorRol->sum('total')/$totalVisualizaciones)*100, 2) : 0}}%</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <p class="lead text-center"><strong><i class="zmdi zmdi-info-outline"></i>&nbsp; ¡Importante!</strong> Para imprimir esta tabla ve a la sección de reportes y selecciona alguno de los listados</p>
                            </div>
                        </div>

                        <div class="page-header">
                          <h2 class="all-tittles">libros <small>por asignaturas</small></h2>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="text-center all-tittles">libros por asignatura</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover text-center">
                                        <thead>
                                            <tr class="success">
                                                <th class="text-center">Asignatura</th>
                                                <th class="text-center">Total libros</th>
                                                <th class="text-center">Porcentaje</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($libros as $data)
                                            <tr>
                                                <td>{{$data->nombre}}</td>
                                                <td>{{$data->total}}</td>
                                                <td>{{$librosTotal != 0 ? ($data->total/$librosTotal)*100 : 0}}%</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="info">
                                                <th class="text-center">Total libros</th>
                                                <th class="text-center">{{$libros->sum('total')}}</th>
                                                <th class="text-center">{{$librosTotal != 0 ? ($libros->sum('total')/$librosTotal)*100 : 0}}%</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <p class="lead text-center"><strong><i class="zmdi zmdi-info-outline"></i>&nbsp; ¡Importante!</strong> Para imprimir esta tabla ve a la sección de reportes y selecciona “Reporte Libros por Asignatura”</p>
                            </div>
                        </div>

                        <div class="page-header">
                            <h2 class="all-tittles">videos <small>por asignaturas</small></h2>
                          </div>
                          <div class="row">
                              <div class="col-xs-12">
                                  <h3 class="text-center all-tittles">videos por asignaturas</h3>
                                  <div class="table-responsive">
                                      <table class="table table-hover text-center">
                                          <thead>
                                              <tr class="success">
                                                  <th class="text-center">Asignatura</th>
                                                  <th class="text-center">Total videos</th>
                                                  <th class="text-center">Porcentaje</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                                @foreach ($videos as $data)
                                                <tr>
                                                    <td>{{$data->nombre}}</td>
                                                    <td>{{$data->total}}</td>
                                                    <td>{{$videosTotal != 0 ? ($data->total/$videosTotal)*100 : 0}}%</td>
                                                </tr>
                                                @endforeach
                                          </tbody>
                                          <tfoot>
                                              <tr class="info">
                                                  <th class="text-center">Total videos</th>
                                                  <th class="text-center">{{$videos->sum('total')}}</th>
                                                  <th class="text-center">{{$videosTotal != 0 ? ($videos->sum('total')/$videosTotal)*100 : 0}}%</th>
                                              </tr>
                                          </tfoot>
                                      </table>
                                  </div>
                                  <p class="lead text-center"><strong><i class="zmdi zmdi-info-outline"></i>&nbsp; ¡Importante!</strong> Para imprimir esta tabla ve a la sección de reportes y selecciona “Reporte Videos por Asignatura”</p>
                              </div>
                          </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="reports">
                    <div class="container-fluid"  style="margin: 50px 0;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <img src="assets/img/pdf.png" alt="pdf" class="img-responsive center-box" style="max-width: 120px;">
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                                Bienvenido al área de reportes, aquí puedes generar listados de los usuarios 
                                estudiantes, docentes o personal en formato pdf, también puedes generar 
                                reportes de consulta.
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="page-header">
                              <h2 class="all-tittles">Listados <small>generales</small></h2>
                            </div><br>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <a href="{{ route('reportes.pdf.estudiantes') }}">
                                            <i class="zmdi zmdi-file-text zmdi-hc-5x"></i>
                                        </a>
                                    </p>
                                    <h3 class="text-center">Listado de estudiantes</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <a href="{{ route('reportes.pdf.docentes') }}">
                                            <i class="zmdi zmdi-file-text zmdi-hc-5x"></i>
                                        </a>
                                    </p>
                                    <h3 class="text-center">Listado de docentes</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <a href="{{ route('reportes.pdf.personal') }}">
                                            <i class="zmdi zmdi-file-text zmdi-hc-5x"></i>
                                        </a>
                                    </p>
                                    <h3 class="text-center">Listado de personal administrativo</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="page-header">
                              <h2 class="all-tittles">reportes <small>generales</small></h2>
                            </div><br>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <a href="{{ route('reportes.pdf.visualizacionesMensuales') }}">
                                            <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                                        </a>
                                    </p>
                                    <h3 class="text-center">Reporte General de consultas</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <a href="{{ route('reportes.pdf.librosPorAsignatura') }}">
                                            <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                                        </a>
                                    </p>
                                     
                                    <h3 class="text-center">Reporte Libros por asignatura</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <a href="{{ route('reportes.pdf.videosPorAsignatura') }}">
                                            <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                                        </a>
                                    </p>
                                    <h3 class="text-center">Reporte Videos por asignatura</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <a data-toggle="modal" data-target="#fechaModal">
                                            <i class="zmdi zmdi-trending-up zmdi-hc-5x"></i>
                                        </a>
                                    </p>
                                    <h3 class="text-center">Consulta de recurso (especificar recurso e intervalo de fechas)</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="fechaModal" tabindex="-1" role="dialog" aria-labelledby="fechaModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="fechaModalLabel">Seleccionar Rango de Fechas y Recurso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('reportes.pdf.visualizacionesPorFechas') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de Inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_fin">Fecha de Fin</label>
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                                </div>
                                <div class="form-group">
                                    <label for="recurso">Tipo de recurso</label>
                                    <select class="form-control" id="tipo_recurso" name="tipo_recurso">
            
                                            <option value="1">Libros</option>
                                            <option value="2">Trabajos de Grado</option>
                                            <option value="3">Proyectos Comunitarios</option>
                                            <option value="4">Videos</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="recurso">Seleccionar Título</label>
                                    <select class="form-control" id="recurso" name="recurso">
                                        <!-- Suponiendo que tienes una tabla de recursos -->
                                        {{-- @foreach($recursos as $recurso)
                                            <option value="{{ $recurso->id }}">{{ $recurso->nombre }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Consultar Reporte</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @section('js')
                <script type="text/javascript">

                    $('#tipo_recurso').on('click', function () {
                        let id = $(this).val();

                        if(id === null) {
                            return false;
                        }

                        $.get('/get-publicaciones/'+id, function(data, status){
                            $('#recurso').html('<option value="">Seleccionar Título</option>'+data.data);
                        });
                        });


                    // document.getElementById('tipo_recurso').addEventListener('change', function(){
                    //     var typeId = this.value;

                    // });
                        
                </script>
            @endsection
        </div>

    </div>

@endsection