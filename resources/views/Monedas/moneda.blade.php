@extends('layouts.general')

@section('title')
<title>Tipo de cambio</title>
@endsection

@section('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.min.css">
<style>
table.dataTable thead tr {
    background-color: white;
}

.dataTables_paginate a {
    color: white !important;
}

.dataTables_filter label {
    color: white !important;
}

.dataTables_filter input {
    color: black !important;
}

.dataTables_length label {
    color: white !important;
}

.dataTables_length select {
    color: black !important;
}

.dataTables_info {
    color: white !important;
}
</style>
@endsection

@section('scripts')
<link rel="stylesheet" href="{{asset('plantilla/css/font-awesome.min.css')}}">
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.min.js'></script>
<script src="{{ asset('js/tablas.js') }}"></script>
<script src="{{ asset('js/gestion.js') }}"></script>
<script src="{{ asset('js/moneda.js') }}"></script>
@endsection

@section('content')

@if (Auth::check())
<div class="col-xl-12">
<label id="lblidempresa" style="display: none;">{{ $idempresa }}</label>
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold " style="color: #007d71">Tipo de Campio </h6>
            <div class="dropdown no-arrow">
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label >Moneda Principal:</label>
                        <input class="form-control" type="text" id="txtmoneda" name="txtmoneda" title="Moneda principal de la empresa" required />
                        <input class="form-control" type="text" id="txtidmoneda" name="txtmoneda" style="display: none;" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label >Moneda Alternativa:</label>
                       <select class="form-control" id="combomonedas" required>
                       </select>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label >Cambio:</label>
                    <input class="form-control" type="text" id="txtcambio" name="txtcambio" min="1" max="8" pattern="[0-10]{1,}"  title="Cambio entre Monedas" required />
                    </div>
                </div>
                 <div class="col-md-3 col-xs-12">
                   <div style=" position:relative;
      top:32px;
      ">
                        
                        <button href="#" style="BACKGROUND-COLOR: #007d71" class="btn btn-secondary " title="Agregar Moneda" id="btn-addmone"  style="margin-top: 0.8em" >
		            <span class="fa fa-plus" aria-hidden="true"></span>
                        </button>
                </div>
                        
                    
                </div>   
            </div>
            <br />
            <div class="container-90">
                <div class="page">
                    <div id="tabla" class="table-responsive" style="display: none;">

                        <table id="tablaMonedas" class="table table-striped table-bordered table-hover display">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Moneda Principal</th>
                                    <th>Moneda Alternativa</th>
                                    <th>Cambio</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Agregar - Editar -->
<div id="modaladdges" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="tituloModal"></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>          
            </div>

            <div class="modal-body">
                <form action="" method="post" id="formulario">
                    <div class="row">

                        <div class="col-md-12">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="txtNombreGestion">Nombre de la Gestion: <span
                                                class="campoObligatorio">*</span></label>
                                        <input class="form-control" type="text" id="txtNombreGestion"
                                            name="txtNombreGestion" title="Se necesita el nombre de la Gestion"
                                            required />
                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="txtfecin">Fecha de Inicio: <span
                                                class="campoObligatorio">*</span></label>
                                        <input class="form-control" type="date" id="txtfecin" name="txtfecin"
                                            title="Se necesita una Fecha de Inicio" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="txtfecfin">Fecha de Fin: <span
                                                class="campoObligatorio">*</span></label>
                                        <input class="form-control" type="date" id="txtfecfin" name="txtfecfin"
                                            title="Se necesita una Fecha de Fin" required />
                                    </div>
                                </div>

                                <!-- <div class="col-md-6 ">
												<div id="divcomes" class="form-group" style="display: none;">
													<label for="comboestado">Estado:</label>
													<select id="comboestado">
														<option value="1">habilitado</option>
														<option value="2">deshabilitado</option>
													</select>
												</div>
											</div> -->
                            </div>

                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
            
                <button type="button" class="btn btn-info" id="btnAceptaraddges">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal advertencia-->
<div id="modaladvertencia" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tituloModal">Registro</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>               
            </div>

            <div class="modal-body">
                <p id="mensajeadver">¿Esta Seguro de Querer Eliminar este Registro?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="btnacepadv">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btndecliadv">Cancelar</button>
            </div>
        </div>

    </div>
</div>
@endif


@endsection