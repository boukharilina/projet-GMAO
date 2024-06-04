@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')

@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Gestion Interventions</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Interventions Clôturées</li>
	</ul>
</div>
<div class="col-sm-5 col">
	<a href="{{route('interventions.create')}}" class="btn btn-primary float-right mt-2">Ajouter</a>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">

		<!-- index-->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="intervention-archive-table" class="datatable table table-hover table-center mb-0">
						<thead>
							<tr class="text-uppercase">
							    <th>ETAT</th>
								<th>CLIENT</th>
								<th>EQUIPEMENT</th>
								<th>EQUIPEMENT AVANT VISITE</th>
								<th>INTERVENANT(s)</th>
								<th>DESCRIPTION PANNE</th>
                                <th>Priorité</th>
                                <th>Date début</th>
                                <th>Equipement après visite</th>
								<th class="action-btn">Action</th>
							</tr>
						</thead>
						<tbody>
                            <!-- Add a spinner/loader-->
                            <div id="spinner" class="spinner-border text-primary" role="status"
                                style="display: none;
                                position: absolute;
                                inset-block-start: 50%;
                                inset-inline-start: 50%;">
                                <span class="sr-only">en cours...</span>
                            </div>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /index-->

	</div>
</div>
@endsection

@push('page-js')
<script>
    // Show spinner when DataTable is processing
     $('#intervention-table').on('processing.dt', function(e, settings, processing) {
      if (processing) {
        $('#spinner').show();
      } else {
        $('#spinner').hide();
      }
    });

    $(document).ready(function() {
        var table = $('#intervention-table').DataTable({
            processing: false,
            serverSide: false,
            ajax: "{{route('interventions.index')}}",
            columns: [
				{data: 'etat', name: 'etat'},
                {data: 'client', name: 'client'},
                {data: 'equipement', name: 'equipement'},
                {data: 'etat_initial', name: 'etat_initial'},
                {data: 'destinateur', name: 'destinateur'},
				{data: 'description_panne', name: 'description_panne'},
                {data: 'priorite', name: 'priorite'},
                {	data: 'date_debut',
                    name: 'date_debut',
                    render: function(data, type, row) {
                        if (data) {
                            // Parse the date string using moment.js and format it as 'd-m-y hh:mm'
                            var date = moment(data, 'YYYY-MM-DD HH:mm:ss');
                            return date.format('DD-MM-YYYY hh:mm A');
                        }
                        return '';
                    }
                },
                {data: 'etat_final', name: 'etat_final'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        // Load the moment.js library
          $.getScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', function() {
            // Initialize the moment.js library with the desired locale (e.g., French)
            moment.locale('fr');
        });

    });
</script>
@endpush
