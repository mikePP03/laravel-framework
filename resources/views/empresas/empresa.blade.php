@extends('layouts.general')

@section('title')
    <title>Lista de Empresas </title>
@endsection

@section('links')
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.min.css">
	
@endsection

@section('scripts')
	<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js') }}"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.7.0/sweetalert2.min.js'></script>
	<script src="{{ asset('js/tablas.js') }}"></script>
	<script src="{{ asset('js/general.js') }}"></script>
	<script src="{{ asset('js/empresa.js') }}"></script>
@endsection

@section('content')
@if (Auth::check())
		<br>
		<br>
		<br>
    <div class="row justify-content-md-center">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
            <div class="card-header card-header-tabs card-header-primary">
                <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <span class="nav-tabs-title">Lista de Empresas</span>
                    <ul class="nav nav-tabs" data-tabs="tabs" style="float:left !important;">
                    </ul>
                </div>
                </div>
            </div>
			
            <div class="card-body">
				<br>
				<div class="field-wrap">
				<div class="form">
        <div id="signup">
            
            <form action="/" method="post">
                <br>
                
                <div class="field-wrap">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <h2>Empresas:</h2>
                        </div>
                       <div class="col-md-5">
                            <select class="form-control" id="comboemp">
                            </select> 
						</div>
						<div class="col-md-1"><button style="BACKGROUND-COLOR: #007d71" title="Ingresar" type="button" class="btn btn-secondary" id="btn-gestenter"><span class="fas fa-sign-in-alt" aria-hidden="true"></span></button>
						</div>
                    </div>
                </div>

                <div class="field-wrap">
					<br>
                    <div class="row">
						<div class="col-md-4"></div>
						                      
						<div class="col-md-1">
						<button style=" BACKGROUND-COLOR: #007d71" title="Agregar Empresa" type="button" class="btn btn-secondary" id="btn-addenter" data-toggle="modal" data-target="#modaladdem"><span class="fa fa-plus" aria-hidden="true"></span></button>
						</div>
						<div class="col-md-1"><button style="BACKGROUND-COLOR: #007d71" title="Editar Empresa" type="button" class="btn btn-secondary" id="btn-editenter"><span class="fas fa-pencil-alt" aria-hidden="true"></span></button>
						</div>
						<div class="col-md-1"><button style="BACKGROUND-COLOR: #007d71" title="Eliminar Empresa" type="button" class="btn btn-secondary" id="btn-delenter"><span class="fas fa-trash-alt" aria-hidden="true"></span></button>
						</div>
						
						<div class="col-md-1"><button style="BACKGROUND-COLOR: #007d71" title="Reporte de Empresas" type="button" class="btn btn-secondary" id="btn-reportempre"  onclick="javascript:window.open('http://localhost:9595/Reports/index.php?usuario='+{{Auth::user()->id}},'','width=900,height=500,left=50,top=50');" ><span class="fa fa-print" aria-hidden="true"></span></button>
						</div>
					
					</div>
                </div>

            </form>

        </div>


    </div>
                </div>
				<br>
				<br>
				
                <!-- <button type="button" class="btn btn-info" id="btn-addenter" data-toggle="modal" data-target="#modaladdem">Agregar Empresa</button>
                <button type="button" class="btn btn-info" id="btn-editenter">Editar Empresa</button>
                <button type="button" class="btn btn-info" id="btn-delenter">Eliminar Empresa</button>
                <button type="button" class="btn btn-info" id="btn-gestenter">Gestionar Empresa</button> -->
            </div>
        </div>
	</div>
	
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
										
										<div class="col-md-6" id="divmoneda" style="display: block;">
											<div class="form-group">
												<label >Moneda Principal:</label>
												<select class="form-control" id="combomonedas" required>
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
				
				</div>

				<div class="modal-body">
					<p id="mensajeadver">¿Esta Seguro de Querer Eliminar esta empresa?</p>
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