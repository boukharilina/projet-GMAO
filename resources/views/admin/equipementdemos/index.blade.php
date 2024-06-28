@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')

@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Gestion Equipements de Démonstration</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tableau de Bord</a></li>
		<li class="breadcrumb-item active">Equipements de Démo</li>
	</ul>
</div>
<div class="col-sm-5 col">
	<a href="{{route('equipementdemos.create')}}" class="btn btn-primary float-right mt-2">Ajouter</a>
	<button id="generate-pdf" class="btn btn-danger float-right mt-2 mr-2">Générer PDF</button>
    <button id="generate-excel" class="btn btn-success float-right mt-2 mr-2">Générer Excel</button>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">

		<!-- Recent Orders -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive" >
					<table id="equipementdemo-table" class="table table-bordered table-hover">
						<thead>
                            <tr class="text-uppercase">
								<th>Code</th>
								<th>Designation</th>
								<th>Modèle</th>
                                <th>Marque</th>
								<th>Numéro Série</th>
								<th>Modalité</th>
                                <th>Garantie</th>
								<th>Date entrée</th>
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
		<!-- /Recent Orders -->

	</div>
</div>
@endsection

@push('page-js')

<script>
    $('#generate-pdf').on('click', function() {
        window.location.href = "{{ route('equipementdemos.generatePdf') }}";
    });

    $('#generate-excel').on('click', function() {
        window.location.href = "{{ route('equipementdemos.generateExcel') }}";
    });
</script>
<script>
    // Show spinner when DataTable is processing
       $('#equipementdemo-table').on('processing.dt', function(e, settings, processing) {
      if (processing) {
        $('#spinner').show();
      } else {
        $('#spinner').hide();
      }
    });

    $(document).ready(function() {
        var table = $('#equipementdemo-table').DataTable({
            processing: false,
            serverSide: false,
            ajax: "{{ route('equipementdemos.index') }}",

            columns: [
                { data: 'code', name: 'code' },
                { data: 'designation', name: 'designation' },
                { data: 'modele', name: 'modele' },
                { data: 'marque', name: 'marque' },
                { data: 'numserie', name: 'numserie' },
                { data: 'modalite', name: 'modalite' },
                { data: 'garantie', name: 'garantie' },
                { 	data: 'date_entree',
					name: 'date_entree',

				render: function(data, type, row) { if (data)

					{ const date = new Date(data);

					return date.toLocaleString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric' });
				  	}
					return '';

				}
				},
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>

@endpush
