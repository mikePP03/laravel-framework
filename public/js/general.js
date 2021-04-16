var urlBase = 'http://localhost:9595/';

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

function alertSweet(titulo, mensaje, tipo, botonConfirmacion) {
	swal({
		title: titulo,
		text: mensaje,
		type: tipo,
		confirmButtonText: botonConfirmacion
	});
}
function tooltipnow(){
    $('[data-toggle="tooltip"]').tooltip();
}
function ajaxx(url,datos){
	$.ajax({
        type: "POST",
        url: url,
        contentType: "application/json; charset=utf-8",
        data: datos,
        dataType: "json",
        success: function (res) {
            if(res.tipoMensaje=="success"){
                toastr.success(res.mensaje);
                setTimeout(function(){ location.reload(); }, 800);
            }else{
                toastr.error(res.mensaje,'Error', {timeOut: 3000});
            }
        },
        error: function(res){
            toastr.error(res,'Error', {timeOut: 3000});        
        }
    });
}
