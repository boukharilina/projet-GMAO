@extends('admin.layouts.app')

@push('page-css')
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Installations</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Ajouter une Installation</li>
	</ul>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body custom-edit-service">


			<!-- Add tache -->
			<form method="post" enctype="multipart/form-data" action="{{route('installations.store')}}">
				@csrf
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Client<span class="text-danger">*</span></label>
								<select  class="select2 form-select form-control" name="client" >
									<option >Sélectionner le client</option>
										@foreach($clients as $client)
											<option value="{{ $client->id}}">{{ $client->name }}</option>
										@endforeach
                                </select>
							</div>
						</div>
						<div class="col-lg-6">
							<label>Equipement<span class="text-danger">*</span></label>
							<input class="form-control" type="text" name="equipement">
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Techniciens(s)<span class="text-danger">*</span></label>
                                <select class="select2 form-select form-control"  name="user_id[]" multiple>
                                    <option>--Sélectionner le/les technicien(s)--</option>
                                     @foreach ($users as $user)
                                         <option value="{{$user->id}}">{{$user->name}}</option>
                                     @endforeach
                                 </select>
							</div>
						</div>
						<div class="col-lg-6">
							<label>Date/Heure</label>
							<input type="datetime-local" name="date_debut" class="form-control">
						</div>
					</div>
				</div>

            	<div class="service-fields mb-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Etat<span class="text-danger">*</span></label>
                                <select  class="select2 form-select form-control" name="status">
                                <option >Sélectionner l'etat de l'installation</option>
                                <option value="Contrat pieces et main oeuvre">Contrat pieces et main oeuvre</option>
                                <option value="Contrat main oeuvre">Contrat main oeuvre</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-12">
							<label>Commentaire</label>
							<textarea name="description" class="form-control" cols="30" rows="10"></textarea>
						</div>
					</div>
				</div>

				<div class="submit-section">
					<button class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Valider</button>
				</div>
			</form>
			<!-- /Add installations -->


			</div>
		</div>
	</div>
</div>
@endsection

@push('page-js')
	<!-- Datetimepicker JS -->
	<script src="{{asset('assets/js/moment.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
@endpush

