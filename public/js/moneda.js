 $(document).ready(function($) {
     var _table;
     var _trueque;
    ObtenerMonedas();
    ObtenerEmpresaMoneda();
    desactivarCrear();
 });
 //Funcion que no permite ingresar valores distintos de float con 2 decimales
 $('#txtcambio').on('keypress', function (e) {
     // Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
     var field = $(this);
     key = e.keyCode ? e.keyCode : e.which;
 
     if (key == 8) return true;
     if (key > 47 && key < 58) {
       if (field.val() === "") return true;
       var existePto = (/[.]/).test(field.val());
       if (existePto === false){
           regexp = /.[0-9]{3}$/; //PARTE ENTERA 10
       }
       else {
         regexp = /.[0-9]{2}$/; //PARTE DECIMAL2
       }
       return !(regexp.test(field.val()));
     }
     if (key == 46) {
       if (field.val() === "") return false;
       regexp = /^[0-9]+$/;
       return regexp.test(field.val());
     }
     return false;
 });
 //
function ObtenerMonedas() {
        var data = {
            idem:  $('#lblidempresa').text()
        };
        data = JSON.stringify(data);
        $.ajax({
            type: 'POST',
            url: urlBase+'Moneda/listarmonedas',
            data: data,
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            success: function (res) {
                if (res.tipoMensaje=="success") {
                    var Monedas = res.Monedas;
                    var Nmoneda = res.MonedaP.nombre;
                    var idMonedaP = res.idMonedaP;
                    var Trueque = res.Trueque;
                    _trueque = res.Trueque;
                    $('#txtmoneda').val(Nmoneda);
                    $('#txtidmoneda').val(idMonedaP);
                    $('#txtcambio').val(Trueque);
                    $("#txtmoneda").attr("disabled", "disabled");
                    $('#combomonedas').empty();
                    for(var i=0;i<Monedas.length;i++){
                        if (idMonedaP != Monedas[i].id) {
                            $("#combomonedas").append("<option value='"+Monedas[i].id+"'>"+Monedas[i].nombre+"</option>");
                        }
                        
                    }
                }
                else {
                    toastr.error(res.mensaje);
                }
            },
            error: function (res) {
                toastr.error(res.mensaje);
            }
        });
}
    //
