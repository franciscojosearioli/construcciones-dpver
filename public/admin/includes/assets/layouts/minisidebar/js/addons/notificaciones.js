// JavaScript Document
 
// Función para recoger los datos de PHP según el navegador, se usa siempre.
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
 
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}
 
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
 
//Función para recoger los datos del formulario y enviarlos por post  
function NewMensajeGlobal(){
 
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('ResultMG');
  //recogemos los valores de los inputs
  msj=document.NewMG.mensaje_global.value;
 
  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "includes/assets/notificaciones/globales/registro.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
	  //la función responseText tiene todos los datos pedidos al servidor
  	if (ajax.readyState==4) {
  		//mostrar resultados en esta capa
		divResultado.innerHTML = ajax.responseText
  		//llamar a funcion para limpiar los inputs
		LimpiarMG();
	}
 }
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("mensaje="+msj)
}
 
//función para limpiar los campos
function LimpiarMG(){
  document.NewMG.mensaje_global.value="";
  document.NewMG.mensaje_global.focus();
}


//Función para recoger los datos del formulario y enviarlos por post  
function NewMensajePrivado(){
 
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('ResultMP');
  //recogemos los valores de los inputs
  msj=document.NewMP.mensaje_privado.value;
  destino=document.NewMP.receptor.value;

  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "includes/assets/notificaciones/privados/registro.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
    //la función responseText tiene todos los datos pedidos al servidor
    if (ajax.readyState==4) {
      //mostrar resultados en esta capa
    divResultado.innerHTML = ajax.responseText
      //llamar a funcion para limpiar los inputs
    LimpiarMP();
  }
 }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores a registro.php para que inserte los datos
  ajax.send("mensaje="+msj+"&receptor="+destino)
}
 
//función para limpiar los campos
function LimpiarMP(){
  document.NewMP.mensaje_privado.value="";
  document.NewMP.receptor.value="Seleccionar destinatario";  
  document.NewMP.mensaje_privado.focus();
}


/*
* Parametros mandatorios
*/
  var seconds = 10; // el tiempo en que se refresca
  var divid = "ResultRecibidos"; // el div que quieres actualizar!
  var url = "includes/assets/notificaciones/privados/recibidos.php"; // el archivo que ira en el div
  var divid2 = "sinleer"; // el div que quieres actualizar!
  var url2 = "includes/assets/notificaciones/privados/conteo.php"; // el archivo que ira en el div

  function refreshdiv(){

    // The XMLHttpRequest object

    var xmlHttp;
    try{
      xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
    }
    catch (e){
      try{
        xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
      }
      catch (e){
        try{
          xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e){
          alert("Tu explorador no soporta AJAX.");
          return false;
        }
      }
    }

    // Timestamp for preventing IE caching the GET request
    var timestamp = parseInt(new Date().getTime().toString().substring(0, 10));
    var nocacheurl = url+"?t="+timestamp;

    // The code...

    xmlHttp.onreadystatechange=function(){
      if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
        document.getElementById(divid).innerHTML=xmlHttp.responseText;
        setTimeout('refreshdiv()',seconds*1000);
      }
    }
    xmlHttp.open("GET",nocacheurl,true);
    xmlHttp.send(null);
  }

  function refreshdiv2(){

    // The XMLHttpRequest object

    var xmlHttp;
    try{
      xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
    }
    catch (e){
      try{
        xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
      }
      catch (e){
        try{
          xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e){
          alert("Tu explorador no soporta AJAX.");
          return false;
        }
      }
    }

    // Timestamp for preventing IE caching the GET request
    var timestamp = parseInt(new Date().getTime().toString().substring(0, 10));
    var nocacheurl = url2+"?t="+timestamp;

    // The code...

    xmlHttp.onreadystatechange=function(){
      if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
        document.getElementById(divid2).innerHTML=xmlHttp.responseText;
        setTimeout('refreshdiv2()',seconds*1000);
      }
    }
    xmlHttp.open("GET",nocacheurl,true);
    xmlHttp.send(null);
  }


  //Función para recoger los datos del formulario y enviarlos por post  
function LeerMensaje(){
 
  //div donde se mostrará lo resultados
  divResultado = document.getElementById('ResultRecibidos');
  //recogemos los valores de los inputs
  msj=document.NewMP.mensaje.value;

  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "includes/assets/notificaciones/privados/leer.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
    //la función responseText tiene todos los datos pedidos al servidor
    if (ajax.readyState==4) {
      //mostrar resultados en esta capa
    divResultado.innerHTML = ajax.responseText
  }
 }
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores a registro.php para que inserte los datos
  ajax.send("mensaje="+msj)
}

