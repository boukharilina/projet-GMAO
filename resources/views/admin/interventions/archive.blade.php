@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')
<style>
    body {
        text-align: center;
    }
    .Container{
        height: 100%;
        width: 100%;
        overflow-y: auto;
        background-color: rgb(255, 255, 255);
        border-radius: 5px;
        margin: 0 auto;
        padding: 25px;
    }

    .Content{
        width: 300px;
        color: rgb(0, 0, 0);
        text-align: center;
    }

    .Flipped, .Flipped .Content{
        transform: rotateX(180deg);
    }

    /* Designing for scroll-bar */
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: gainsboro;
        border-radius: 5px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: rgb(149, 143, 143);
        border-radius: 5px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .page-title {
        text-align: left; /* Assurez-vous que le texte est aligné à gauche */
    }
</style>
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
                    <div class="Container Flipped">
                        <div class="Content">
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
                                <th >Rapport </th>
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
			</div>
		</div>
		<!-- /index-->

	</div>
</div>
@endsection

@push('page-js')
<script>
    // Show spinner when DataTable is processing
     $('#intervention-archive-table').on('processing.dt', function(e, settings, processing) {
      if (processing) {
        $('#spinner').show();
      } else {
        $('#spinner').hide();
      }
    });

    $(document).ready(function() {
        var table = $('#intervention-archive-table').DataTable({
            processing: false,
            serverSide: false,
            ajax: "{{route('interventions.archive')}}",
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
                {
                data: 'rapport',
                name: 'rapport',
                render: function(data, type, row) {
                    if (data) {
                        return `<a href="{{ url('showrapport') }}/${row.id}" target="_blank" class="btn btn-primary">Voir</a>`;
                    }
                    return 'Pas De Rapport';
                },
                orderable: false,
                searchable: false
            },
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
