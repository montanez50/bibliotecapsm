@extends('layout')
<head>
    <title>Configuraciones Avanzadas</title>
</head>
@section('content')
    <x-side-nav-bar/>
    
    <div class="content-page-container full-reset custom-scroll-containers">
        
        <x-top-user-nav-bar/>

        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">
                Biblioteca Digital "Santiago Mariño" <small>Configuraciones avanzadas</small>
              </h1>
            </div>
        </div>
        
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="security">
                <div class="container-fluid"  style="margin: 50px 0;">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <p class="text-center text-danger"><i class="zmdi zmdi-shield-security zmdi-hc-5x"></i></p>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                            Puedes realizar copias de seguridad de la base de datos en cualquier momento, también puedes restaurar el sistema a un punto de restauración que hayas creado previamente.
                        </div>
                    </div>
                </div>  
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="report-content">
                                <p class="text-center">
                                    <a href="/backup/create">
                                        <i class="zmdi zmdi-cloud-download zmdi-hc-4x"></i>
                                    </a>
                                </p>
                                <h3 class="text-center all-tittles">realizar copia de seguridad</h3>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="report-content">
                                <p class="text-center">
                                    <a href="/backup/restore/rutadelrespaldo"> {{--PENDIENTE--}}
                                        <i class="zmdi zmdi-cloud-upload zmdi-hc-4x"></i>
                                    </a>
                                </p>
                                <h3 class="text-center all-tittles">restaurar el sistema</h3>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="report-content">
                                <p class="text-center">
                                    <a href="/backup/clean">
                                        <i class="zmdi zmdi-cloud-off zmdi-hc-4x"></i>
                                    </a>
                                </p>
                                <h3 class="text-center all-tittles">borrar copias de seguridad</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <x-dialog-ayuda-sistema/>
        
        <x-footer/>

    </div>
    
@endsection