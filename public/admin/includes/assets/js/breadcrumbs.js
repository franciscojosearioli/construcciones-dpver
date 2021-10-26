String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
var url = location.pathname.substring(location.pathname.lastIndexOf("/") + 1).capitalize();
var titulo = '';
var area = '';
var permiso = '';
var path = '<div class="row page-titles" style="padding-left: 40px;"><div class="col-sm-12 col-md-5 col-8 align-self-center"><h4 style="padding-top: 10px;">'+titulo+'</h4><ol class="breadcrumb m-b-10"><li class="breadcrumb-item"><a href="index.php">Inicio</a></li>';
$(".bredcrumb").html(path+'<li class="breadcrumb-item active">'+url+'</li></ol></div><div class="col-md-7 col-4 align-self-center"><div class="d-flex m-t-10 justify-content-end"><div class="d-flex m-r-20 m-l-10 hidden-md-down"><div class="chart-text m-r-10"><h4 class="m-t-0 text-info text-right">'+area+'</h4><h6 class="m-b-0 text-right"><small>'+permiso+'</small></h6></div></div></div></div></div>');