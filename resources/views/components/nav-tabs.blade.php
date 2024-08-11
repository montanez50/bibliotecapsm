@props(['activeTab'])
<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
        <li role="presentation" class ="{{ $activeTab == 'admin' ? 'active' : '' }}">
            <a href="usuarios/registrar_admin">Administradores</a></li>
        <li role="presentation" class="{{ $activeTab == 'docente' ? 'active' : '' }}">
            <a href="usuarios/registrar_docente">Docentes</a></li>
        <li role="presentation" class="{{ $activeTab == 'estudiante' ? 'active' : '' }}">
            <a href="usuarios/registrar_estudiante">Estudiantes</a></li>
        <li role="presentation" class="{{ $activeTab == 'persAdmin' ? 'active' : '' }}">
            <a href="usuarios/registrar_personal">Personal administrativo</a></li>
    </ul>
</div>

{{-- /* Supongamos que en tu controlador tienes una variable $activeTab que determina qué pestaña debe estar activa:

php
Copy code
public function index()
{
    $activeTab = 'home'; // Otra posibilidad: $activeTab = 'admin';
    return view('tusVistas.index', compact('activeTab'));

En tu vista index.blade.php, puedes usar esta variable para determinar qué clase agregar al elemento li correspondiente:

html
Copy code
<ul>
    <li class="{{ $activeTab == 'home' ? 'active' : '' }}"><a href="#">Inicio</a></li>
    <li class="{{ $activeTab == 'admin' ? 'active' : '' }}"><a href="#">Administración</a></li>
    <!-- Otros elementos li -->
</ul>
En este ejemplo, la clase 'active' se agregará dinámicamente al elemento li correspondiente si la variable $activeTab coincide con el nombre de la pestaña. De lo contrario, no se agregará ninguna clase adicional.

De esta manera, puedes controlar dinámicamente las clases de los elementos li en tu HTML según la lógica de tu aplicación en Laravel. */ --}}


{{-- Para quitar un hipervínculo de un elemento li que tenga la clase "active" puedes utilizar lógica condicional en tu plantilla Blade para determinar si se debe mostrar el hipervínculo o no. Aquí te muestro cómo hacerlo:

Supongamos que tienes una lista de elementos li en tu plantilla Blade y quieres quitar el hipervínculo de los elementos que tienen la clase "active". Puedes hacerlo así:

html
Copy code
<ul>
    <li class="{{ $activeTab == 'home' ? 'active' : '' }}">
        @if ($activeTab != 'home')
            <a href="#">Inicio</a>
        @else
            Inicio
        @endif
    </li>
    <li class="{{ $activeTab == 'admin' ? 'active' : '' }}">
        @if ($activeTab != 'admin')
            <a href="#">Administración</a>
        @else
            Administración
        @endif
    </li>
    <!-- Otros elementos li -->
</ul>
En este ejemplo, estamos usando la variable $activeTab para determinar qué elemento li debe tener la clase "active". Si el elemento li tiene la clase "active", no se mostrará el hipervínculo, de lo contrario se mostrará. --}}