@extends('layouts.app')
@section('content')
<script>
/*$(document).ready(function(){
$.ajax({ 
method: "post", 
url: "admin/verify_auth.php",
}).done(function( data ) { 
if(data = 1){
    $("html").load("admin/index.php", function() {
        $("html").html());
    }); 

}
}
});*/
</script>

<div class="d-lg-flex half justify-content-center">
    <div class="bg order-1 order-md-2 ocultar-div" style="background-image: url('web/includes/assets/images/fondo.jpg');">
    <div class="row justify-content-center h-100" style="padding-top:20px;">
    <!--<iframe style="border:none;" width="50%" height="55%" src="./admin/content/pages/mapa-login.php">-->
</iframe>
</div>
</div>
    <div class="contents order-2 order-md-1">
    
    
      <div class="container" id="content-login">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>Iniciar sesion en <strong>S.A.C.</strong></h3>
            <p class="mb-4">Sistema Administrativo de Construcciones - D.P.V.E.R.</p>
            
            <form method="post" action="{{ url('/') }}/admin/auth.php">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" placeholder="Usuario" name="username" id="username">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Contraseña" id="password" name="password">
              </div>
              <div class="d-flex mb-5 align-items-center">
                <!--<label class="control control--checkbox mb-0"><span class="caption">Mantener cuenta iniciada</span>
                  <input type="checkbox" checked="checked" disabled />
                  <div class="control__indicator"></div>
                </label>-->
                <span class="ml-auto"><a href="{{ route('password.request') }}" class="forgot-pass" style="text-decoration:none">¿Olvido su constraseña?</a></span> 
              </div>
              <input type="submit" value="Ingresar" class="btn btn-block btn-dark2">
            </form>
            <br>
            <hr data-content="O" class="hr-text">
            <br>
              <input type="submit" id="consultar" onclick="form_consultas(true)" value="Consultar" class="btn btn-block btn-dark2">
          </div>
        </div>
        
      </div>   
      
      
             
            <form method="POST" action="{{ url('/') }}/web/consultas">
<div class="container hide"  id="form-consultas">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
          <!--<div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            <a onclick="cancelar_consultas()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
          <div class="ml-auto my-auto mr-3">
          </div>
        </div>-->
            <h2>Consultar en S.A.C.</h2><br>
            <div class="input-group mb-3">
  <input type="text" name="buscador" class="form-control" placeholder="¿Que esta buscando?" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button type="submit" class="input-group-text" id="basic-addon2">Buscar</button>
  </div>
</div>
            <p>Para utilizar el buscador debe ingresar el numero de expediente o titulo de obra</p>
                <br>                    
            <a onclick="cancelar_consultas()">Haga click aqui para regresar</a>
            
          </div>
        </div>
        
      </div>   
          </form>
          
          
    </div>
  </div>
@endsection




