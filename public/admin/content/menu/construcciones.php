<!--<li>
    <a class="menu-item">
        <i class="fas fa-bookmark"></i> <span class="hide-menu   pl-2">Resumen general</span>
    </a>
    <ul class="collapse">
<li><a class="menu-subitem waves-effect waves-dark" href="estadisticas" aria-expanded="false" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen">Estadisticas</a></li>
    </ul>
</li>-->
<li>
    <a class="menu-item">
        <i class="fas fa-calendar-alt  "></i> <span class="hide-menu   pl-2">Area Administrativa</span>
    </a>
    <ul class="collapse">

<?php if(permiso('admin') || permiso('tramites')){?>
<li><a class="menu-subitem waves-effect waves-dark" href="mesa-virtual" aria-expanded="false" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"> Mesa virtual</a></li>
<?php } ?>
<li><a class="menu-subitem waves-effect waves-dark" href="armarios" aria-expanded="false" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"> Archivo armarios</a></li>
<?php if(!permiso('observador')){ ?>
<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Agenda</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="agentes" id="log-menu" onClick="save_log()" data-log-user="Click menu: Notas"><i class="mdi mdi-chevron-right"></i> Agentes</a></li>
        <li><a href="empresas" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Empresas</a></li>
        <li><a href="empresas-contactos" id="log-menu" onClick="save_log()" data-log-user="Click menu: Notas"><i class="mdi mdi-chevron-right"></i> Representantes de empresas</a></li>
        <li><a href="equipos" id="log-menu" onClick="save_log()" data-log-user="Click menu: Notas"><i class="mdi mdi-chevron-right"></i> Movilidades</a></li>

</ul>
</li>
<?php } ?>
<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Documentacion</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="tramites" id="log-menu" onClick="save_log()" data-log-user="Click menu: Notas"><i class="mdi mdi-chevron-right"></i> Tramites</a></li>
        <?php if(!permiso('observador')){ ?><li><a href="memorandums" id="log-menu" onClick="save_log()" data-log-user="Click menu: Notas"><i class="mdi mdi-chevron-right"></i> Memorandums</a></li><?php } ?> 
        <!--<li><a href="recepciones-provisorias" id="log-menu" onClick="save_log()" data-log-user="Click menu: Recepciones provisorias"><i class="mdi mdi-chevron-right"></i> Recepciones Provisorias</a></li>
        <li><a href="recepciones-definitivas" id="log-menu" onClick="save_log()" data-log-user="Click menu: Recepciones definitivas"><i class="mdi mdi-chevron-right"></i> Recepciones Definitivas</a></li>-->
    </ul>
    </li>
<?php if(permiso('admin') || permiso('tramites')){?>
    <li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Herramientas administrativas</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="tramites-etiquetas" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Etiquetas de tramites</a></li>
</ul>
</li>
<?php } ?>


</ul>
</li> 
 
<li>
    <a class="menu-item">
        <i class="fas fa-folder  "></i> <span class="hide-menu   pl-2">Area Proyectos</span>
    </a>
    <ul class="collapse">
<li><a class="menu-subitem waves-effect waves-dark" href="relevamientos" aria-expanded="false" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"> Relevamientos de obras</a></li>
<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Proyectos de obras</a>
    <ul aria-expanded="false" class="collapse">
<li><a href="proyectos" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"><i class="mdi mdi-chevron-right"></i> Caminos y Obras de arte</a></li>
    </ul>
</li>
<!--<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Presupuestos</a>
    <ul aria-expanded="false" class="collapse">
<li><a href="#" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"><i class="mdi mdi-chevron-right"></i> Precios</a></li>
<li><a href="#" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"><i class="mdi mdi-chevron-right"></i> Items</a></li>
<li><a href="#" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"><i class="mdi mdi-chevron-right"></i> Materiales</a></li>
<li><a href="#" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"><i class="mdi mdi-chevron-right"></i> Equipos</a></li>
    </ul>
</li>-->
</li>
</li>
    </ul>
</li>
<li>
    <a class="menu-item">
        <i class="fas fa-folder  "></i> <span class="hide-menu   pl-2">Area Obras</span>
    </a>
    <ul class="collapse">
<li><a class="menu-subitem waves-effect waves-dark" href="obras" aria-expanded="false" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"> Informes de obras</a></li>
        <li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Tramites de obras</a>
    <ul aria-expanded="false" class="collapse">
