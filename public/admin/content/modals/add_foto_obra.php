<?php $obra = find_by_id('obras','idobras', (int)$_GET['id']); ?>
<style>
    button {
  background: #81c784;
  border: none;
  color: ##81c784;
  padding: 5px 5px;
  width: 30%;
  text-align: center;
  outline: #81c784;
}
button:active {
  border-style: outset;
}
.nav-tabs > li, .nav-item > li {
    float:none;
    display:inline-block;
    text-align: justify;
}

.nav-tabs{
  border: 1px solid #dee2e6;
  text-align: center;
    text-align: justify;
}
.nav-tabs .nav-link{
  border: none;
      text-align: justify;
}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
  background: #00000010;
    text-align: justify;
}
.confirmar{
    border: 1px solid #dee2e6;
    padding: 25px;
}
</style>
<div class="modal fade" id="add_foto_obra" tabindex="-1" role="dialog" aria-labelledby="add_foto_obra" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_foto_obra">Carga de datos</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card-body">
            <form action="obra?id=<?php echo $obra['idobras']; ?>" name="carga-datos" method="post" enctype="multipart/form-data">
<input type="text" name="n_caja" value="<?php echo $obra['numero']; ?>" style="visibility:hidden;" />
<input type="text" name="id_obra" value="<?php echo $obra['idobras']; ?>" style="visibility:hidden;" />
<div class="row">
<div class="col-12">
<center><h3><b>Fotos</b></h3>
<br><p>Puede seleccionar multiples archivos.</p></center>     
<div class="fallback">
<input name="fotos[]" type="file" multiple />
</div></div>
</div>
<br>
<hr>
<div class="row">
<div class="col-12">
<div class="d-flex">
<button type="submit" name="add_fotos" class="btn btn-info waves-effect waves-light ml-auto" title="Confirmar carga">Confirmar</button>
</div>
</div>
</div>
                </div>
            </form>
         </div>
    </div>
  </div>
</div>