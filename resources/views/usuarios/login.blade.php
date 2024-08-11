@extends('layout')
@section('content')
<body class="full-cover-background" style="background-image:url(assets/img/Fondo-login.png);">
    <div class="form-container">
        <p class="text-center" style="margin-top: 17px;">
           <img class="img-responsive center-box"
            style="max-width: 90px"
            src="{{asset('assets/img/logo-iupsm-blanco.png')}}"
           ></img>
       </p>
       <h4 class="text-center all-tittles" style="margin-bottom: 30px;">inicia sesión con tu cuenta</h4>
       @if($errors->any())
        <ul>
          @foreach($errors->all() as $error)
            <li>
              <p style="color: red">{{$error}}</p>
            </li>
          @endforeach
        </ul>
       @endif
       <form action="{{ route('login.post') }}" method="POST" class="form-inline">
          @csrf
          <div class="group-material-login">
            <input type="email" name="correo" class="material-login-control" required="" maxlength="70">
            <span class="highlight-login"></span>
            <span class="bar-login"></span>
            <label><i class="zmdi zmdi-account"></i> &nbsp; Usuario</label>
          </div><br>
          <div class="group-material-login">
            <input type="password" name="password" class="material-login-control" required="" maxlength="70">
            <span class="highlight-login"></span>
            <span class="bar-login"></span>
            <label><i class="zmdi zmdi-lock"></i> &nbsp; Contraseña</label>
          </div>
          <button class="btn-login" type="submit">Ingresar al sistema &nbsp; <i class="zmdi zmdi-arrow-right"></i></button>
        </form>
    </div>
</body>    
@endsection