function ObtenerEmpresaMoneda() {
     var data = {
            IdEmpresa:$('#lblidempresa').text()
        };
        data = JSON.stringify(data);
        //Obtener Monedas
        $.ajax({
            type: 'POST',
            url: urlBase+'Moneda/listarEM',
            data: data,
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            success: function (res) {
                if (res.tipoMensaje=="success") {
                    var Monedas = res.Monedas;
                    for(var i=0;i<Monedas.length;i++){
                        var estad = Monedas[i].Activo;
                        if(estad == 1){
                            Monedas[i].Activo = "Activo";
                        }else{
                            Monedas[i].Activo = "Inactivo";
                        }
                        var fr = Monedas[i].FechaRegistro.split("-");
                        Monedas[i].FechaRegistro = fr[2] + "/" + fr[1] + "/" + fr[0];
                    }
                    _table = $('#tablaMonedas').DataTable({
                        "language": {
                            "aria": {
                                "sortAscending": ": activar para ordenar la columna de manera ascendente",
                                "sortDescending": ": activar para ordenar la columna de manera descendente"
                            },
                            "emptyTable": "No hay datos disponibles",
                            "info": "Mostrando de _START_ a _END_ de _TOTAL_ items",
                            "infoEmpty": "no hay datos disponibles",
                            "infoFiltered": "(filtrando desde _MAX_ total de registros)",
                            "lengthMenu": "_MENU_ items",
                            "search": "Buscar:",
                            "zeroRecords": "Sin Coincidencias"
                        },
                        buttons: [
                            { extend: 'print',
                              className: 'btn dark btn-outline', 
                              customize: function ( win ) {
                                    $(win.document.body)
                                        .css( 'font-size', '10pt' );

                                    $(win.document.body).find( 'table' )
                                        .addClass( 'compact' )
                                        .css( 'font-size', 'inherit' );
                                } 
                            },
                            { extend: 'pdf', className: 'btn green btn-outline' },
                            { extend: 'csv', className: 'btn purple btn-outline ' }
                        ],
                        scrollY:        300,
                        deferRender:    true,
                        "lengthMenu": [
                            [10, 15, 20, -1],
                            [10, 15, 20, "All"] 
                        ],
                        "pageLength": 10,
                        "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                        "data": Monedas,
                        "rowId": "id",
                        //campos del DTO 
                        "columns": [
                            { "data": "FechaRegistro" },
                            { "data": "NombrePrincipal" },
                            { "data": "NombreSecundario" },
                            { "data": "Cambio"},
                            { "data": "Activo" },
                        ],
                        "order": [[ 4, "asc" ]]
                    });
                    formateartabla();
                    tooltipnow();
                }
                else {
                    toastr.error(res.mensaje);
                }
            },
            error: function (res) {
                toastr.error(res.mensaje);
            }
        });
}

 $("#btn-addmone").on('click',function(){
        if($("#combomonedas").val()==null){
            toastr.error("falta campos obligatorios");
            return;
        }
        if($("#txtcambio").val()==""){
            toastr.error("falta campos obligatorios");
            return;
        }
        data={
            idem: $('#lblidempresa').text(),
            primaria: $("#txtidmoneda").val(),
            secundaria: $("#combomonedas").val(),
            cambio: $("#txtcambio").val()
        };
        var urlfinal = urlBase + "Moneda/AgregarMoneda";
        var dataValue = JSON.stringify(data);
        $("#btn-addmone").attr("disabled","disabled");
        $.ajax({
            type: 'POST',
            url: urlfinal,
            data: dataValue,
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            success: function (res) {
                if (res.tipoMensaje=="success") {
                    _trueque = $("#txtcambio").val();
                    var idbackmoney = $(".sorting_1").parent()[0].getAttribute("id");
                    var fecha  = $(".sorting_1").parent()[0].children[0].innerHTML;
                    var m1 = $(".sorting_1").parent()[0].children[1].innerHTML;
                    var m2 = $(".sorting_1").parent()[0].children[2].innerHTML;
                    var cambio = $(".sorting_1").parent()[0].children[3].innerHTML;
                    var status = "Inactivo";
                    var moneylast={
                        Activo: status,
                        Cambio: cambio,
                        FechaRegistro: fecha,
                        NombrePrincipal: m1,
                        NombreSecundario: m2,
                        id: idbackmoney,
                        monedapri: 1,
                        monedasec: 2,
                    };
                    var rowNode = _table
                            .row("#" + idbackmoney)
                            .data(moneylast)
                            .draw(false)
                            .node();
                    var moneda = res.Moneda;
                    var estad = moneda.Activo;
                    if(estad == 1){
                        moneda.Activo = "Activo";
                    }else{
                        moneda.Activo = "Inactivo";
                    }
                    var fr = moneda.FechaRegistro.split("-");
                    moneda.FechaRegistro = fr[2] + "/" + fr[1] + "/" + fr[0];
                    var rowNode = _table
                            .row.add(moneda)
                            .draw()
                            .node();
                    $("tr[id='"+res.Moneda.id+"']").css('color', '#fff');
                    $("tr[id='"+res.Moneda.id+"']").css('background-color', '#0E8BD8');
                    $("tr[id='"+res.Moneda.id+"']").children()[4].classList.remove("sorting_1");
                    setTimeout(function () { 
                        $("tr[id='"+res.Moneda.id+"']").css('background-color', '#fff');
                        $("tr[id='"+res.Moneda.id+"']").children()[4].classList.add("sorting_1");
                        $("tr[id='"+res.Moneda.id+"']").css('color', '#333');
                    }, 5000);
                    
                }
                else {
                    toastr.error(res.mensaje);
                }
                tooltipnow();
            },
            error: function (res) {
                toastr.error(res.mensaje);
            }
        }); 
    });
    
    $('#txtcambio').on("change keyup paste click", function(){
     desactivarCrear();
    });

    function desactivarCrear(){
        var Trueque = $("#txtcambio").val();
        var truque1 = _trueque;
        if(Trueque != _trueque){
            $("#btn-addmone").removeAttr("disabled");

        }else{
            $("#btn-addmone").attr("disabled","disabled");
        }
    }
function formateartabla(){
        $('#tabla').css('display','block');
        document.getElementById("tablaMonedas_filter").style.display="none";
        document.getElementById("tablaMonedas_info").style.display="none";
        document.getElementById("tablaMonedas_paginate").style.display="none";
        document.getElementById("tablaMonedas_length").style.display="none";
}

