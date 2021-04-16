@extends('layouts.general')
@section('title')
	<title>Lista de Empresas</title>
@endsection

@section('links')
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.min.css">
@endsection

@section('scripts')
	<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.min.js'></script>
	<script src="{{ asset('js/tablas.js') }}"></script>
	<script src="{{ asset('js/empresa.js') }}"></script>
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-12 col-xs-12">
				<div class="nav-tabs-custom">
					<!-- Tabs within a box -->
					<ul class="nav nav-tabs pull-right ui-sortable-handle">

					<li class="pull-left header"><i class="fa fa-inbox"></i> Lista de Empresas</li>
					</ul>
					<div class="tab-content no-padding">
					<button type="button" class="btn btn-info" id="btn-addenter" data-toggle="modal" data-target="#modaladdem">Agregar Empresa</button>
					<!-- <button type="button" class="btn btn-info" id="btn-repem" onclick="javascript:window.open('http://localhost:9595/ReporteFinal/index.php','','width=900,height=500,left=50,top=50');">Reporte Empresa</button> -->
					<br/>
					<br/>
					
					<div class="container-90">
						<div class="page">
							<div id="tabla" class="table-responsive" style="display: none;" >
								<table id="tablaEmpresas" class="table table-striped table-bordered table-hover display" >
									<thead class="thead-dark">
										<tr>
											<th>Nombre</th>
											<th>Nit</th>
											<th>Sigla</th>
											<th>Niveles</th>
											<th>Opciones</th>
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
	</div>
	@if (Auth::check())
	

	<!-- Modal Agregar - Editar -->
	<div id="modaladdem" class="modal fade" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">

					<h3 class="modal-title" id="tituloModal"class="font-fa"> Crear Empresa</h3>
				</div>

				<div class="modal-body">
						<form action="" method="post" id="formulario">
							<div class="row">

								<div class="col-md-12"> 							

									<input type="hidden" name="_token" value="{{ csrf_token() }}">

									<div class="row">
										<div class="col-md-6 col-xs-12">	
											<div class="form-group">
												<label for="txtNombreEmpresa">Nombre de la Empresa: <span class="campoObligatorio">*</span></label>
												<input class="form-control" type="text" id="txtNombreEmpresa" name="txtNombreEmpresa" title="Se necesita el nombre de la Empresa" required />
											</div>
										</div>

										<div class="col-md-6 col-xs-12">
											<div class="form-group">
												<label for="txtNit">Numero de Nit: <span class="campoObligatorio">*</span></label>
												<input class="form-control" type="text" id="txtNit" name="txtNit" min="1" max="10" pattern="[0-10]{1,}" title="Se necesita el Nit de la Empresa" required />
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6 col-xs-12">
											<div class="form-group">
												<label for="txtSigla">Sigla: <span class="campoObligatorio">*</span></label>
												<input class="form-control" type="text" id="txtSigla" name="txtSigla" title="Se necesita una sigla para la empresa" required />
											</div>
										</div>

										<div class="col-md-6 col-xs-12">
											<div class="form-group">
												<label for="txtTelefono">Telefono de la Empresa</label>
												<input class="form-control" type="text" id="txtTelefono" name="txtTelefono" title="Se necesita un Telefono para la Empresa" />
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 col-xs-12">
											<div class="form-group">
												<label for="txtCorreo">Correo de la Empresa</label>
												<input class="form-control" type="text" id="txtCorreo" name="txtCorreo" title="Se necesita un Correo para la Empresa" />
											</div>
										</div>

										<div class="col-md-6 col-xs-12">
											<div class="form-group">
												<label for="txtDir">Direccion de la Empresa:</label>
												<input class="form-control" type="text" id="txtDir" name="txtDir" title="Se necesita una Direccion para la Empresa" />
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="comboniveles">Niveles: <span class="campoObligatorio">*</span></label>
												<select class="form-control" id="comboniveles" required>
													@if (!empty($niveles))
														@foreach($niveles as $nivel)
															<option value="{{$nivel}}">{{ $nivel }}</option>	
														@endforeach
										            @endif
										            <option value="3">3</option>
										            <option value="4">4</option>
										            <option value="5">5</option>
										            <option value="6">6</option>
										            <option value="7">7</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

						</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-info" id="btnAceptaraddem">Aceptar</button>
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
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="tituloModal">Registro</h4>
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