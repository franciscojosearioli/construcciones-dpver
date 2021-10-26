<style>
.menu-derecho{
        list-style: none;
        list-style-type: none;
        list-style-position: outside;
  }
   
  .sub-menu-derecho{
        line-height: 35px;
        font-size: 16px;
        cursor:pointer;
  }
   
  .div-menu-derecho{
  	z-index:9999;
        width:200px;
        position:absolute;      
        border:1px solid black;
        background:#fff;         
        /*-moz-box-shadow: 0 0 5px #888;
        -webkit-box-shadow: 0 0 5px#888;
        box-shadow: 0 0 5px #888;*/
  }
</style><!--
<div class="div-menu-derecho" id="menu">
    <ul class="menu-derecho">
          <li class="sub-menu-derecho" id="copiar">Copiar</li>
          <li class="sub-menu-derecho" id="pegar">Pegar</li>
          <!--<li class="sub-menu-derecho" id="eliminar">Eliminar</li>-->
      </ul>
</div>
<script>
    $(document).ready(function(){
             
        //Ocultamos el menú al cargar la página
        $("#menu").hide();
         
        /* mostramos el menú si hacemos click derecho
        con el ratón */
        $("html").bind("contextmenu", function(e){
              $("#menu").css({'display':'block', 'left':e.pageX, 'top':e.pageY});
              return false;
        });
         
         
        //cuando hagamos click, el menú desaparecerá
        $(document).click(function(e){
              if(e.button == 0){
                    $("#menu").css("display", "none");
              }
        });
         
        //si pulsamos escape, el menú desaparecerá
        $(document).keydown(function(e){
              if(e.keyCode == 27){
                    $("#menu").css("display", "none");
              }
        });
         
        //controlamos los botones del menú
        $("#menu").click(function(e){
               
              // El switch utiliza los IDs de los <li> del menú
              switch(e.target.id){
                    case "copiar":
                          break;      
                    case "pegar":
                          document.execCommand('paste');
                          break;
                    case "eliminar":
                          alert("eliminado!");
                          break;
              }
               
        });
         
                     
  });              
</script>-->