<li><a href="modificaciones" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"><i class="mdi mdi-chevron-right"></i> Modificaciones de obras</a></li>
<li><a href="ampliaciones" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"><i class="mdi mdi-chevron-right"></i> Ampliaciones de plazos</a></li>
<li><a href="neutralizaciones" id="log-menu" onClick="save_log()" data-log-user="Click menu: Resumen"><i class="mdi mdi-chevron-right"></i> Neutralizaciones de obras</a></li>
<li><a href="mod-planesdetrabajo" id="log-menu" onClick="save_log()" data-log-user="Click menu: Recepciones provisorias"><i class="mdi mdi-chevron-right"></i> Modif. planes de trabajo</a></li>
<li><a href="recepciones" id="log-menu" onClick="save_log()" data-log-user="Click menu: Recepciones provisorias"><i class="mdi mdi-chevron-right"></i> Recepciones de obras</a></li>
</ul>
</li>
<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Planillas de obras</a>
    <ul aria-expanded="false" class="collapse">

    <!--<li><a href="certificados-unidades" id="log-menu" onClick="save_log()" data-log-user="Click menu: Relevamientos"><i class="mdi mdi-chevron-right"></i> Unidades de items</a></li>-->
    <li><a href="cotizaciones" id="log-menu" onClick="save_log()" data-log-user="Click menu: Certificados redeterminados"><i class="mdi mdi-chevron-right"></i> Cotizaciones</a></li>
        <li><a href="planes-de-trabajo" id="log-menu" onClick="save_log()" data-log-user="Click menu: Relevamientos"><i class="mdi mdi-chevron-right"></i> Planes de trabajo</a></li>
    </ul>
</li>
<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Seguimiento de obras</a>
    <ul aria-expanded="false" class="collapse">
     <li><a href="curvas-de-inversion" id="log-menu" data-log-user="Click menu: Certificados"><i class="mdi mdi-chevron-right"></i> Curvas de obras</a></li>   
        <li><a href="flujo-obras" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Flujo de obras</a></li>
        <li><a href="biblioteca" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Archivos de obras</a></li>
<li><a href="obras-y-proyectos" id="log-menu" onClick="save_log()" data-log-user="Click menu: Mapa"><i class="mdi mdi-chevron-right"></i> Obras y Proyectos</a></li>
    </ul>
</li>
</li>
    </ul>
</li>



<li>
    <a class="menu-item" >
        <i class="fas fa-file-invoice-dollar"></i> <span class="hide-menu   pl-2">Area Certificaciones</span>
    </a>
    <ul class="collapse">
     <li><a class="menu-subitem waves-effect waves-dark" href="informes-inspeccion" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">Informes de progreso</a></li>      
     <li><a class="menu-subitem waves-effect waves-dark" href="certificados" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">Certificados de obras</a></li>      
     <li><a class="menu-subitem waves-effect waves-dark" href="certificados-redeterminados" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">Certificados redeterminados</a></li>
  <!--<li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Redeterminaciones de precios</a>
    <ul aria-expanded="false" class="collapse">

      <li><a href="precios-items" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Indices provisorios</a></li>
       
    </ul>
    </li>--> 
        <li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Tramites</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="redeterminaciones-actas" id="log-menu" onClick="save_log()" data-log-user="Click menu: Certificados redeterminados"><i class="mdi mdi-chevron-right"></i> Actas de Redeterminaciones</a></li>
    </ul>
</li>
    <?php if(permiso('admin') || permiso('certificaciones')){ ?>
    <li>
<a class="menu-subitem has-arrow waves-effect waves-dark" href="#" aria-expanded="false">Herramientas para certificar</a>
    <ul aria-expanded="false" class="collapse">
        <!--<li><a href="precios-items" id="log-menu" onClick="save_log()" data-log-user="Click menu: Expedientes"><i class="mdi mdi-chevron-right"></i> Indices de precios</a></li>-->
        <li><a href="certificados-descuentos" id="log-menu" onClick="save_log()" data-log-user="Click menu: Notas"><i class="mdi mdi-chevron-right"></i> Deducciones</a></li>
        <li><a href="polizas" id="log-menu" onClick="save_log()" data-log-user="Click menu: Notas"><i class="mdi mdi-chevron-right"></i> Polizas</a></li>
    </ul>
</li>
<?php } ?>
    
</ul>
</li> 


<li>
    <a class="menu-item" >
        <i class="far fa-question-circle"></i> <span class="hide-menu   pl-2">Ayuda</span>
    </a>
    <ul class="collapse">
     <!--<li><a class="menu-subitem waves-effect waves-dark" href="http://10.100.32.8/" target="_blank" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">Correo</a></li>-->       
     <li><a class="menu-subitem waves-effect waves-dark" href="tutoriales" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">Videos Tutoriales</a></li> 
     <li><a class="menu-subitem waves-effect waves-dark" href="https://smallpdf.com/es/unir-pdf" target="_blank" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">Combinar PDF</a></li> 
     <!--<li><a class="menu-subitem waves-effect waves-dark" href="http://dpver.ddns.info:8080/saer/web/login" target="_blank" id="log-menu" onClick="save_log()" aria-expanded="false" data-log-user="Click menu: Certificados">S.A.E.R.</a></li>        -->
       
</ul>
</li> 
