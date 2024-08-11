@props(['activeTab'])
<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
        <li role="presentation" class ="{{ $activeTab == 'carrera' ? 'active' : '' }}">
            <a href="/carreras">Carreras</a></li>
        <li role="presentation" class="{{ $activeTab == 'linea' ? 'active' : '' }}">
            <a href="/lineas">Líneas de investigación</a></li>
        <li role="presentation" class="{{ $activeTab == 'asignatura' ? 'active' : '' }}">
            <a href="/asignaturas">Asignaturas</a></li>
        <li role="presentation" class="{{ $activeTab == 'autor' ? 'active' : '' }}">
            <a href="/autores">Autores</a></li>
        <li role="presentation" class="{{ $activeTab == 'editorial' ? 'active' : '' }}">
            <a href="/editoriales">Editoriales</a></li>
    </ul>
</div>