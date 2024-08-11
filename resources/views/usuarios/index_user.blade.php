@extends('layout')
<head>
    <title>Gestionar Usuarios</title>
</head>
@section('content')

<x-side-nav-bar />

<div class="content-page-container full-reset custom-scroll-containers">
    <x-top-user-nav-bar />

    <div class="container">
        <div class="page-header">
            <h1 class="all-tittles">
                Biblioteca Digital "Santiago Mariño" <small>Administración Usuarios</small>
            </h1>
        </div>
    </div>

    <div class="container-fluid" style="margin: 50px 0">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                <img
                    src="{{asset('assets/img/user01.png')}}"
                    alt="user"
                    class="img-responsive center-box"
                    style="max-width: 110px"
                />
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                Bienvenido a la sección donde se encuentra el listado de los
                administradores, puedes desactivar la cuenta de cualquier
                administrador o eliminar los datos si no hay préstamos asociados
                a la cuenta
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 lead">
                <ol class="breadcrumb">
                    <li><a href="/usuarios/registrar">Nuevo usuario</a></li>
                    <li class="active">listado de usuarios</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h2 class="text-center all-tittles">Lista de usuarios</h2>
        <table class="div-table data-table">
            <thead>
                <tr class="div-table-row div-table-head ">
                    <th class="div-table-cell ">#</th>
                    <th class="div-table-cell">Nombres</th>
                    <th class="div-table-cell">Tipo de usuario</th>
                    <th class="div-table-cell">Email</th>
                    <th class="div-table-cell">Actualizar</th>
                    <th class="div-table-cell">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="div-table-row">
                                        
                        <td class="div-table-cell">{{$user->cedula}}</td>
                        <td class="div-table-cell">{{$user->nombres}}</td>
                        <td class="div-table-cell">
                            @foreach ($user->roles as $rol)
                                {{$rol->name}}
                            @endforeach
                        </td>
                        <td class="div-table-cell">{{$user->correo}}</td>
                        <td class="div-table-cell">
                            <a href="usuarios/{{$user->id}}/edit" class="btn btn-success">
                                <i style="color: white" class="zmdi zmdi-refresh"></i>
                            </a>
                        </td>
                        <td class="div-table-cell">
                            <form id="/usuarios/{{$user->id}}" action="{{route('user.destroy', ['usuario' => $user])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger delete-user-button" 
                                style="margin-top: 10px"
                                data-id="{{$user->id}}"
                                >
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-dialog-ayuda-sistema />

    <x-footer />
</div>

@endsection
