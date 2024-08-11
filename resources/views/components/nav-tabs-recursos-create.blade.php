@props(['activeTab'])
<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
        @hasanyrole('Personal Administrativo|Administrador')
        <li role="presentation" class ="{{ $activeTab == 'libro' ? 'active' : '' }}">
            <a href="/libros/create">Libros</a></li>
        <li role="presentation" class="{{ $activeTab == 'tdg' ? 'active' : '' }}">
            <a href="/tdg/create">Trabajos de Grado</a></li>
        <li role="presentation" class="{{ $activeTab == 'proyecto' ? 'active' : '' }}">
            <a href="/proyectos/create">Proyectos Comunitarios</a></li>
        @endhasanyrole
        @hasanyrole('Docente|Administrador')
        <li role="presentation" class="{{ $activeTab == 'video' ? 'active' : '' }}">
            <a href="/videos/create">Videos</a></li>
        <li role="presentation" class="{{ $activeTab == 'guia' ? 'active' : '' }}">
            <a href="/guias/create">Guías Académicas</a></li>
        @endhasanyrole
    </ul>
</div>