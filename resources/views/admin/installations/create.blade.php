@extends('admin.layouts.app')

@push('page-css')
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Installations</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
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
				<form method="post" enctype="multipart/form-data" action="{{ route('installations.store') }}">
					@csrf
					<div class="service-fields mb-3">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Client<span class="text-danger">*</span></label>
									<select class="select2 form-select form-control" name="client">
										<option>Sélectionner le client</option>
										@foreach($clients as $client)
											<option value="{{ $client->id }}">{{ $client->name }}</option>
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
									<label>Responsable<span class="text-danger">*</span></label>
									<select class="select2 form-select form-control" name="user_id[]" multiple>
										<option>--Sélectionner le/les technicien(s)--</option>
										@foreach ($users as $user)
											<option value="{{ $user->id }}">{{ $user->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Date/Heure de début</label>
								<input type="datetime-local" name="date_debut" class="form-control">
							</div>
						</div>
					</div>

					<div class="service-fields mb-3">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="customRange3" class="form-label">Etat<span class="text-danger">*</span></label>
									<input type="range" class="form-range" min="0" max="10" step="0.5" id="customRange3">
								</div>
							</div>
						</div>
					</div>

					<table class="table table-bordered" id="table">
						<tr>
							<th>Technicien(s)</th>
							<th>Date / Heure de début</th>
							<th>Date / Heure de fin</th>
							<th>Commentaire</th>
							<th>Action</th>
						</tr>
						<tr>
							<td>
								<select name="inputs[0]['user_id[]']" class="select2 form-select form-control" multiple>
									<option>--Sélectionner le/les intervenant(s)--</option>
									@foreach($users as $user)
										<option value="{{ $user->id }}">{{ $user->name }}</option>
									@endforeach
								</select>
							</td>
							<td>
								<input type="datetime-local" name="inputs[0]['date_debut']" class="form-control" />
							</td>
							<td>
								<input type="datetime-local" name="inputs[0]['date_fin']" class="form-control" />
							</td>
							<td>
								<input type="text" name="inputs[0]['comment']" placeholder="Ecrire un commentaire" class="form-control" />
							</td>
							<td>
								<button type="button" name="add" id="add" class="btn btn-success">+</button>
							</td>
						</tr>
					</table><br>

					<div class="service-fields mb-3">
						<div class="row">
							<div class="col-lg-6">
								<label><b>Date de PV de réception</b></label>
								<input type="datetime-local" name="date_pv_reception" class="form-control">
							</div>
							<div class="col-lg-6">
								<label><b>Date de fin prévu</b></label>
								<input type="date" name="date_fin_prevu" class="form-control">
							</div>
						</div>
					</div>

					<div class="service-fields mb-3">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label><b>Note</b></label>
									<textarea class="form-control service-desc" name="note" placeholder="Ecrire une note"></textarea>
								</div>
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
	<script src="{{ asset('assets/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>	
	<script>
		var i = 0;
		$('#add').click(function() {
			i++;
			$('#table').append(
				'<tr>' +
					'<td>' +
						'<select name="inputs[' + i + '][user_id[]]" class="select2 form-select form-control" multiple>' +
							'<option>--Sélectionner le/les intervenant(s)--</option>' +
							'@foreach($users as $user)' +
								'<option value="{{ $user->id }}">{{ $user->name }}</option>' +
							'@endforeach' +
						'</select>' +
					'</td>' +
					'<td>' +
						'<input type="datetime-local" name="inputs[' + i + '][date_debut]" class="form-control" />' +
					'</td>' +
					'<td>' +
						'<input type="datetime-local" name="inputs[' + i + '][date_fin]" class="form-control" />' +
					'</td>' +
					'<td>' +
						'<input type="text" name="inputs[' + i + '][comment]" placeholder="Ecrire un commentaire" class="form-control" />' +
					'</td>' +
					'<td>' +
						'<button type="button" class="btn btn-danger remove-table-row">Supprimer</button>' +
					'</td>' +
				'</tr>'
			);
		});

		$(document).on('click', '.remove-table-row', function() {
			$(this).closest('tr').remove();
		});
	</script>
@endpush
