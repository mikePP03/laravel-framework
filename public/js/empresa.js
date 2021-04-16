$(document).ready(function () {
/************Runner************/
    var _table;
    ObtenerEmpresas();  
    
/************Eventos************/
    $('#btnAceptaraddem').on('click',function(){
        var cor=$('#txtCorreo').val();
        if(cor!="" && cor !=" "){
            var res=cor.indexOf('.');
            if(res==-1){
                toastr.error('formato de correo no aceptado');
                return; 
            }else{
                var res=cor.indexOf('@');
                if(res==-1){
                    toastr.error('formato de correo no aceptado'); 
                    return;
                }
            }
        }
        if($(this).attr('data-idempresa')!=null){
            //actualizar
            data={
                IdEmpresa:          $(this).attr("data-idempresa"),
                NombreEmpresa:      $('#txtNombreEmpresa').val(),
                NitEmpresa :        $('#txtNit').val(), 
                SiglaEmpresa:       $('#txtSigla').val(),
                DireccionEmpresa:   $('#txtDir').val(),
                TelefonoEmpresa:    $('#txtTelefono').val(),
                CorreoEmpresa:      $('#txtCorreo').val(),
                NivelesEmpresa:     $('#comboniveles').val()
            };
            var id =  $(this).attr("data-idempresa");
            var nombre = $('#txtNombreEmpresa').val();

            var urlfinal= urlBase + "empresas/actualizar-empresa";
            var dataValue = JSON.stringify(data);
            $.ajax({
                type: "POST",
                url: urlfinal,
                contentType: "application/json; charset=utf-8",
                data: dataValue,
                dataType: "json",
                success: function (res) {
                    if(res.tipoMensaje=="success"){
                        // toastr.success(res.mensaje);
                        // location.reload();

                        toastr.success(res.mensaje);
                        $('#modaladdem').modal('hide');
                       // $('#comboemp').empty();
                        var idem = res.Empresa.id;  
                        ObtenerNombreEmpresaEdit(id,nombre);

                        // $("#modaladdem").modal('hide');
                        // var rowNode = _table
                        //     .row("#" + res.Empresa.id)
                        //     .data(res.Empresa)
                        //     .draw(false)
                        //     .node();
                        // cargareventos();
                    }else{
                        toastr.error(res.mensaje);
                    }
                },
                error: function(res){
                    // console.log(res);
                    toastr.error(res.mensaje);        
                }
            });
        }else{
            //Crear
            if($('#txtNombreEmpresa').val()==""){
                toastr.error("falta completar el Nombre de la empresa ");
                return;
            }
            if($('#txtNit').val()==""){
                toastr.error("falta completar el Nit");
                return;
            }
            if($('#txtNit').val().length>10){
                toastr.error("el nit solo  10 digitos");
                return;
            }
            if($('#txtSigla').val()==""){
                toastr.error("falta completar la sigla de la empresa");
                return;
            }
            data={
                NombreEmpresa:      $('#txtNombreEmpresa').val(),
                NitEmpresa :        $('#txtNit').val(),
                SiglaEmpresa:       $('#txtSigla').val(),
                DireccionEmpresa:   $('#txtDir').val(),
                TelefonoEmpresa:    $('#txtTelefono').val(),
                CorreoEmpresa:      $('#txtCorreo').val(),
                NivelesEmpresa:     $('#comboniveles').val()
            };
            var idmoneda= $('#combomonedas').val()
            var urlfinal= urlBase + "empresas/crear-empresa";
            var dataValue = JSON.stringify(data);
            var nombre = $('#txtNombreEmpresa').val();
            $.ajax({
                type: "POST",
                url: urlfinal,
                contentType: "application/json; charset=utf-8",
                data: dataValue,
                dataType: "json",
                success: function (res) {
                    if(res.tipoMensaje=="success"){
                      //  toastr.success(res.mensaje);
                        GuardarEmpresaMoeda(res.Empresa.id, idmoneda,nombre);
              
                       
                    }else{
                        toastr.error(res.mensaje);
                    }
                    tooltipnow();
                },
                error: function(res){
                    toastr.error(res);        
                }
            });
        }
    });
    $("#btn-addenter").on('click',function(){
        $('#txtNombreEmpresa').val("");
        $('#txtNit').val("");
        $('#txtSigla').val("");
        $('#txtDir').val("");
        $('#txtTelefono').val("");
        $('#txtCorreo').val("");
        $('#comboniveles').val(3);
        $('#btnAceptaraddem').removeAttr("data-idempresa");
        $('#tituloModal').text( "Crear Empresa" );
        $('#divmoneda').css("display","block");
        ObtenerMonedas()
    });
    $("#btnacepadv").click(function(){
         var idem=$(this).attr('data-idempresa');
         eliminarEmpresa(idem);
    });
    $("#btn-gestenter").on('click',function(){
        var idem = $("#comboemp").val();
        //location.href=urlBase+"menu/"+idem;
            if(idem== '' || idem == null){
           toastr.error('No existe ninguna Empresa');
        }else{
         location.href=urlBase+"menu/"+idem;  
        }
    });
    $("#btn-editenter").on('click',function(){
        // var idem = $(this).parent().parent().attr("id");
        var idem = $("#comboemp").val();
        // console.log(idem);
        // var data = {
        //     IdEmpresa: idem
        // };
        if(idem== '' || idem == null){
            toastr.error('No existe ninguna Empresa');
         }else{
           
             var data = {
             IdEmpresa: idem
         };
        data = JSON.stringify(data);
        $.ajax({
            type: 'POST',
            url: urlBase + 'empresas/TraerEmpresa',
            data: data,
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            success: function (res) {
                if (res.tipoMensaje=="success") {
                    var Empresa = res.Empresa;
                    var EmpresaMoneda = res.EmpresaMoneda;
                    $('#txtNombreEmpresa').val(Empresa.nombre);
                    $('#txtNit').val(Empresa.nit);
                    $('#txtSigla').val(Empresa.sigla);
                    $('#txtDir').val(Empresa.direccion);
                    $('#txtTelefono').val(Empresa.telefono);
                    $('#txtCorreo').val(Empresa.correo);
                    $('#comboniveles').val(Empresa.niveles);
                    $('#combomonedas').val(EmpresaMoneda.idMonedaPrincipal);
                    $('#btnAceptaraddem').attr("data-idempresa",idem);
                    $('#tituloModal').text( "Editar Empresa" );
                    $('#divmoneda').css("display","none");
                    $("#modaladdem").modal('show');
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
    }
    });
    $("#btn-delenter").on('click',function(){
        // var idem = $(this).parent().parent().attr("id");
        var idem = $("#comboemp").val();
        // $("#mensajeadver").text("¿Seguro desea Eliminar esta empresa?");
        // $("#btnacepadv").attr("data-idempresa",idem);
        // $("#modaladvertencia").modal("show");
        if(idem== '' || idem == null){
            toastr.error('No existe ninguna Empresa');
         }else{
           $("#mensajeadver").text("¿Seguro desea Eliminar este item?");
           $("#btnacepadv").attr("data-idempresa",idem);
           $("#modaladvertencia").modal("show");
         }
    });
/************Funciones************/
function ObtenerMonedas() {
    var data = {
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
                $('#combomonedas').empty();
                for(var i=0;i<Monedas.length;i++){
                    $("#combomonedas").append("<option value='"+Monedas[i].id+"'>"+Monedas[i].nombre+"</option>");
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
    function formateartabla(){
        $('#tabla').css('display','block');
        $('#tablaEmpresas').css('width','100%');
        var tablaEmpresas_length = document.getElementById('tablaEmpresas_length');
        var tablaEmpresas_paginate = document.getElementById('tablaEmpresas_paginate');
        var tablaEmpresas_info = document.getElementById('tablaEmpresas_info');
        var tablaEmpresas_filter = document.getElementById('tablaEmpresas_filter');

        tablaEmpresas_info.innerHTML = tablaEmpresas_info.innerHTML.replace('Showing', 'Mostrando');
        tablaEmpresas_info.innerHTML = tablaEmpresas_info.innerHTML.replace('to', 'a');
        tablaEmpresas_info.innerHTML = tablaEmpresas_info.innerHTML.replace('of', 'de');
        tablaEmpresas_info.innerHTML = tablaEmpresas_info.innerHTML.replace('entries', 'items');

        tablaEmpresas_paginate.innerHTML = tablaEmpresas_paginate.innerHTML.replace('Previous','Anterior');
        tablaEmpresas_paginate.innerHTML = tablaEmpresas_paginate.innerHTML.replace('Next','Siguiente');

        tablaEmpresas_filter.innerHTML = tablaEmpresas_filter.innerHTML.replace('Search','Buscar');

        tablaEmpresas_length.innerHTML = tablaEmpresas_length.innerHTML.replace('Show','Mostrar');
        tablaEmpresas_length.innerHTML = tablaEmpresas_length.innerHTML.replace('entries','items');
    }
    function eliminarEmpresa(idem){
        var urlfinal = urlBase + "empresas/eliminar-empresa";
        var data={
            IdEmpresa: idem
        };
        var dataValue = JSON.stringify(data);
        $.ajax({
            type: "POST",
            url: urlfinal,
            contentType: "application/json; charset=utf-8",
            data: dataValue,
            dataType: "json",
            success: function (res) {
                if(res.tipoMensaje=="success"){
                    toastr.success(res.mensaje);
                    //*****atribustos cambiados*****
                    // $("tr[id='"+res.IdEmpresa+"']").children().children()[0].style.pointerEvents ="none";
                    // $("tr[id='"+res.IdEmpresa+"']").children().children()[1].style.pointerEvents ="none";
                    // $("tr[id='"+res.IdEmpresa+"']").children().children()[2].style.pointerEvents ="none";
                    // $("tr[id='"+res.IdEmpresa+"']").css("opacity","0.5");
                    // var IdEmpresa = "#" + res.IdEmpresa;
                    // _table.row(IdEmpresa)
                    //         .remove()
                    //         .draw();
                    // $("#modaladvertencia").modal("hide");
                    // tooltipnow();
                    location.reload();
                }else{
                    toastr.error(res.mensaje,'Error para eliminar la empresa', {timeOut: 3000});
                }
            },
            error: function(res){
                toastr.error(res,'Error', {timeOut: 3000});        
            }
        });
    }
    function ObtenerEmpresas(idem=0) {
        var data = {
        };
        data = JSON.stringify(data);
        $.ajax({
            type: 'POST',
            url: urlBase + 'empresas/listarempresas',
            data: data,
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            success: function (res) {
                if (res.tipoMensaje=="success") {
                    var Empresas = res.Empresas;
                    for(var i=0;i<Empresas.length;i++){
                        $("#comboemp").append("<option value='"+Empresas[i].id+"'>"+Empresas[i].nombre+"</option>");
                    }
                    if(idem != 0){
                        $("#comboemp option[value="+idem+"]").attr("selected", "selected"); 
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

    function ObtenerNombreEmpresaEdit(id=0, nombre =0) {
        $("#comboemp option[value="+id+"]").text(nombre); 
    }

    function ObtenerNombreEmpresaCrear(idem=0, nombre =0) {
        name = nombre;
        value = idem;

       
  
            $('#comboemp').append(`<option value="${value}"> 
                                       ${name} 
                                  </option>`);
        
        if(idem != 0){
            $("#comboemp option[value="+idem+"]").attr("selected", "selected"); 
         } 
    }

    function cargareventos(){
        $(".btn-gestionar").on('click',function(){
            var idem = $(this).parent().parent().attr("id");
            location.href=urlBase+"menu/"+idem;
        });
        $(".btn-editenter").on('click',function(){
            var idem = $(this).parent().parent().attr("id");
            var data = {
                IdEmpresa: idem
            };
            data = JSON.stringify(data);
            $.ajax({
                type: 'POST',
                url: urlBase + 'empresas/TraerEmpresa',
                data: data,
                dataType: 'json',
                contentType: "application/json; charset=utf-8",
                success: function (res) {
                    if (res.tipoMensaje=="success") {
                        var Empresa = res.Empresa;
                        $('#txtNombreEmpresa').val(Empresa.nombre);
                        $('#txtNit').val(Empresa.nit);
                        $('#txtSigla').val(Empresa.sigla);
                        $('#txtDir').val(Empresa.direccion);
                        $('#txtTelefono').val(Empresa.telefono);
                        $('#txtCorreo').val(Empresa.correo);
                        $('#comboniveles').val(Empresa.niveles);
                        $('#btnAceptaraddem').attr("data-idempresa",idem);
                        $("#modaladdem").modal('show');
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
        $(".btn-eliminarem").on('click',function(){
            var idem = $(this).parent().parent().attr("id");
            $("#mensajeadver").text("¿Seguro desea Eliminar este item?");
            $("#btnacepadv").attr("data-idempresa",idem);
            $("#modaladvertencia").modal("show");
        });
    }

    function GuardarEmpresaMoeda(idempresa,idmoneda,nombre){

        data={
               idEmpresa: idempresa,
               idMoneda :  idmoneda
           };

           var dataValue = JSON.stringify(data);
           $.ajax({
               type: 'POST',
               url: urlBase + 'empresamoneda/crear-empresamoneda',
               data:dataValue,
               dataType: 'json',
               contentType: "application/json; charset=utf-8",
               success: function (res) {
                   if (res.tipoMensaje=="success") {
                       toastr.success(res.mensaje);
                       $('#modaladdem').modal('hide');
                      // $('#comboemp').empty();
                       var idem = res.moneda.idEmpresa;  
                       ObtenerNombreEmpresaCrear(idem,nombre);
                                           
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
   }

/************validaciones************/
    $("#txtNit").keypress(function (tecla) {
        var value = $("#txtNit").val();
        var code=tecla.charCode;
        if(code === 8){
            return true;
        }
        if(code > 57 || code < 48){            
            //toastr.error("solo puede tener numeros");
            return false;        
        }else{
            if((value.length + 1) > 10){
                //toastr.error("solo puede tener 10 digitos");
                return false;
            }else{
                return true;
            }           
        }
    });
    $("#txtNombreEmpresa").keypress(function (tecla) {
        var value = $("#txtNombreEmpresa").val();
        if((value.length + 1) > 100){
            toastr.error("solo puede tener 100 caracteres");
            return false;
        }else{
            return true;
        }           
    });
});
$(window).load(function(){
    var idemsel = $("#comboemp").val();
    if(idemsel==0 || idemsel==null){
        $("#btn-gestenter").attr('disabled','disabled');
        $("#btn-editenter").attr('disabled','disabled');
        $("#btn-delenter").attr('disabled','disabled');
    }
});