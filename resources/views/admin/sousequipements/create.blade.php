@extends('admin.layouts.app')

@push('page-css')
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Gestion Sous Equipements</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">Ajouter Sous-equipement</li>
	</ul>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body custom-edit-service">


			<!-- Add sous-equipement -->
			<form method="POST" enctype="multipart/form-data" action="{{ route('sousequipements.store', ['equipement_id' => $equipement_id]) }}">

				@csrf

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Désignation<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="designation" placeholder="Saisir la désignation">
							</div>
						</div>
						<div class="col-lg-6">
							<label>Numéro de Série<span class="text-danger">*</span></label>
							<input class="form-control" type="text" name="identifiant" placeholder="Saisir le numéro de serie">
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Modèle<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="modele" placeholder="siasir le modèle">
							</div>
						</div>
						<div class="col-lg-6">
							<label>Marque<span class="text-danger">*</span></label>
							<input class="form-control" type="text" name="marque" placeholder="Saisir la marque">
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-12">
							<label>Description</label>
							<input name="description" class="form-control" cols="10" rows="10" placeholder="Saisir la description">
						</div>
					</div>
				</div>

				<div class="submit-section">
                    <a href="{{route('sousequipements.index')}}" class="btn btn-danger submit-btn">Annuler</a>
					<button class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Ajouter</button>
				</div>
			</form>
			<!-- /Add Sous-equipement -->


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

