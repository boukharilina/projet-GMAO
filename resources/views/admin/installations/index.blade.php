@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')
    
@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Gestion des Installations</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de bord</a></li>
		<li class="breadcrumb-item active">Installations</li>
	</ul>
</div>
<div class="col-sm-5 col">
	<a href="{{route('installations.create')}}" class="btn btn-primary float-right mt-2">Ajouter</a>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
	
		<!-- installations -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="installation-table" class="datatable table table-hover table-center mb-0">
						<thead>
							<tr>
								<th>Client</th>
								<th>Equipement</th>
							
								<th>Date Debut </th>
								<th>Date Fin</th>
                                <th>Etat </th>
                                <th>Status</th>
								<th class="action-btn">Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /installations-->
		
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
        var table = $('#installation-table').DataTable({
            processing: false,
            serverSide: false,
            ajax: "{{route('installations.index')}}",
            columns: [
                {data: 'client', name: 'client'},
                {data: 'equipement', name: 'equipement'},
				{data: 'equipement', name: 'equipement'},
                {data: 'date_debut', name: 'date_debut'},
                {data: 'date_fin', name: 'date_fin'},
                {data: 'status', name: 'status'},
                {data: 'description', name: 'description'},
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