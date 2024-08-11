@props(['activeTab'])
<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
        <li role="presentation" class ="{{ $activeTab == 'libro' ? 'active' : '' }}">
            <a href="/libros">Libros</a></li>
        <li role="presentation" class="{{ $activeTab == 'tdg' ? 'active' : '' }}">
            <a href="/tdg">Trabajos de Grado</a></li>
        <li role="presentation" class="{{ $activeTab == 'proyecto' ? 'active' : '' }}">
            <a href="/proyectos">Proyectos Comunitarios</a></li>
        <li role="presentation" class="{{ $activeTab == 'video' ? 'active' : '' }}">
            <a href="/videos">Videos</a></li>
        <li role="presentation" class="{{ $activeTab == 'guia' ? 'active' : '' }}">
            <a href="/guias">Guías Académicas</a></li>
    </ul>
</div>