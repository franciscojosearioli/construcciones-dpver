<li>
    <a class="menu-item">
        <i class="fas fa-bell  "></i> <span class="hide-menu   pl-2">Informacion general</span>
    </a>
    <ul class="collapse">
<li><a class="menu-subitem waves-effect waves-dark" href="estadisticas" aria-expanded="false" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen">Estadisticas</a></li>
<li><a class="menu-subitem waves-effect waves-dark" href="mapa" aria-expanded="false" id="log-menu" onClick="save_log()" data-log-user="Click menu: Mapa">Obras y Proyectos</a></li>
<li><a class="menu-subitem waves-effect waves-dark" href="biblioteca" aria-expanded="false" id="log-menu" onClick="save_log()" data-log-user="Click menu: Mapa">Archivos de obras</a></li>
    </ul>
</li>
<li>
    <a class="menu-item">
        <i class="fas fa-calendar-alt  "></i> <span class="hide-menu   pl-2">Area administrativa</span>
    </a>
    <ul class="collapse">
<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Mesa de entrada</a>
    <ul aria-expanded="false" class="collapse">
        <!--<li><a href="#" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Documentos</a></li>-->
        <li><a href="notas" id="log-menu" onClick="save_log()" data-log-user="Click menu: Notas"><i class="mdi mdi-chevron-right"></i> Presentaciones</a></li>
        <li><a href="expedientes" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Expedientes</a></li>
    </ul>
    </li>
        <?php if(!permiso('inspeccion')){ ?>
            <li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Recursos humanos</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="agentes" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Personal</a></li>
    </ul>
    </li>   
<!--<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Documentacion de obras</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="contratos" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Contratos</a></li>
        <li><a href="#" id="log-menu" onClick="save_log()" data-log-user="Click menu: Notas"><i class="mdi mdi-chevron-right"></i> Resoluciones</a></li>
        <li><a href="#" id="log-menu" onClick="save_log()" data-log-user="Click menu: Notas"><i class="mdi mdi-chevron-right"></i> Actas</a></li>
    </ul>
    </li> -->
     


            <!--<li>
    <a class="menu-subitem waves-effect waves-dark" href="asistencias" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Asistencias">Asistencias (Test)</a>
</li>-->

<?php } ?>
</ul>
</li> 
<li>
    <a class="menu-item">
        <i class="fas fa-folder  "></i> <span class="hide-menu   pl-2">Area Obras y Proyectos</span>
    </a>
    <ul class="collapse">

<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Proyectos de obras</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="relevamientos" id="log-menu" onClick="save_log()" data-log-user="Click menu: Relevamientos"><i class="mdi mdi-chevron-right"></i> Relevamientos</a></li>
        <li><a href="proyectos" id="log-menu" onClick="save_log()"  data-log-user="Click menu: Proyectos en tramite"><i class="mdi mdi-chevron-right"></i> Proyectos</a></li>

    </ul>
    </li>
</li>
<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Obras por contrato</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="obras" id="log-menu" onClick="save_log()" data-log-user="Click menu: Obras"><i class="mdi mdi-chevron-right"></i> Obras contratadas</a></li>
        <li><a href="modificaciones" id="log-menu" onClick="save_log()"  data-log-user="Click menu: Modificaciones de obra"><i class="mdi mdi-chevron-right"></i> Modificaciones de obras</a></li>
        <li><a href="ampliaciones" id="log-menu" onClick="save_log()"  data-log-user="Click menu: Ampliaciones de plazo"><i class="mdi mdi-chevron-right"></i> Ampliaciones de plazos</a></li>
        <li><a href="neutralizaciones" id="log-menu" onClick="save_log()"  data-log-user="Click menu: Neutralizaciones de obra"><i class="mdi mdi-chevron-right"></i> Neutralizaciones de obras</a></li>
        
        <li><a href="recepciones-provisorias" id="log-menu" onClick="save_log()" data-log-user="Click menu: Recepciones provisorias"><i class="mdi mdi-chevron-right"></i> Recepciones Provisorias</a></li>
        <li><a href="recepciones-definitivas" id="log-menu" onClick="save_log()" data-log-user="Click menu: Recepciones definitivas"><i class="mdi mdi-chevron-right"></i> Recepciones Definitivas</a></li>
     
    </ul>
    </li>
</li>
<li><a class="menu-subitem waves-effect waves-dark" href="empresas" aria-expanded="false" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"> Contratistas</a></li>
<li><a class="menu-subitem waves-effect waves-dark" href="equipos" aria-expanded="false" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"> Movilidades</a></li>

    </ul>
</li>



<li>
    <a class="menu-item" >
        <i class="fas fa-file  "></i> <span class="hide-menu   pl-2">Area de certificacion</span>
    </a>
    <ul class="collapse">
     <li><a class="menu-subitem waves-effect waves-dark" href="informes-inspeccion" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">Informes de inspeccion</a></li>        
     <li><a class="menu-subitem waves-effect waves-dark" href="certificados" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">Certificados de obras</a></li>      
     <li><a class="menu-subitem waves-effect waves-dark" href="certificados-redeterminados" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">Certificados redeterminados</a></li>
  <!--<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Redeterminaciones de precios</a>
    <ul aria-expanded="false" class="collapse">

      <li><a href="precios-items" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Indices provisorios</a></li>
       
    </ul>
    </li>--> 
<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Certificaciones</a>
    <ul aria-expanded="false" class="collapse">
        <!--<li><a href="precios-items" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Indices de precios</a></li>-->
        <li><a href="certificados-descuentos" id="log-menu" onClick="save_log()" data-log-user="Click menu: Notas"><i class="mdi mdi-chevron-right"></i> Descuentos de certificados</a></li>
        <li><a href="redeterminaciones-actas" id="log-menu" onClick="save_log()" data-log-user="Click menu: Certificados redeterminados"><i class="mdi mdi-chevron-right"></i> Actas de redeterminaciones</a></li>
    </ul>
</li>    
<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Costos</a>
    <ul aria-expanded="false" class="collapse">
        <!--<li><a href="precios-items" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Indices de precios</a></li>-->
        <li><a href="certificados-unidades" id="log-menu" onClick="save_log()" data-log-user="Click menu: Relevamientos"><i class="mdi mdi-chevron-right"></i> Unidades de items</a></li>
    </ul>
</li>    
</ul>
</li> 


<li>
    <a class="menu-item" >
        <i class="fas fa-file  "></i> <span class="hide-menu   pl-2">Institucional</span>
    </a>
    <ul class="collapse">
     <li><a class="menu-subitem waves-effect waves-dark" href="http://10.100.32.8/" target="_blank" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">Correo</a></li>        
     <li><a class="menu-subitem waves-effect waves-dark" href="http://dpver.ddns.info:8080/saer/web/login" target="_blank" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">S.A.E.R.</a></li>        
     <li><a class="menu-subitem waves-effect waves-dark" href="ayuda" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">Tutoriales</a></li>        
</ul>
</li> 
