$(document).ready( function () {
	// $('#tablaEmpresas').DataTable({
	// 	"pageLength": 25
	// });
	// $('#tablagestiones').DataTable({
	// 	"pageLength": 25
	// });
	// $('#tablaperiodos').DataTable({
	// 	"pageLength": 25
	// });
	// $('#tablaMonedas').DataTable({
	// 	"pageLength": 25,
	// 	"order": [[ 4, "asc" ]]
	// });
	$('#tablaComprobantes').DataTable({
		"pageLength": 25,
		"order": [[ 0, "desc" ]]
	});
	$('#tablaarticulos').DataTable({
		"pageLength": 25
	});
	$('#tablalotes').DataTable({
		"pageLength": 25
	});
	$('#tablanotas').DataTable({
		"pageLength": 25,
		"order": [[ 1, "desc" ]]
	});
	$('#tablaintegracion').DataTable({
		"pageLength": 25,
		"order": [[ 6, "asc" ]]
	});
});


