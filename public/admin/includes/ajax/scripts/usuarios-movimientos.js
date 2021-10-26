
	function logs_menu(){
		var info = $('#log-menu').data('log');
		var infoString = 'info='+info;
		$.ajax({
type: "POST",
data: infoString,
url: "includes/ajax/usuarios_movimientos.php",
success: function(data) {
console.log(data);
}
});
}